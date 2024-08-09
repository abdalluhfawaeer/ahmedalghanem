<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">الاسم</label>
                        <input type="text" class="form-control" placeholder="الاسم" wire:model.dafer="username">
                        <div @error('username') class="alert alert-danger" role="alert" @enderror>
                            @error('username') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">البريد الالكتروني</label>
                        <input type="email" class="form-control" placeholder="البريد الالكتروني" wire:model.dafer="email">
                        <div @error('email') class="alert alert-danger" role="alert" @enderror>
                            @error('email') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">كلمة المرور</label>
                        <input type="text" class="form-control" placeholder="كلمة المرور" wire:model.dafer="password">
                        <div @error('password') class="alert alert-danger" role="alert" @enderror>
                            @error('password') {{ $message }} @enderror
                        </div>
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
            </div>
        </div>
    </div>
</div>
