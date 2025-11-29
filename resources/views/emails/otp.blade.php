<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .box {
            padding: 20px;
            border: 1px solid #ddd;
            max-width: 400px;
        }
        .otp {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 5px;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="box">
        <h3>Sewage Truck Management System</h3>
        <p>Your Login OTP is:</p>
        <p class="otp">{{ $otp }}</p>
        <p>This OTP is valid for 10 minutes.</p>
        <p>If you did not request this, please ignore.</p>
    </div>
</body>
</html>
