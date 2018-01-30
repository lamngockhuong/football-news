@component('mail::message')
# @lang('auth.confirm_email_content.title')

@lang('auth.confirm_email_content.message', ['name' => $name, 'app_name' => config('app.name')])

@component('mail::button', ['url' => $url])
    @lang('auth.confirm_email_content.confirm_button')
@endcomponent

<div style="text-align:center">{{ $url }}</div>

@lang('auth.confirm_email_content.thanks')
<br>
{{ config('app.name') }}
@endcomponent
