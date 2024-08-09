<?php

namespace App\Livewire\Pawned;

use App\Models\Pawned;
use Livewire\Component;

class AddPawneds extends Component
{
    public $id_c = '';
    public $name = '';
    public $phone = '';

    protected $rules = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'الحقل اجباري',
    ];

    public function mount($id)
    {
        $this->id_c = $id;
        if ($id > 0) {
            $pawned = Pawned::where('id',$id)->first();
            $this->name = $pawned->name;
            $this->phone = $pawned->phone;
        }
    }

    public function render()
    {
        return view('livewire.pawned.add-pawneds');
    }

    public function save()
    {
        $this->validate();

        Pawned::updateOrCreate([
            'id' => $this->id_c,
        ],[
            'name' => $this->name,
            'phone' => $this->phone,
        ]);

        return redirect()->to('/pawned');
    }
}
