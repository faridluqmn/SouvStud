@extends('layout.main')
@section('content')
<div class="header">
    <h2 class="coupon-title">Semua Kupon yang Tersedia</h2>
</div>
<div class="coupon-container">
    @foreach ($coupons as $item)
        <div class="coupon-card {{ strtotime($item->exp_date) < strtotime(now()) ? 'expired' : '' }}">
            <div class="coupon-header">
                <h3>{{ $item->kode }}</h3>
                <span class="coupon-type">{{ $item->tipe }}</span>
            </div>
            <div class="coupon-body">
                <p class="coupon-value">Diskon: <strong>{{ $item->value }}</strong></p>
                <p class="coupon-expiry">Berlaku hingga: <strong>{{ date('d M Y', strtotime($item->exp_date)) }}</strong></p>
            </div>
            <div class="coupon-footer">
                @if (strtotime($item->exp_date) >= strtotime(now()))
                    <button class="copy-code" onclick="copyToClipboard('{{ $item->kode }}')">Salin Kode</button>
                @else
                    <span class="expired-text">Kupon Kedaluwarsa</span>
                @endif
            </div>
        </div>
    @endforeach
</div>

    <script>
        function copyToClipboard(code) {
            navigator.clipboard.writeText(code).then(() => {
                alert('Kode kupon ' + code + ' telah disalin!');
            });
        }
    </script>

    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: sans-serif;
        }

        .coupon-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .coupon-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #222;
        }

        .coupon-card {
            border: 2px dashed #ff9800;
            border-radius: 12px;
            padding: 20px;
            width: 280px;
            background: #ffffff;
            text-align: center;
            box-shadow: 0 4px 10px rgba(255, 152, 0, 0.3);
            transition: transform 0.3s ease-in-out;
        }

        .coupon-card:hover {
            transform: scale(1.05);
        }

        .expired {
            border-color: #d32f2f;
            background: #f8d7da;
        }

        .coupon-header h3 {
            margin: 0;
            color: #ff9800;
            font-size: 20px;
        }

        .coupon-type {
            font-size: 14px;
            background: #ff9800;
            padding: 5px 10px;
            border-radius: 5px;
            color: #000;
            font-weight: bold;
        }

        .coupon-body p {
            margin: 10px 0;
            font-size: 16px;
        }

        .coupon-expiry {
            color: #e65100;
        }

        .coupon-footer button {
            background: #ff9800;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: background 0.3s;
        }

        .coupon-footer button:hover {
            background: #e68900;
        }

        .expired-text {
            color: #d32f2f;
            font-weight: bold;
        }
    </style>
@endsection
