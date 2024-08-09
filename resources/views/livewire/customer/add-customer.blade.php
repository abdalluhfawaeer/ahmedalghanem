<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">الرقم التسلسلي</label>
                        <input type="text" class="form-control" placeholder="الرقم التسلسلي" wire:model.dafer="serial_number">
                        <div @error('serial_number') class="alert alert-danger" role="alert" @enderror>
                            @error('serial_number') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">تاريخ البيع (التنازل)</label>
                        <input type="date" class="form-control" placeholder="تاريخ البيع (التنازل)" wire:model.dafer="date_of_sale">
                        <div @error('date_of_sale') class="alert alert-danger" role="alert" @enderror>
                            @error('date_of_sale') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">اسم المدين</label>
                        <input type="text" class="form-control" placeholder="اسم المدين" wire:model.dafer="debtor_name">
                        <div @error('debtor_name') class="alert alert-danger" role="alert" @enderror>
                            @error('debtor_name') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">الرقم الوطني</label>
                        <input type="text" class="form-control" placeholder="الرقم الوطني" wire:model.dafer="debtor_id_number">
                        <div @error('debtor_id_number') class="alert alert-danger" role="alert" @enderror>
                            @error('debtor_id_number') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">رقم الهاتف 1</label>
                        <input type="text" class="form-control" placeholder="رقم الهاتف 1" wire:model.dafer="debtor_phone1">
                        <div @error('debtor_phone1') class="alert alert-danger" role="alert" @enderror>
                            @error('debtor_phone1') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">رقم الهاتف 2</label>
                        <input type="text" class="form-control" placeholder="رقم الهاتف 2" wire:model.dafer="debtor_phone2">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">رقم الهاتف 3</label>
                        <input type="text" class="form-control" placeholder="رقم الهاتف 3" wire:model.dafer="debtor_phone3">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">عنوان السكن</label>
                        <input type="text" class="form-control" placeholder="عنوان السكن" wire:model.dafer="debtor_address">
                        <div @error('debtor_address') class="alert alert-danger" role="alert" @enderror>
                            @error('debtor_address') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">عنوان العمل</label>
                        <input type="text" class="form-control" placeholder="عنوان العمل" wire:model.dafer="debtor_address2">
                    </div>
                </div>
            </div>
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">اسم الكفيل</label>
                        <input type="text" class="form-control" placeholder="اسم المدين" wire:model.dafer="sponsor_name">
                        <div @error('sponsor_name') class="alert alert-danger" role="alert" @enderror>
                            @error('sponsor_name') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">الرقم الوطني</label>
                        <input type="text" class="form-control" placeholder="الرقم الوطني" wire:model.dafer="sponsor_id_number">
                        <div @error('sponsor_id_number') class="alert alert-danger" role="alert" @enderror>
                            @error('sponsor_id_number') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">رقم الهاتف 1</label>
                        <input type="text" class="form-control" placeholder="رقم الهاتف 1" wire:model.dafer="sponsor_phone1">
                        <div @error('sponsor_phone1') class="alert alert-danger" role="alert" @enderror>
                            @error('sponsor_phone1') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">رقم الهاتف 2</label>
                        <input type="text" class="form-control" placeholder="رقم الهاتف 2" wire:model.dafer="sponsor_phone2">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">رقم الهاتف 3</label>
                        <input type="text" class="form-control" placeholder="رقم الهاتف 3" wire:model.dafer="sponsor_phone3">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">عنوان السكن</label>
                        <input type="text" class="form-control" placeholder="عنوان السكن" wire:model.dafer="sponsor_address">
                        <div @error('sponsor_address') class="alert alert-danger" role="alert" @enderror>
                            @error('sponsor_address') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">عنوان العمل</label>
                        <input type="text" class="form-control" placeholder="عنوان العمل" wire:model.dafer="sponsor_address2">
                    </div>
                </div>
            </div>
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">مرهون الى</label>
                        <select class="form-control" id="exampleFormControlSelect1" wire:model.dafer="pawned_id">
                            <option value="">مرهون الى</option>
                            @foreach($pawned as $val)
                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                        <div @error('pawned_id') class="alert alert-danger" role="alert" @enderror>
                            @error('pawned_id') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">السيارة</label>
                        <select class="form-control" id="exampleFormControlSelect1" wire:model.live="car_id">
                            <option value="">السيارة</option>
                            @foreach($car as $val)
                                <option value="{{ $val->id }}">{{ $val->type }}</option>
                            @endforeach
                        </select>
                        <div @error('car_id') class="alert alert-danger" role="alert" @enderror>
                            @error('car_id') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">تاريخ بدء اول قسط</label>
                        <input type="date" class="form-control" placeholder="تاريخ بدء اول قسط" wire:model.dafer="first_installment_date">
                        <div @error('first_installment_date') class="alert alert-danger" role="alert" @enderror>
                            @error('first_installment_date') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">السعر الاجمالي</label>
                        <input type="number" class="form-control" step="any" wire:model.live="total_price">
                        <div @error('total_price') class="alert alert-danger" role="alert" @enderror>
                            @error('total_price') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">الدفهة الاولة</label>
                        <input type="number" class="form-control" step="any" wire:model.live="first_batch">
                        <div @error('first_batch') class="alert alert-danger" role="alert" @enderror>
                            @error('first_batch') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">القسط الشهري</label>
                        <input type="number" class="form-control" step="any" wire:model.live="monthly_installment">
                        <div @error('monthly_installment') class="alert alert-danger" role="alert" @enderror>
                            @error('monthly_installment') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">مجموع الاقساط</label>
                        <input type="text" class="form-control" disabled value="{{ $total_installments }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">عدد الاشهر</label>
                        <input type="text" class="form-control" disabled value="{{ ceil($number_of_months) }}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">مبلغ التمويل</label>
                        <input type="text" class="form-control" disabled value="{{ $financing_amount }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">المربح</label>
                        <input type="text" class="form-control"  disabled value="{{ $profitable_financing }}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="col">
                    <button class="btn bg-gradient-dark mb-0" wire:loading.attr="disabled" wire:click="save">
                        <span wire:loading.remove wire.target="save"><i class="fas fa-plus" aria-hidden="true"></i>  حفظ</span>
                        <span wire:loading wire.target="save" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                    @
                    <div @error('serial_number') class="alert alert-danger" role="alert" @enderror>
                        @error('serial_number') {{ $message }} @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
