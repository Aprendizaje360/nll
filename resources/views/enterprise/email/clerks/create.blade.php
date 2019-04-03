@component('mail::message')
# Mindwave

Se ha creado una cuenta de mindwave con los siguientes credenciales:

Nombre: {{$clerk->name}}

Correo: {{$clerk->email}}

Contraseña: {{$password}}

Tiene Permisos para las siguientes intervenciones

@foreach ($clerk->getPermittedInterventions()->get() as $intervention)

Nombre: {{$intervention->title}} <br>

@endforeach

Le recomendamos apuntar sus credenciales, borrar este correo y cambiar su contraseña.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
