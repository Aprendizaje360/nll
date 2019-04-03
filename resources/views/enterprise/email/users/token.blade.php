@component('mail::message')
# NML

Estimado {{$user->name}} {{$user->lastName}},

El token para la intervención {{$intervention->title}} es : {{$token}}

Despues de llevar acabo la intervención sirvase borrar el correo.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
