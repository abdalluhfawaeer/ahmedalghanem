<?php

namespace App\Livewire\Customer;

use App\Models\Car;
use App\Models\Customer;
use App\Models\MonthlyInstallment;
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
        }
    }

    public function calculator($data)
    {
        $purchasing_price = $data->car->purchasing_price;
        $total_installments = (float) $data->total_price - (float) $data->first_batch;
        $number_of_months =
            ($total_installments > 0 && $data->monthly_installment > 0) ?
            $total_installments / (float) $data->monthly_installment : 0;
        $total_installments_1 = MonthlyInstallment::where('customer_id' ,$data->id)->where('status',1)->count();
        $total_installments_1_total = MonthlyInstallment::where('customer_id' ,$data->id)->where('status',1)->sum('value');
        $total_installments_1_deferred_value = MonthlyInstallment::where('customer_id' ,$data->id)->where('status',4)->sum('deferred_value');
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
            $total_installments = (float) $this->list->total_price - (float) $this->list->first_batch;
            $this->totalsMonthlyInstallment = $total_installments;
        } else {
            $this->totalsMonthlyInstallment = $this->totalsMonthlyInstallment - $this->list->monthly_installment;

            if (($this->totalsMonthlyInstallment < $this->list->monthly_installment) && $this->totalsMonthlyInstallment > 0) {
                return $this->totalsMonthlyInstallment;
            }
        }

        return $this->list->monthly_installment;
    }

    public function getMonth()
    {
        if ($this->first_installment_date == '') {
            $this->first_installment_date = $this->list->first_installment_date;
        }
        $date = Carbon::parse($this->first_installment_date);

        $this->first_installment_date = $date->addMonth()->format('Y-m-d');

        return $this->first_installment_date;
    }

    public function setMonthlyInstallments($month, $status, $value ,$deferred_value = null)
    {
        if ($deferred_value == 1)
        {
            $deferred_value = $this->deferred_value[$month];
            $value = ($value >= $deferred_value) ? $value - (float)$deferred_value : $value;
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
            'note' => $this->note_vale[$month] ?? ''
        ]);
        $this->getMonthlyInstallmentsList();
    }

    public function partPayment($month)
    {
        $this->showPart[$month] = true;
    }

    public function getMonthlyInstallmentsList()
    {
        $this->show();
        $this->monthlyInstallmentsList = '';
        $list = $this->showPart = $this->deferred_value = [];
        if ($this->list != null) {
            $monthlyInstallment = MonthlyInstallment::where('customer_id' ,$this->list->id)->get()->toArray();
            for($i=0; $i < ceil($this->totals['number_of_months']) ;$i++ ){
                $month = $this->getMonth();
                $monthData = [];
                foreach ($monthlyInstallment as $value)
                {
                    if ($value['month'] == $month) {
                        $id = $value['id'];
                        $this->note_vale[$month] = $value['note'];
                        $monthData = $value;
                        break;
                    }
                }
                if (isset($monthData['deferred_value']) && $monthData['deferred_value']) {
                    $this->showPart[$month] = true;
                    $this->deferred_value[$month] = $monthData['deferred_value'];
                }
                $list[] = [
                    'id' => $id,
                    'month' => $month,
                    'installment' => (isset($this->deferred_value[$month])) ? $this->getMonthlyInstallment() - $this->deferred_value[$month] : $this->getMonthlyInstallment(),
                    'status' => $monthData['status'] ?? 2,
                ];
            }
            $this->monthlyInstallmentsList = $list;
        }
    }
}
