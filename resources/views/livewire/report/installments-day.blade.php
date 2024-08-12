<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">عدد الاقساط المدفوعة</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ $total_installments_value }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-start">
                                        <div class="icon icon-shape bg-success shadow text-center border-radius-md">
                                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">مجموع الاقساط المدفوعة</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ $total_installments }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-start">
                                        <div class="icon icon-shape bg-success shadow text-center border-radius-md">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">عدد الاقساط الغير مدغوعة</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ $total_installments_1_value }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-start">
                                        <div class="icon icon-shape bg-danger shadow text-center border-radius-md">
                                            <i class="ni ni-fat-remove text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">مجموع الاقساط الغير مدغوعة</p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ $total_installments_1 }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-start">
                                        <div class="icon icon-shape bg-danger shadow text-center border-radius-md">
                                            <i class="ni ni-basket text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <th class="text-uppercase text-secondary font-weight-bolder">اسم المدين</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">السيارة</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">رقم الهاتف</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">موعد القسط</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">مبلغ القسط</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">الكشف التفصيلي</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $val)
                                <tr>
                                    <td>
                                        {{ $val->serial_number }}
                                    </td>
                                    <td>
                                        {{ $val->debtorName }}
                                    </td>
                                    <td>
                                        {{ $val->carName }}
                                    </td>
                                    <td>
                                        <a href="tel:{{ $val->phone }}">{{ $val->phone }}</a>
                                    </td>
                                    <td>
                                        {{ $this->serial_number_months[$val->serial_number]['date'] }}
                                    </td>
                                    <td>
                                        {{ $this->serial_number_months[$val->serial_number]['value'] }}
                                    </td>
                                    <td>
                                        <a href="/customer/detailed_disclosure/{{ $val->serial_number }}" target="_blank" class="font-weight-bold" style="color: #0d6efd" data-toggle="tooltip" data-original-title="Edit user">
                                            <span>الكشف التفصيلي</span>
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
