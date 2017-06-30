@component('mail::message')
# Introduction

The body of your message.

-One
-Two
-Three

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@component('mail::panel', ['url' => ''])
Some panel body here.....
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

