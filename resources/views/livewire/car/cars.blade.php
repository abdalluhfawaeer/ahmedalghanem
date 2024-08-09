<div class="container-fluid py-4">
    <div class="mt-4">
        <div class="col-6 text-end">
            <a class="btn bg-gradient-dark mb-0" href="/car/add"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;اضافة سيارة</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="نوع السيارة" wire:model.live="name_search">
                    </div>
                    <div class="col">
                        <select class="form-control" wire:model.live="status_search">
                            <option value="0">حالة السيارة</option>
                            <option value="1">مبيوعة</option>
                            <option value="2">لم تباع</option>
                            <option value="3">نشطة</option>
                            <option value="4">غير نشطة</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary font-weight-bolder">نوع السيارة</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">موديل السيارة</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">رقم-ترميز</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">سعر الشراء</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">الحالة</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $car)
                                <tr>
                                <td>
                                    {{ $car->type }}
                                </td>
                                <td>
                                    {{ $car->model }}
                                </td>
                                <td>
                                    <span class="badge badge-sm bg-gradient-secondary">{{ $car->number }}</span>
                                    -
                                    <span class="badge badge-sm bg-gradient-secondary">{{ $car->encoding }}</span>
                                </td>
                                <td>
                                    {{ $car->purchasing_price }}
                                </td>
                                <td>
                                    @if($car->status == 1)
                                        <span class="badge badge-sm bg-gradient-primary">مبيوعة</span>
                                    @elseif($car->status == 2)
                                        <span class="badge badge-sm bg-gradient-warning">لم تباع</span>
                                    @elseif($car->status == 3)
                                        <span class="badge badge-sm bg-gradient-success">نشطة</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-danger">غير نشطة</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="/car/edit/{{ $car->id }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                        <span class="badge badge-sm bg-gradient-success">تعديل</span>
                                    </a>
                                    -
                                    <a href="#" wire:click="delete({{ $car->id }})" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                        <span class="badge badge-sm bg-gradient-danger">حذف</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                            <div>
                                {{ $list->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
