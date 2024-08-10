<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>الكشف التفصيلي</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box rtl">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            أحمد عيال غانم
                        </td>
                        <td>
                            مرهون الى:{{ $list->pawned->name }}<br>
                            الحالة:{{ $list->status == 2 ? 'مكتمل' : 'غير مكتمل'}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            المدين<br/>
                            <span>الاسم: <span>{{ $list->debtor->name }}</span></span>
                            <br/>
                            <span>الرقم الوطني: <span>{{ $list->debtor->id_number }}</span></span>
                            <br/>
                            <span>رقم الهاتف 1: <span>{{ $list->debtor->phone1 }}</span></span>
                            <br/>
                            <span>رقم الهاتف 2: <span>{{ $list->debtor->phone2 }}</span></span>
                            <br/>
                            <span>رقم الهاتف 3: <span>{{ $list->debtor->phone3 }}</span></span>
                            <br/>
                            <span>عنوان السكن: <span>{{ $list->debtor->address }}</span></span>
                            <br/>
                            <span>عنوان العمل: <span>{{ $list->debtor->address2 }}</span></span>
                        </td>
                        <td style="text-align: unset;">
                            الكفيل<br/>
                            <span>الاسم: <span>{{ $list->sponsor->name }}</span></span>
                            <br/>
                            <span>الرقم الوطني: <span>{{ $list->sponsor->id_number }}</span></span>
                            <br/>
                            <span>رقم الهاتف 1: <span>{{ $list->sponsor->phone1 }}</span></span>
                            <br/>
                            <span>رقم الهاتف 2: <span>{{ $list->sponsor->phone2 }}</span></span>
                            <br/>
                            <span>رقم الهاتف 3: <span>{{ $list->sponsor->phone3 }}</span></span>
                            <br/>
                            <span>عنوان السكن: <span>{{ $list->sponsor->address }}</span></span>
                            <br/>
                            <span>عنوان العمل: <span>{{ $list->sponsor->address2 }}</span></span>
                        </td>
                        <td>
                            السيارة<br/>
                            <span>نوع: <span>{{ $list->car->type }}</span></span>
                            <br/>
                            <span>موديل: <span>{{ $list->car->model }}</span></span>
                            <br/>
                            <span>رقم: <span>{{ $list->car->number }}</span></span>
                            <br/>
                            <span>ترميز: <span>{{ $list->car->encoding }}</span></span>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="2">
                <table>
                    <tr class="heading">
                        <td>تاريخ بدء اول قسط :{{ date_format($totals['first_installment_date'] ,"Y-m-d") }}</td>
                        <td style="text-align: unset;">السعر الاجمالي: {{ $totals['total_price'] }}</td>
                        <td>الدفهة الاولة: {{ $totals['first_batch'] }}</td>
                    </tr>
                    <tr class="heading">
                        <td>القسط الشهري :{{ $totals['monthly_installment'] }}</td>
                        <td style="text-align: unset;">مجموع الاقساط : {{ $totals['total_installments'] }}</td>
                        <td>عدد الاشهر : {{ ceil($totals['number_of_months']) }}</td>
                    </tr>
                    <tr class="heading">
                        <td>عدد الاقساط المدفوعة :{{ ceil($totals['total_installments_1']) }}</td>
                        <td style="text-align: unset;">عدد الاقساط الغير مدفوعة : {{ ceil($totals['total_installments_2']) }}</td>
                        <td>المتبقي :{{ $totals['total_installments_2_total'] }}</td>
                    </tr>
                    <tr class="heading">
                        <td>المبلغ الاجمالي المدفوع : {{ $totals['total_installments_1_total'] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="2">
                <table>
                    <tr class="heading">
                        <td>#</td>
                        <td style="text-align: unset;">تاريخ القسط</td>
                        <td>المبلغ</td>
                        <td>دفع جزء</td>
                        <td>الحالة</td>
                        <td>الملاحظات</td>
                    </tr>
                    @foreach($monthlyInstallmentsList as $key => $value)
                        <tr class="item">
                            <td>{{ ++$key }}</td>
                            <td style="text-align: start">{{ $value['month'] }}</td>
                            <td>
                                @if($value['status'] == 1)
                                    0
                                @else
                                    {{ $value['installment'] }}
                                @endif
                            </td>
                            <td>
                                @if(isset($showPart[$value['month']]) && $showPart[$value['month']])
                                    {{ $deferred_value[$value['month']] }}
                                @else

                                @endif
                            </td>
                            <td>
                                @if($value['status'] == 1)
                                    <span>مدفوع</span>
                                @elseif($value['status'] == 2)
                                    <span>غير مدفوع</span>
                                @elseif($value['status'] == 3)
                                    <span>مؤجل</span>
                                @else
                                    <span>دفع جزء</span>
                                @endif
                            </td>
                            <td>{{ $note_vale[$value['month']] ?? '' }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
