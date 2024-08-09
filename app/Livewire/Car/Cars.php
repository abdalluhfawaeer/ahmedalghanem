<?php

namespace App\Livewire\Car;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithPagination;

class Cars extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name_search = '';
    public $status_search = 0;

    public function render()
    {
        return view('livewire.car.cars',[
            'list' => $this->query()
        ]);
    }

    public function query() {
        $list = Car::select('*')->where('delete', 0);

        if ($this->status_search > 0) {
            $list = $list->where('status',$this->status_search);
        }

        if (!empty($this->name_search)) {
            $list = $list->where('name', 'LIKE', "%{$this->name_search}%");
        }

        $list = $list->orderBy('id','desc')->paginate(10);
        $this->resetPage();
        return  $list;
    }

    public function delete($id)
    {
        Car::where('id', $id)
            ->update(['delete' => 1]);
    }
}
