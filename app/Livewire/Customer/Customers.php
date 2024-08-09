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
    public $status_search = 0;

    public function render()
    {
        return view('livewire.customer.customers',[
            'list' => $this->query()
        ]);
    }

    public function query() {
        $list = Customer::with('car')->with('debtor')->where('delete', 0);

        if (!empty($this->serial_number)) {
            $list = $list->where('serial_number',$this->serial_number);
        }

        if ($this->status_search > 0) {
            $list = $list->where('status',$this->status_search);
        }

        if (!empty($this->start_date) && !empty($this->end_date)) {
            $list = $list->whereBetween('customer.date_of_sale',[$this->start_date,$this->end_date]);
        }

        $list = $list->orderBy('id','desc')->paginate(10);
        $this->resetPage();
        return  $list;
    }

    public function delete($id)
    {
        Customer::where('id', $id)
            ->update(['delete' => 1]);
    }
}
