<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.user.users', [
            'list' => User::orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function delete($id) {
        User::where('id' ,$id)->delete();
    }
}
