<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $serial_number = '';
    public $start_date = '';
    public $end_date = '';
    public $name_debtor= '';
    public $status_search = 0;

    public function render()
    {
        return view('livewire.customer.customers',[
            'list' => $this->query()
        ]);
    }

    public function query() {
        $col = [
            'customer.serial_number',
            'customer.status',
            'debtor.name as debtorName',
            'cars.name as carName',
            'customer.status',
            'customer.id',
            'customer.date_of_sale',
            'cars.type',
        ];
        $list = Customer::select($col)
            ->join('cars','cars.id','=','customer.car_id')
            ->join('debtor','debtor.id','=','customer.debtor_id')
            ->where('customer.delete', 0);

        if (!empty($this->serial_number)) {
            $list = $list->where('customer.serial_number',$this->serial_number);
        }

        if ($this->name_debtor != '') {
            $list = $list->where('debtor.name', 'LIKE', "%{$this->name_debtor}%");
        }

        if ($this->status_search > 0) {
            $list = $list->where('customer.status',$this->status_search);
        }

        if (!empty($this->start_date) && !empty($this->end_date)) {
            $list = $list->whereBetween('customer.date_of_sale',[$this->start_date,$this->end_date]);
        }

        $list = $list->orderBy('customer.id','desc')->paginate(10);
        $this->resetPage();
        return  $list;
    }

    public function delete($id)
    {
        Customer::where('id', $id)
            ->update(['delete' => 1]);
    }
}
