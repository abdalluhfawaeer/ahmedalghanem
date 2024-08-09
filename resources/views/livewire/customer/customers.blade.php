<div class="container-fluid py-4">
    <div class="mt-4">
        <div class="col-6 text-end">
            <a class="btn bg-gradient-dark mb-0" href="/customer/add"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;اضافة زبون</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">الرقم التسلسلي</label>
                        <input type="text" class="form-control" placeholder="الرقم التسلسلي" wire:model.live="serial_number">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">من</label>
                        <input type="date" class="form-control" placeholder="تاريخ البيع" wire:model.live="start_date">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">الى</label>
                        <input type="date" class="form-control" placeholder="تاريخ البيع" wire:model.live="end_date">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">الحالة</label>
                        <select class="form-control" wire:model.live="status_search">
                            <option value="0">الحالة</option>
                            <option value="1">مكتمل</option>
                            <option value="2">غير مكتمل</option>
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
                                <th class="text-uppercase text-secondary font-weight-bolder">الرقم التسلسلي</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">تاريخ البيع</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">اسم الكفيل</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">السيارة</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">الحالة</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">الكشف التفصيلي</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $val)
                                <tr>
                                    <td>
                                        {{ $val->serial_number }}
                                    </td>
                                    <td>
                                        {{ date_format($val->date_of_sale,"Y/m/d") }}
                                    </td>
                                    <td>
                                        {{ $val->debtor->name }}
                                    </td>
                                    <td>
                                        {{ $val->car->type }}
                                    </td>
                                    <td>
                                        @if($val->status == 2)
                                            <span class="badge badge-sm bg-gradient-success">مكتمل</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-danger">غير مكتمل</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/customer/detailed_disclosure/{{ $val->serial_number }}" target="_blank" class="font-weight-bold" style="color: #0d6efd" data-toggle="tooltip" data-original-title="Edit user">
                                            <span>الكشف التفصيلي</span>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="/customer/edit/{{ $val->id }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <span class="badge badge-sm bg-gradient-success">تعديل</span>
                                        </a>
                                        -
                                        <a href="#" wire:click="delete({{ $val->id }})" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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
