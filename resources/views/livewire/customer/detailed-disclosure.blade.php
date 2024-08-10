<div class="container-fluid py-4">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-xl-6 mb-xl-0 mb-4">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="الرقم التسلسلي" style="border-radius: unset !important;" wire:model.dafer="serial_number">
                    <button class="btn btn-sm mb-0 me-1" style="background: black;color: white" wire:loading.attr="disabled" wire:click="getMonthlyInstallmentsList">
                        <span wire:loading.remove wire.target="getMonthlyInstallmentsList"><i class="fas fa-plus" aria-hidden="true"></i>  عرض</span>
                        <span wire:loading wire.target="getMonthlyInstallmentsList" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                    @if(!empty($list) && $serial_number != '')
                        <a href="/detailed_disclosure/print/{{ $list->id }}" class="btn btn-sm mb-0 me-1" style="background: blue;color: white" target="_blank">طباعة</a>
                        @if($list->status == 2)
                            <button class="btn btn-sm mb-0 me-1" style="background: green;color: white">مكتمل</button>
                        @else
                            <button class="btn btn-sm mb-0 me-1" style="background: red;color: white">غير مكتمل</button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    @if(empty($list) || $serial_number == '')
        <div class="alert alert-danger" role="alert">
            لا توجد معلومات لرقم التسلسلي
        </div>
    @else
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">تاريخ بدء اول قسط</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ date_format($totals['first_installment_date'] ,"Y-m-d") }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">السعر الاجمالي</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ $totals['total_price'] }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">الدفهة الاولة</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ $totals['first_batch'] }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">القسط الشهري</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ $totals['monthly_installment'] }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">مجموع الاقساط</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ $totals['total_installments'] }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">عدد الاشهر</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ ceil($totals['number_of_months']) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">مبلغ التمويل</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ $totals['financing_amount'] }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0"> المربح</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ $totals['profitable_financing'] }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">عدد الاقساط المدفوعة</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ ceil($totals['total_installments_1']) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">عدد الاقساط الغير مدفوعة</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ ceil($totals['total_installments_2']) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">المبلغ الاجمالي المدفوع</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ $totals['total_installments_1_total'] }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="card">
                                    <br>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">المتبقي</h6>
                                        <span class="text-xs">:</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ $totals['total_installments_2_total'] }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">مرهون الى :{{ $list->pawned->name }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-0">
                        <div class="row">
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">المدين</h6>
                                        <span class="mb-2 text-xs">الاسم: <span class="text-dark font-weight-bold ms-sm-2">{{ $list->debtor->name }}</span></span>
                                        <span class="mb-2 text-xs">الرقم الوطني: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->debtor->id_number }}</span></span>
                                        <span class="text-xs">رقم الهاتف 1: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->debtor->phone1 }}</span></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="mb-2 text-xs">رقم الهاتف 2: <span class="text-dark font-weight-bold ms-sm-2">{{ $list->debtor->phone2 }}</span></span>
                                        <span class="mb-2 text-xs">رقم الهاتف 3: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->debtor->phone3 }}</span></span>
                                        <span class="mb-2 text-xs">عنوان السكن: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->debtor->address }}</span></span>
                                        <span class="text-xs">عنوان العمل: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->debtor->address2 }}</span></span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">الكفيل</h6>
                                        <span class="mb-2 text-xs">الاسم: <span class="text-dark font-weight-bold ms-sm-2">{{ $list->sponsor->name }}</span></span>
                                        <span class="mb-2 text-xs">الرقم الوطني: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->sponsor->id_number }}</span></span>
                                        <span class="text-xs">رقم الهاتف 1: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->sponsor->phone1 }}</span></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="mb-2 text-xs">رقم الهاتف 2: <span class="text-dark font-weight-bold ms-sm-2">{{ $list->sponsor->phone2 }}</span></span>
                                        <span class="mb-2 text-xs">رقم الهاتف 3: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->sponsor->phone3 }}</span></span>
                                        <span class="mb-2 text-xs">عنوان السكن: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->sponsor->address }}</span></span>
                                        <span class="text-xs">عنوان العمل: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->sponsor->address2 }}</span></span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">السيارة</h6>
                                        <span class="mb-2 text-xs">نوع: <span class="text-dark font-weight-bold ms-sm-2">{{ $list->car->type }}</span></span>
                                        <span class="mb-2 text-xs">موديل: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->car->model }}</span></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="mb-2 text-xs">رقم: <span class="text-dark font-weight-bold ms-sm-2">{{ $list->car->number }}</span></span>
                                        <span class="mb-2 text-xs">ترميز: <span class="text-dark ms-sm-2 font-weight-bold">{{ $list->car->encoding }}</span></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-19 ">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <select class="form-control" wire:model.live="status_search">
                            <option value="0">الكل</option>
                            <option value="1">مدفوع</option>
                            <option value="2">غير مدفوع</option>
                            <option value="3">مؤجل</option>
                            <option value="4">دفع جزء</option>
                        </select>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <dev class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">تاريخ القسط</th>
                                    <th scope="col">المبلغ</th>
                                    <th scope="col">العمليات</th>
                                    <th scope="col">دفع جزء</th>
                                    <th scope="col">الحالة</th>
                                    <th scope="col">الملاحظات</th>
                                    <th scope="col">#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($monthlyInstallmentsList as $key => $value)
                                    @if(($status_search > 0 && $status_search == $value['status']) || $status_search == 0)
                                        <tr>
                                            <th>{{ ++$key }}</th>
                                            <td>
                                                <input type="text" class="form-control"  value="{{ $value['month'] }}" disabled>
                                            </td>
                                            <td>
                                                @if($value['status'] == 1)
                                                    <input type="text" class="form-control" value="0" disabled>
                                                @else
                                                    <input type="text" class="form-control" value="{{ $value['installment'] }}" disabled>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm mb-0 me-3" style="background: green;color: white" wire:loading.attr="disabled"
                                                        wire:click="setMonthlyInstallments('{{ $value['month'] }}',1,{{ $value['installment'] }})">
                                                    <span wire:loading.remove wire.target="setMonthlyInstallments"><i class="fas fa-plus" aria-hidden="true"></i>  مدفوع</span>
                                                    <span wire:loading wire.target="setMonthlyInstallments" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                </button>
                                                <button class="btn btn-sm mb-0 me-3" style="background: red;color: white" wire:loading.attr="disabled"
                                                        wire:click="setMonthlyInstallments('{{ $value['month'] }}',2,{{ $value['installment'] }})">
                                                    <span wire:loading.remove wire.target="setMonthlyInstallments"><i class="fas fa-plus" aria-hidden="true"></i>  غير مدفوع</span>
                                                    <span wire:loading wire.target="setMonthlyInstallments" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                </button>
                                                <button class="btn btn-sm mb-0 me-3" style="background: blue;color: white" wire:loading.attr="disabled"
                                                        wire:click="setMonthlyInstallments('{{ $value['month'] }}',3,{{ $value['installment'] }})">
                                                    <span wire:loading.remove wire.target="setMonthlyInstallments"><i class="fas fa-plus" aria-hidden="true"></i>  مؤجل</span>
                                                    <span wire:loading wire.target="setMonthlyInstallments" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                </button>
                                                <button class="btn btn-sm mb-0 me-3" style="background: black;color: white" wire:loading.attr="disabled"
                                                        wire:click="partPayment('{{ $value['month'] }}')">
                                                    <span wire:loading.remove wire.target="partPayment"><i class="fas fa-plus" aria-hidden="true"></i>  دفع جزء</span>
                                                    <span wire:loading wire.target="partPayment" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                            <td style="display: flex">
                                                @if(isset($showPart[$value['month']]) && $showPart[$value['month']])
                                                    <input type="text" class="form-control" placeholder="القمية" wire:model.defer="deferred_value.{{$value['month']}}">
                                                    <button class="btn btn-sm mb-0 me-3" style="background: black;color: white" wire:loading.attr="disabled"
                                                            wire:click="setMonthlyInstallments('{{ $value['month'] }}',4,{{ $value['installment'] }},1)">
                                                        <span wire:loading.remove wire.target="setMonthlyInstallments"><i class="fas fa-plus" aria-hidden="true"></i>  دفع</span>
                                                        <span wire:loading wire.target="setMonthlyInstallments" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    </button>
                                                @else
                                                    <input type="text" class="form-control" disabled>
                                                @endif
                                            </td>
                                            <td>
                                                @if($value['status'] == 1)
                                                    <span class="badge badge-sm bg-gradient-success">مدفوع</span>
                                                @elseif($value['status'] == 2)
                                                    <span class="badge badge-sm bg-gradient-danger">غير مدفوع</span>
                                                @elseif($value['status'] == 3)
                                                    <span class="badge badge-sm bg-gradient-danger" style="background: blue">مؤجل</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger" style="background: black">دفع جزء</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"  placeholder="ملاحظات" wire:model.defer="note_vale.{{$value['month']}}">
                                            </td>
                                            <td>
                                                @if($value['status'] == 1)
                                                <a href="/received/voucher/{{ $value['id'] }}" class="text-secondary font-weight-bold text-xs" target="_blank">
                                                    <span style="color: #0d6efd">طباعة</span>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </dev>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
