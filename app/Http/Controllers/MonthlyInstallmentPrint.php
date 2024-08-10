<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MonthlyInstallment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Hassanhelfi\NumberToArabic\NumToArabic;

class MonthlyInstallmentPrint extends Controller
{
    public $first_installment_date = '';
    public $totalsMonthlyInstallment = 0;
    public $monthlyInstallment = 0;

    public function receivedVoucher(Request $request)
    {
        $monthlyInstallment = MonthlyInstallment::where('id' ,$request->id)->first();
        $customer = Customer::with('debtor')->where('id',$monthlyInstallment->customer_id)->first();
        $integerPart = floor($monthlyInstallment->value);
        $decimalPart = ($monthlyInstallment->value - $integerPart) * 10;
        $decimalPart = (int)$decimalPart;

        return view('admin.customer.print.received-voucher', [
            'data' => [
                'month' => $monthlyInstallment->month,
                'name' => $customer->debtor->name,
                'value' => $integerPart,
                'valuePart' => $decimalPart,
                'note' => $monthlyInstallment->note,
                'value_name' => NumToArabic::number2Word($monthlyInstallment->value)
            ]
        ]);
    }

    public function detailedDisclosure(Request $request)
    {
        $list = Customer::with('car')->with('debtor')->with('sponsor')->with('pawned');
        $list = $list->where('id',$request->id)->first();
        $totals = [];
        if (!empty($list)) {
            $totals = $this->calculator($list);
        }
        $monthlyInstallmentsList = [];
        $this->totalsMonthlyInstallment = 0;
        $this->monthlyInstallment = 0;
        $this->first_installment_date = '';
        $listPrint = $showPart = $deferred_value = $note_vale = [];
        if ($list != null) {
            $monthlyInstallment = MonthlyInstallment::where('customer_id' ,$list->id)->get()->toArray();
            for($i=0; $i < ceil($totals['number_of_months']) ;$i++ ){
                $month = $this->getMonth($list);
                $monthData = [];
                foreach ($monthlyInstallment as $value)
                {
                    if ($value['month'] == $month) {
                        $id = $value['id'];
                        $note_vale[$month] = $value['note'];
                        $monthData = $value;
                        break;
                    }
                }
                if (isset($monthData['deferred_value']) && $monthData['deferred_value']) {
                    $showPart[$month] = true;
                    $deferred_value[$month] = $monthData['deferred_value'];
                }
                $listPrint[] = [
                    'id' => $id,
                    'month' => $month,
                    'installment' => (isset($deferred_value[$month])) ? $this->getMonthlyInstallment($list) - $deferred_value[$month] : $this->getMonthlyInstallment($list),
                    'status' => $monthData['status'] ?? 2,
                ];
            }
            $monthlyInstallmentsList = $listPrint;
        }

        return view('admin.customer.print.detailed-disclosure', [
            'monthlyInstallmentsList' => $monthlyInstallmentsList,
            'totals' => $totals,
            'deferred_value' => $deferred_value,
            'showPart' => $showPart,
            'list' => $list,
            'note_vale' => $note_vale,
        ]);
    }

    public function getMonth($list)
    {
        if ($this->first_installment_date == '') {
            $this->first_installment_date = $list->first_installment_date;
        }
        $date = Carbon::parse($this->first_installment_date);

        $this->first_installment_date = $date->addMonth()->format('Y-m-d');

        return $this->first_installment_date;
    }

    public function getMonthlyInstallment($list)
    {
        if ($this->totalsMonthlyInstallment == 0) {
            $total_installments = (float) $list->total_price - (float) $list->first_batch;
            $this->totalsMonthlyInstallment = $total_installments;
        } else {
            $this->totalsMonthlyInstallment = $this->totalsMonthlyInstallment - $list->monthly_installment;

            if (($this->totalsMonthlyInstallment < $list->monthly_installment) && $this->totalsMonthlyInstallment > 0) {
                return $this->totalsMonthlyInstallment;
            }
        }

        return $list->monthly_installment;
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
}
