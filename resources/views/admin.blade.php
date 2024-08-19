<x-app-layout>
    <h1>Evaluaciones</h1>
    @foreach ($evaluaciones_hechas as $evaluacion)
        <article class="d-flex flex-column justify-content-between gap-2 bg-white px-4 pt-4 pb-1 rounded">
            <div class="d-flex justify-content-between">
                <header>
                    {{ $evaluacion->user->name }}
                </header>
                <span>
                    Evaluación que realizó: {{ $evaluacion->evaluacion->nombre }}
                </span>
                <span>
                    <a href="{{ $evaluacion->signed_url }}" target="_blank">Revisa el resultado en PDF</a>
                </span>
            </div>
            <footer class="fw-bold text-end" style="font-size: 13px;">
                <span>
                    {{ $evaluacion->created_at }}
                </span>
            </footer>
        </article>
    @endforeach
    <span></span>
</x-app-layout>
