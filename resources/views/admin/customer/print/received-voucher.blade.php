<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سند القبض</title>
    <style>body {
            font-family: Arial, sans-serif;
            direction: rtl;
        }

        .voucher {
            max-width: 690px;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }

        .voucher-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .voucher-header h2 {
            margin: 0;
        }

        .voucher-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .voucher-label {
            font-weight: bold;
        }

        .voucher-input {
            width: 65%;
            border-bottom: 1px dotted #000;
            padding-bottom: 2px;
        }

        .voucher-info {
            text-align: left;
            margin-bottom: 10px;
        } </style>
</head>
<body onload="window.print()">
<div class="voucher">
    <div style="display: flex;" class="voucher-header">
        <div style="display: block;margin-top: 100px;" class="voucher-row">
            <div style="margin-bottom: 20px;" class="voucher-label">التاريخ Date</div>
            <div style="width: 100%;" class="voucher-input">{{ $data['month'] }}</div>
        </div>
        <div style="width: 80%;">
            <h2>سند قبض</h2>
            <h2 style="text-decoration: underline; margin-bottom: 10px; text-underline-offset: 12px;">Received Voucher</h2>
            <div style="text-align: center;
                display: flex;
                justify-content: center;
                gap: 20px;" class="voucher-info">
                <div>
                    <p> فلس Fils </p>
                    <input type="text" size="5" readonly value="{{ $data['valuePart'] }}">
                </div>
                <div>
                    <p>دينار Dinar </p>
                    <input type="text" size="5" readonly value="{{ $data['value'] }}">
                </div>
            </div>
        </div>
    </div>
    <div class="voucher-row">
        <div class="voucher-label">وصلني من السيد / السادة</div>
        <div style="width: 56%;" class="voucher-input">{{ $data['name'] }}</div>
        <div class="voucher-label">Received From</div>
    </div>
    <div class="voucher-row">
        <div class="voucher-label">مبلغ وقدره</div>
        <div class="voucher-input">{{ $data['value_name'] }} دينار لا غير</div>
        <div class="voucher-label">The Sum Of</div>
    </div>
    <div class="voucher-row">
        <div class="voucher-label">وذلك عن</div>
        <div class="voucher-input">قسط شهري</div>
        <div class="voucher-label">Begin</div>
    </div>
    <div style="display: flex; gap: 20px;">
        <div style="width: 70%;" class="voucher-row">
            <div class="voucher-label">نقدا / شيك رقم</div>
            <div style="width: 48%;" class="voucher-input">{{ $data['note'] }}</div>
            <div class="voucher-label">Cash / Chq.no.</div>
        </div>
        <div style="width: 30%;" class="voucher-row">
            <div class="voucher-label">بتاريخ</div>
            <div style="width: 55%;" class="voucher-input">{{ $data['month'] }}</div>
            <div class="voucher-label">Date</div>
        </div>
    </div>
    <div style="width: 50%;" class="voucher-row">
        <div style="width: unset;" class="voucher-label">على بنك</div>
        <div class="voucher-input">{{ $data['note'] }}</div>
        <div class="voucher-label">Bank</div>
    </div>
    <div style="width: 50%;margin-right: auto;" class="voucher-row">
        <div style="width: unset;" class="voucher-label">توقيع المستلم</div>
        <div style="    width: 35%;" class="voucher-input"></div>
        <div class="voucher-label">Rec S. Sig.</div>
    </div>
</div>
</body>
</html>
