@component('mail::message')
    # Informe aprobado.
    ## El informe de: {{$project->title}}.
    ## Tu director {{$project->teacher->name}} ha aprobado el envío del pdf.
    ## Dirigete a la plataforma para enviarlo.


@endcomponent
