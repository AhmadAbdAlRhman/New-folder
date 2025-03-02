@component('mail::message')

Dear {{ $data['name'] }},

{{ __('شكراً لاستخدامك ') }} <strong>{{ $data['plan_name'] }}</strong>. 
{{ __('سينتهي اشتراكك قريباً بتاريخ ') }} <strong>{{ $data['will_expire'] }}</strong>.
{{ __('يرجى تجديد الاشتراك') }}

@component('mail::table')
| {{ __('Description') }} | {{ __('Amount') }}  |
| :---------------------- | :------------------ |
@foreach ($data['contents'] ?? [] as $key => $content)
| {{$key}} | {{$content}} |
@endforeach

@endcomponent

@component('mail::button', ['url' => url($data['link']) ])
{{ __('تجديد الاشتراك الان') }}
@endcomponent


شكراً,<br>
{{ config('app.name') }}
@endcomponent