<?php

namespace App\Livewire\Customer;

use App\Models\Car;
use App\Models\Customer;
use App\Models\MonthlyInstallment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class DetailedDisclosure extends Component
{
    public $serial_number = '';
    public $status_search = 0;
    public $totals = [];
    public $list;
    public $monthlyInstallment = 0;
    public $totalsMonthlyInstallment = 0;
    public $first_installment_date = '';
    public $showPart = [];
    public $deferred_value = [];
    public $note_vale = [];
    public $monthlyInstallmentsList;
    public $installment_value = [];
    public $negative_value = 0;
    public $earlyPaymentValue = 0;
    public $isOpen = false;

    public function mount($id)
    {
        if ($id > 0)
        {
            $this->serial_number = $id;
            $this->getMonthlyInstallmentsList();
        }
    }

    public function render()
    {
        return view('livewire.customer.detailed-disclosure');
    }

    public function show() {
        $list = Customer::with('car')->with('debtor')->with('sponsor')->with('pawned');
        $this->list = $list->where('serial_number',$this->serial_number)->first();
        if ($this->serial_number != '' && !empty($this->list)) {
            $this->totalsMonthlyInstallment = 0;
            $this->monthlyInstallment = 0;
            $this->first_installment_date = '';
            $this->totals = $this->calculator($this->list);
            $this->earlyPaymentValue = $this->list->early_payment;
        }
    }

    public function calculator($data)
    {
        $purchasing_price = $data->car->purchasing_price;
        $total_installments = (float) $data->total_price - (float) $data->first_batch;
        $number_of_months =
            ($total_installments > 0 && $data->monthly_installment > 0) ?
            $total_installments / (float) $data->monthly_installment : 0;
        $number_of_months = ceil($number_of_months);
        $months = $this->getMonthsReport($number_of_months);
        $total_installments_1 = MonthlyInstallment::where('customer_id' ,$data->id)
            ->whereIn('month', $months)
            ->where('status',1)
            ->count();

        $total_installments_1_total = MonthlyInstallment::where('customer_id' ,$data->id)
            ->whereIn('month', $months)
            ->where('status',1)
            ->sum('value');
        $total_installments_1_deferred_value = MonthlyInstallment::where('customer_id' ,$data->id)
            ->whereIn('month', $months)
            ->where('status',4)
            ->sum('deferred_value');
        $total_installments_1_total = $total_installments_1_total + $total_installments_1_deferred_value;
        return [
            'first_installment_date' => $data->first_installment_date,
            'total_price' => $data->total_price,
            'first_batch' => $data->first_batch,
            'monthly_installment' => $data->monthly_installment,
            'financing_amount' => $purchasing_price - (float) $data->first_batch,
            'profitable_financing' => $data->total_price - $purchasing_price,
            'number_of_months' => number_format($number_of_months ,2),
            'total_installments' => $total_installments,
            'total_installments_1' => $total_installments_1,
            'total_installments_2' => number_format($number_of_months - $total_installments_1 ,2),
            'total_installments_1_total' => $total_installments_1_total,
            'total_installments_2_total' => $total_installments - $total_installments_1_total,
        ];
    }

    public function getMonthlyInstallment()
    {
        if ($this->totalsMonthlyInstallment == 0) {
            $total_installments = $this->totals['total_installments_2_total'];
            $this->totalsMonthlyInstallment = $total_installments;
        } else {
            $this->totalsMonthlyInstallment = $this->totalsMonthlyInstallment - $this->list->monthly_installment;
        }

        return $this->list->monthly_installment;
    }

    public function getMonth()
    {

        if ($this->first_installment_date == '') {
            $this->first_installment_date = $this->list->first_installment_date;
            $date = Carbon::parse($this->first_installment_date);
            $this->first_installment_date = $date->format('Y-m-d');
            return $this->first_installment_date;
        }
        $date = Carbon::parse($this->first_installment_date);
        $this->first_installment_date = $date->addMonth()->format('Y-m-d');

        return $this->first_installment_date;
    }

    public function setMonthlyInstallments($month, $status ,$deferred_value = null)
    {
        $value = $this->installment_value[$month];
        if ($deferred_value == 1)
        {
            $deferred_value = $this->deferred_value[$month];
            $value = $this->list->monthly_installment;
        }

        if ($status == 1) {
            if (isset($this->deferred_value[$month])) {
                $value = $value + $this->deferred_value[$month];
            }
        }

        if ($status == 2 || $status == 3) {
            $value = 0;
        }

        MonthlyInstallment::updateOrCreate([
            'customer_id' => $this->list->id,
            'month' => $month,
        ],[
            'customer_id' => $this->list->id,
            'month' => $month,
            'value' => $value,
            'status' => $status,
            'deferred_value' => $deferred_value,
            'note' => $this->note_vale[$month] ?? '',
            'user_name' => Auth::user()->name
        ]);

        $countCheck = MonthlyInstallment::where('customer_id',$this->list->id)->where('status','1')->count();
        $numberOfMonths = ceil($this->totals['number_of_months']);
        if ($countCheck == $numberOfMonths) {
            Customer::where('id',$this->list->id)->update(['status'=>2]);
        } else {
            Customer::where('id',$this->list->id)->update(['status'=>1]);
        }
        $this->getMonthlyInstallmentsList();
    }

    public function partPayment($month)
    {
        $this->showPart[$month] = true;
    }

    public function getMonthsReport($numberOfMonths)
    {
        $months = [];
        for($i=0; $i < $numberOfMonths ;$i++ ){
            $months[] = $this->getMonth();
        }
        $this->first_installment_date = '';
        return $months;
    }

    public function getMonthlyInstallmentsList()
    {
        $this->show();
        $this->monthlyInstallmentsList = '';
        $list = $this->showPart = $this->deferred_value = [];
        if ($this->list != null) {
            $monthlyInstallment = MonthlyInstallment::where('customer_id' ,$this->list->id)->get()->toArray();
            $numberOfMonths = ceil($this->totals['number_of_months']);
            for($i=0; $i < $numberOfMonths ;$i++ ){
                $month = $this->getMonth();
                $valueOfMonth = 0;
                $monthData = [];
                foreach ($monthlyInstallment as $value)
                {
                    if ($value['month'] == $month) {
                        $id = $value['id'];
                        $name = $value['user_name'];
                        $date = Carbon::parse($value['updated_at']);
                        $date = $date->subMonth()->format('Y-m-d');
                        $valueOfMonth = $value['value'];
                        $this->note_vale[$month] = $value['note'];
                        $monthData = $value;
                        break;
                    }
                }
                if (isset($monthData['deferred_value']) && $monthData['deferred_value']) {
                    $this->showPart[$month] = true;
                    $this->deferred_value[$month] = $monthData['deferred_value'];
                }
                if ($i == $numberOfMonths - 1) {
                    $valueOfMonth = $this->totalsMonthlyInstallment - $this->list->monthly_installment;
                    if ($valueOfMonth > $this->list->monthly_installment) {
                        $valueOfMonth = $this->getMonthlyInstallment();
                    }
                } else if ($valueOfMonth == 0) {
                    $valueOfMonth = $this->getMonthlyInstallment();
                }

                $this->installment_value[$month] = (isset($this->deferred_value[$month])) ? $valueOfMonth - $this->deferred_value[$month] : $valueOfMonth;
                $list[] = [
                    'id' => $id ?? 0,
                    'month' => $month,
                    'status' => $this->list->early_payment > 0 ? 1 : $monthData['status'] ?? 2,
                    'name' => $name ?? '',
                    'date' => $date ?? '',
                ];
            }
            $this->resetInstallment();
            $this->monthlyInstallmentsList = $list;
        }
    }

    public function resetInstallment()
    {
        foreach ($this->installment_value as $key => $value) {
            if ($value < 0)
            {
                $this->negative_value = $value;
                $this->installment_value[$key] = 0;
                $date = Carbon::parse($key);
                $date = $date->subMonth()->format('Y-m-d');
                $this->installment_value[$date] = $this->installment_value[$date] + $value;
            } else {
                $this->negative_value = 0;
            }
        }

        return $this->negative_value == 0 ? true : $this->resetInstallment();
    }

    public function earlyPayment()
    {
        Customer::where('id',$this->list->id)->update(
            [
                'early_payment' => $this->earlyPaymentValue,
                'status' => 2,
            ]
        );
        $this->show();
        $this->getMonthlyInstallment();
    }
}
