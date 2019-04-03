@component('mail::message')
# NML

Estimado {{$user->name}} {{$user->lastName}},

Ingresa aquí para descargar tus resultados de la intervención {{$intervention->title}}.

@component('mail::button', ['url' => $resultsUrl])
Descargar Resultados
@endcomponent

Despues de llevar acabo la intervención sirvase borrar el correo.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
