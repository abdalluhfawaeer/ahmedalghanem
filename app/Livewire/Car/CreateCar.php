<?php

namespace App\Livewire\Car;

use App\Models\Car;
use Livewire\Component;

class CreateCar extends Component
{
    public $type = '';
    public $model = '';
    public $number = '';
    public $encoding = '';
    public $purchasing_price = '';
    public $status = '';
    public $id_c = '';

    protected $rules = [
        'type' => 'required',
        'model' => 'required',
        'encoding' => 'required',
        'purchasing_price' => 'required',
        'number' => 'required',
    ];

    protected $messages = [
        'type.required' => 'الحقل اجباري',
        'model.required' => 'الحقل اجباري',
        'encoding.required' => 'الحقل اجباري',
        'purchasing_price.required' => 'الحقل اجباري',
        'number.required' => 'الحقل اجباري',
    ];

    public function mount($id)
    {
        $this->id_c = $id;
        if ($id > 0) {
            $car = Car::where('id',$id)->first();
            $this->type = $car->type;
            $this->model = $car->model;
            $this->encoding = $car->encoding;
            $this->number = $car->number;
            $this->purchasing_price = $car->purchasing_price;
            $this->status = $car->status;
        }
    }

    public function render()
    {
        return view('livewire.car.create-car');
    }

    public function save()
    {
        $this->validate();

        Car::updateOrCreate([
            'id' => $this->id_c,
        ],[
            'name' => $this->type,
            'model' => $this->model,
            'type' => $this->type,
            'encoding' => $this->encoding,
            'number' => $this->number,
            'purchasing_price' => $this->purchasing_price,
            'status' => ($this->status == 0 || $this->status == '') ? 3 : $this->status,
            'delete' => 0,
        ]);

        return redirect()->to('/cars');
    }
}
