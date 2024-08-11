<?php

namespace App\Livewire\Customer;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Debtor;
use App\Models\Pawned;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddCustomer extends Component
{
    //debtor
    public $debtor_id = 0;
    public $debtor_name = '';
    public $debtor_id_number = '';
    public $debtor_phone1 = '';
    public $debtor_phone2 = '';
    public $debtor_phone3 = '';
    public $debtor_address = '';
    public $debtor_address2 = '';

    //sponsor
    public $sponsor_id = 0;
    public $sponsor_name = '';
    public $sponsor_id_number = '';
    public $sponsor_phone1 = '';
    public $sponsor_phone2 = '';
    public $sponsor_phone3 = '';
    public $sponsor_address = '';
    public $sponsor_address2 = '';

    public $serial_number = '';
    public $serial_number_currnt = '';
    public $date_of_sale = '';
    public $total_price = 0;
    public $first_batch = 0;
    public $monthly_installment = 0;
    public $first_installment_date = '';
    public $total_installments = 0;
    public $number_of_months = 0;
    public $financing_amount = 0;
    public $profitable_financing = 0;
    public $car_id = '';
    public $pawned_id = '';
    public $id_c = 0;
    public $car = [];
    public $pawned = [];

    protected $messages = [
        'debtor_name.required' => 'الحقل اجباري',
        'debtor_phone1.required' => 'الحقل اجباري',
        'debtor_address.required' => 'الحقل اجباري',
        'sponsor_name.required' => 'الحقل اجباري',
        'sponsor_phone1.required' => 'الحقل اجباري',
        'sponsor_address.required' => 'الحقل اجباري',
        'serial_number.required' => 'الحقل اجباري',
        'date_of_sale.required' => 'الحقل اجباري',
        'total_price.required' => 'الحقل اجباري',
        'first_batch.required' => 'الحقل اجباري',
        'monthly_installment.required' => 'الحقل اجباري',
        'pawned_id.required' => 'الحقل اجباري',
        'car_id.required' => 'الحقل اجباري',
        'first_installment_date.required' => 'الحقل اجباري',
        'serial_number.unique' => 'هذا الرقم مستخدم من قبل',
    ];

    public function mount($id)
    {
        $this->pawned = Pawned::where('delete',0)->get();
        if ($id > 0) {
            $this->id_c = $id;
            $data = Customer::with('car')
                ->with('debtor')
                ->with('sponsor')
                ->with('pawned')
                ->where('id', $id)->first();
            $this->serial_number = $data->serial_number;
            $this->serial_number_currnt = $data->serial_number;
            $this->date_of_sale = date_format($data->date_of_sale ,"Y-m-d");
            $this->pawned_id = $data->pawned_id;
            $this->first_installment_date = date_format($data->first_installment_date ,"Y-m-d");
            $this->total_price = $data->total_price;
            $this->first_batch = $data->first_batch;
            $this->monthly_installment = $data->monthly_installment;
            $this->car_id = $data->car_id;
            $carIds = Car::where('delete',0)->whereIn('status',[2,3])->pluck('id')->toArray();
            array_push($carIds ,$this->car_id);
            $this->car = Car::whereIn('id',$carIds)->get();

            //debtor
            $this->debtor_id = $data->debtor->id;
            $this->debtor_name = $data->debtor->name;
            $this->debtor_id_number = $data->debtor->id_number;
            $this->debtor_phone1 = $data->debtor->phone1;
            $this->debtor_phone2 = $data->debtor->phone2;
            $this->debtor_phone3 = $data->debtor->phone3;
            $this->debtor_address = $data->debtor->address;
            $this->debtor_address2 = $data->debtor->address2;

            //sponsor
            $this->sponsor_id = $data->sponsor->id;
            $this->sponsor_name = $data->sponsor->name;
            $this->sponsor_id_number = $data->sponsor->id_number;
            $this->sponsor_phone1 = $data->sponsor->phone1;
            $this->sponsor_phone2 = $data->sponsor->phone2;
            $this->sponsor_phone3 = $data->sponsor->phone3;
            $this->sponsor_address = $data->sponsor->address;
            $this->sponsor_address2 = $data->sponsor->address2;
        } else {
            $this->car = Car::where('delete',0)->whereIn('status',[2,3])->get();
        }
    }

    public function render()
    {
        $this->calculator();
        return view('livewire.customer.add-customer');
    }

    public function calculator()
    {
        $purchasing_price = 0;
        if ($this->car_id != '') {
            $car = Car::where('id',$this->car_id)->first();
            if ($car != null)
            {
                $purchasing_price = $car->purchasing_price;
            }
        }

        $this->total_installments = (float) $this->total_price - (float) $this->first_batch;
        if ($this->total_installments > 0 && (float) $this->monthly_installment > 0) {
            $this->number_of_months = $this->total_installments / (float) $this->monthly_installment;
        }
        $this->financing_amount = (float) $purchasing_price - (float) $this->first_batch;
        $this->profitable_financing = (float) $this->total_price - (float) $purchasing_price;
    }

    public function save()
    {
        $uniqueSerialRule = $this->id_c > 0
            ? 'unique:customer,serial_number,' . $this->id_c // Exclude current record from the unique check
            : 'unique:customer,serial_number'; // Apply unique constraint for new records

        $this->validate([
            'debtor_name' => 'required',
            'debtor_phone1' => 'required',
            'debtor_address' => 'required',
            'sponsor_name' => 'required',
            'sponsor_phone1' => 'required',
            'sponsor_address' => 'required',
            'serial_number' => ['required', $uniqueSerialRule],
            'date_of_sale' => 'required',
            'total_price' => 'required',
            'first_batch' => 'required',
            'monthly_installment' => 'required',
            'pawned_id' => 'required',
            'car_id' => 'required',
            'first_installment_date' => 'required',
        ], $this->messages);

        $debtor = Debtor::updateOrCreate([
            'id' => $this->debtor_id,
        ],[
            'name' => $this->debtor_name,
            'id_number' => $this->debtor_id_number,
            'phone1' => $this->debtor_phone1,
            'phone2' => $this->debtor_phone2,
            'phone3' => $this->debtor_phone3,
            'address' => $this->debtor_address,
            'address2' => $this->debtor_address2
        ]);
        $this->debtor_id = $debtor->id;

        $sponsor = Sponsor::updateOrCreate([
            'id' => $this->sponsor_id,
        ],[
            'name' => $this->sponsor_name,
            'id_number' => $this->sponsor_id_number,
            'phone1' => $this->sponsor_phone1,
            'phone2' => $this->sponsor_phone2,
            'phone3' => $this->sponsor_phone3,
            'address' => $this->sponsor_address,
            'address2' => $this->sponsor_address2
        ]);
        $this->sponsor_id = $sponsor->id;

        if ($this->id_c > 0) {
            $existingCustomer = Customer::where('id', $this->id_c)
                ->where('serial_number', $this->serial_number_currnt)
                ->first();
            Car::where('id', $existingCustomer->car_id)
                ->update(['status' => 2]);
            $existingCustomer->update([
                'serial_number' => $this->serial_number,
                'date_of_sale' => $this->date_of_sale,
                'pawned_id' => $this->pawned_id,
                'sponsor_id' => $this->sponsor_id,
                'debtor_id' => $this->debtor_id,
                'car_id' => $this->car_id,
                'total_price' => $this->total_price,
                'first_batch' => $this->first_batch,
                'monthly_installment' => $this->monthly_installment,
                'first_installment_date' => $this->first_installment_date,
                'status' => 1,
                'delete' => 0,
                'user_name' => Auth::user()->name
            ]);
        } else {
            Customer::create([
                'serial_number' => $this->serial_number,
                'date_of_sale' => $this->date_of_sale,
                'pawned_id' => $this->pawned_id,
                'sponsor_id' => $this->sponsor_id,
                'debtor_id' => $this->debtor_id,
                'car_id' => $this->car_id,
                'total_price' => $this->total_price,
                'first_batch' => $this->first_batch,
                'monthly_installment' => $this->monthly_installment,
                'first_installment_date' => $this->first_installment_date,
                'status' => 1,
                'delete' => 0,
                'user_name' => Auth::user()->name
            ]);
        }


        Car::where('id', $this->car_id)
            ->update(['status' => 1]);

        return redirect()->to('/customer');
    }
}
