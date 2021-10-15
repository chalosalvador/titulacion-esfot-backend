@component('mail::message')
# Proyecto calificado por el jurado.

## Estimado/a {{$student->name}},

## Es un agrado informarte que el jurado ha calificado tu proyecto con el tema: {{$project->title}}.

## Revisa los siguientes pasos para continuar con tu proceso de graduación.

## Por favor espera la autorización para una fecha de defensa.
@component('mail::button', ['url' => 'https://titulacion-esfot-frontend-p62owr52w-titulacion.vercel.app/', 'color' => 'success'])
    Ir a la plataforma
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
