@component('mail::message')
# Plan aprobado.


## Estimado/a {{$student->name}},

## Tu plan de proyecto de titulación registrado con el tema: {{$project->title}}.
## Ha sido aprobado por tu director {{$teacher->name}}.


Dirigete a la plataforma para conocer el siguiente paso.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}


@endcomponent
