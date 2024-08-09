<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">الاسم</label>
                        <input type="text" class="form-control" placeholder="الاسم" wire:model.dafer="name">
                        <div @error('name') class="alert alert-danger" role="alert" @enderror>
                            @error('name') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">رقم الهاتف</label>
                        <input type="text" class="form-control" placeholder="رقم الهاتف" wire:model.dafer="phone">
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
