<?php

namespace App\Livewire\Report;

use App\Models\Customer;
use App\Models\MonthlyInstallment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class InstallmentsDay extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $start_date = '';
    public $end_date = '';
    public $total_installments = 0;
    public $total_installments_value = 0;
    public $total_installments_1 = 0;
    public $total_installments_1_value = 0;
    public $serial_number_months = [];

    public function render()
    {
        return view('livewire.report.installments-day',[
            'list' => $this->query()
        ]);
    }

    public function query()
    {
        $ids = $this->getCustomersId();
        $col = [
            'customer.serial_number',
            'debtor.name as debtorName',
            'debtor.phone1 as phone',
            'cars.name as carName',
            'customer.id',
        ];

        $list = Customer::select($col)
            ->join('cars','cars.id','=','customer.car_id')
            ->join('debtor','debtor.id','=','customer.debtor_id')
            ->whereIn('customer.id', $ids);

        $list = $list->orderBy('customer.id','desc')->paginate(5);
        $this->resetPage();
        return  $list;

    }

    protected function getCustomersId()
    {
        $this->total_installments =
        $this->total_installments_value =
        $this->total_installments_1 =
        $this->total_installments_1_value = 0;
        $ids = $this->serial_number_months = [];
        $list = Customer::select('id','serial_number','first_installment_date','total_price','first_batch','monthly_installment')
            ->where('delete',0)
            ->where('status',1)
            ->get();
        $this->start_date = Carbon::now()->format('Y-m-d');
        $this->end_date = Carbon::now()->format('Y-m-d');

        foreach ($list as $item) {
            $total_installments = (float) $item->total_price - (float) $item->first_batch;
            $number_of_months =
                ($total_installments > 0 && $item->monthly_installment > 0) ?
                    $total_installments / (float) $item->monthly_installment : 0;
            $dates = $this->getMoths($number_of_months ,$item->first_installment_date);
            $filtered_dates = array_filter($dates, function($date){
                $current_date = Carbon::parse($date);
                return $current_date->between($this->start_date, $this->end_date);
            });
            if (!empty($filtered_dates)) {
                $dates_string = implode(', ', $filtered_dates);
                $checkIs = MonthlyInstallment::where('month',$dates_string)->where('status',1)->first();
                if ($checkIs != null) {
                    $this->total_installments = $this->total_installments + $checkIs->value;
                    $this->total_installments_value = $this->total_installments_value + 1;
                } else {
                    $this->total_installments_1 = $this->total_installments_1 + (float) $item->monthly_installment;
                    $this->total_installments_1_value = $this->total_installments_1_value + 1;
                    $ids[] = $item->id;
                    $this->serial_number_months[$item->serial_number] = [
                        'date' => $dates_string,
                        'value' => $item->monthly_installment,
                    ];
                }
            }
        }

        return $ids;
    }

    protected function getMoths($number_of_months ,$first_installment_date) {
        if ($number_of_months <= 0) {
            return [];
        }

        $first_installment_date = Carbon::parse($first_installment_date);
        $data = $first_installment_date->format('Y-m-d');
        $months = [$data];
        for ($i = 1 ;$i < ceil($number_of_months) ;$i++) {
            $months[] = $first_installment_date->addMonth()->format('Y-m-d');
        }

        return $months;
    }
}
