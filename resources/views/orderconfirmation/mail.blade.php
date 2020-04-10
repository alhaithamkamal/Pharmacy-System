@component('mail::message')
# Introduction

please confirm or cancel the order.

@component('mail::button', ['url' => $confirm])
Confirm
@endcomponent

@component('mail::button', ['url' => $cancel])
Cancel
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
