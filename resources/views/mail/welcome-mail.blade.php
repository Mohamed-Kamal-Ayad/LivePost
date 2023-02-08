@component("mail::message")

    # Welcome {{$user->name}} to {{ config('app.name') }}
    Thanks for signing up!,
    {{ config('app.name') }}
@component('mail::button', ['url' => ''])
Redirect
@endcomponent

@endcomponent




