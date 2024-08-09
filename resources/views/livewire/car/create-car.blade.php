<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">نوع السيارة</label>
                        <input type="text" class="form-control" placeholder="نوع السيارة" wire:model.dafer="type">
                        <div @error('type') class="alert alert-danger" role="alert" @enderror>
                            @error('type') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">موديل السيارة</label>
                        <input type="text" class="form-control" placeholder="موديل السيارة" wire:model.dafer="model">
                        <div @error('model') class="alert alert-danger" role="alert" @enderror>
                            @error('model') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">رقم</label>
                        <input type="number" class="form-control" placeholder="رقم" wire:model.dafer="number">
                        <div @error('number') class="alert alert-danger" role="alert" @enderror>
                            @error('number') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">ترميز</label>
                        <input type="number" class="form-control" placeholder="ترميز" wire:model.dafer="encoding">
                        <div @error('encoding') class="alert alert-danger" role="alert" @enderror>
                            @error('encoding') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">سعر الشراء</label>
                        <input type="number" class="form-control" placeholder="سعر الشراء" wire:model.dafer="purchasing_price" step="any">
                        <div @error('purchasing_price') class="alert alert-danger" role="alert" @enderror>
                            @error('purchasing_price') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">حالة السيارة</label>
                        <select class="form-control" id="exampleFormControlSelect1" wire:model.dafer="status">
                            <option value="0">حالة السيارة</option>
                            <option value="1">مبيوعة</option>
                            <option value="2">لم تباع</option>
                            <option value="3">نشطة</option>
                            <option value="4">غير نشطة</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="col">
                    <button class="btn bg-gradient-dark mb-0" wire:loading.attr="disabled" wire:click="save">
                        <span wire:loading.remove wire.target="save"><i class="fas fa-plus" aria-hidden="true"></i>  حفظ</span>
                        <span wire:loading wire.target="save" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
