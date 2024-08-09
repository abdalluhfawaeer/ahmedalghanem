<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class AddUser extends Component
{
    public $username = '';
    public $email = '';
    public $password = '';
    public $id_c = '';

    protected $rules = [
        'username' => 'required',
        'email' => 'required',
    ];

    protected $messages = [
        'username.required' => 'الحقل اجباري',
        'email.required' => 'الحقل اجباري',
    ];

    public function mount($id) {
        $user = User::where('id' ,$id)->first();
        if ($user) {
            $this->id_c = $user->id;
            $this->username = $user->name;
            $this->email = $user->email;
            $this->password = $user->pass;
        }
    }

    public function render()
    {
        return view('livewire.user.add-user');
    }

    public function save() {
        $this->validate();

        User::updateOrCreate([
            'id' => $this->id_c,
        ],[
            'name' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'pass' => $this->password,
        ]);

        return redirect()->to('/users');
    }
}
