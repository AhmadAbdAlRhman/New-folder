@component('mail::message')
السلام عليكم،
مرحبا بك يا {{ $data['name'] }}

أسعدنا كثيرا انضمامكم لنا في مرسل وتجدون أدناه بيانات الدخول لحسابكم الجديد على موقعنا حيث يمكنكم زيارة الموقع عن طريق الضغط على الزر التالي

@component('mail::button', ['url' => url($data['link']) ])
{{ __('قم بالتسجيل الان') }}
@endcomponent

اسم المستخدم:<br>
{{ $data['email']}}
<br>
الرقم السري:<br>
{{ $data['password']}}
<br>

شرح الربط مع منصة سلة:
https://youtu.be/iROcMiVnyKc?si=F-4lyKA3zGL17BDg"

شكراً,<br>
{{ config('app.name') }}
@endcomponent