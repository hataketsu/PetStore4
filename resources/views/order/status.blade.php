@component('mail::message')
# You order status

Hello, {{$order->name}}


Thank you for buying at our shop

The order \#{{$order->id}} status is: {{$order->getTrạng thái()}}

@component('mail::button', ['url' => $url])
View Order
@endcomponent

If you have any questions, please contact us ({{Setting::get('contact','not set yet')}})

Thanks,<br>
{{ config('app.name') }}
@endcomponent