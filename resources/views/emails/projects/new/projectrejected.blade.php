@component('mail::message')
# Plan rechazado.


## Estimado/a {{$student->name}},

## Tu plan de proyecto de titulación con el tema: {{$project->title}}.
## Lastimosamente ha sido rechazado por la comisión.


Dirigete a la plataforma para conocer otras ideas o registrar otro plan.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}


@endcomponent
