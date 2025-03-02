<!DOCTYPE html>
<html>
<head>
    <title>Redirecting...</title>
    <meta http-equiv="refresh" content="3;url={{ $paymentLink }}">
    <script type="text/javascript">
        // استخدام JavaScript لإعادة التوجيه مع إخفاء referrer
        window.location.href = "{{ $paymentLink }}";
    </script>
</head>
<body>
<p>Redirecting to payment...</p>
<noscript>
    <meta http-equiv="refresh" content="0;url={{ $paymentLink }}">
</noscript>
</body>
</html>
