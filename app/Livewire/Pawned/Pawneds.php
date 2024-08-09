<?php

namespace App\Livewire\Pawned;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pawned;

class Pawneds extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name_search = '';
    public $phone_search = '';

    public function render()
    {
        return view('livewire.pawned.pawneds',[
            'list' => $this->query()
        ]);
    }

    public function query() {
        $list = Pawned::select('*')->where('delete', 0);

        if ($this->phone_search > 0) {
            $list = $list->where('phone', 'LIKE', "%{$this->phone_search}%");
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
        Pawned::where('id', $id)
            ->update(['delete' => 1]);
    }
}
