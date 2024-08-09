<div class="container-fluid py-4">
    <div class="mt-4">
        <div class="col-6 text-end">
            <a class="btn bg-gradient-dark mb-0" href="/user/add"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;اضافة مستخدم</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary font-weight-bolder">الاسم</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">البريد الالكتروني</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $val)
                                @if($val->id > 1)
                                    <tr>
                                        <td>
                                            {{ $val->name }}
                                        </td>
                                        <td>
                                            {{ $val->email }}
                                        </td>
                                        <td class="align-middle">
                                            <a href="/user/edit/{{ $val->id }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                <span class="badge badge-sm bg-gradient-success">تعديل</span>
                                            </a>
                                            -
                                            <a href="#" wire:click="delete({{ $val->id }})" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                <span class="badge badge-sm bg-gradient-danger">حذف</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
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
