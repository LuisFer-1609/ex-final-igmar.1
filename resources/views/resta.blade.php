<x-app-layout>


    @if (session('success'))
        <div class="fadeIn position-fixed w-auto d-flex flex-row gap-3 align-items-center text-white p-3"
            style="transition: opacity 0.3s ease-out; bottom: 10px; right: 10px; border-radius:10px; background-color:rgb(45, 45, 45); z-index:1;"
            id="success">
            <x-info-svg color="text-success" />
            {{ session('success') }}
        </div>
    @endif

    @if (session('failed'))
        <div class="fadeIn position-fixed w-auto d-flex flex-row gap-3 align-items-center text-white p-3"
            style="transition: opacity 0.3s ease-out; bottom: 10px; right: 10px; border-radius:10px; background-color:rgb(45, 45, 45); z-index: 1;"
            id="failed">
            <x-info-svg color="text-danger" />
            {{ session('failed') }}
        </div>
    @endif

    @error('nombre')
        <div class="fadeIn position-fixed w-auto d-flex flex-row gap-3 align-items-center text-white p-3"
            style="transition: opacity 0.3s ease-out; bottom: 10px; right: 10px; border-radius:10px; background-color:rgb(45, 45, 45); z-index: 1;"
            id="error-nombre">
            <x-info-svg color="text-danger" />
            {{ $message }}
        </div>
    @enderror
    @if (Auth::user()->rol === 0)
        <h1 class="text-center">Resta</h1>
        <section class="flex-grow-1 d-flex flex-column justify-content-center">
            <form action="w-full">
                <div class="row">
                    <div class="col-6 d-flex flex-column gap-5">
                        <div>
                            <label for="">¿Cuál es el resultado de la suma 101 + 111?</label>
                            <input class="form-control" type="text">
                        </div>
                        <div>
                            <label for="">¿Cuál es el resultado de la suma 101 + 111?</label>
                            <input class="form-control" type="text">
                        </div>
                        <div>
                            <label for="">¿Cuál es el resultado de la suma 101 + 111?</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-evenly gap-5">
                        <div>
                            <label for="">¿Cuál es el resultado de la suma 101 + 111?</label>
                            <input class="form-control" type="text">
                        </div>
                        <div>
                            <label for="">¿Cuál es el resultado de la suma 101 + 111?</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="{{ url('dashboard') }}">1</a></li>
                <li class="page-item"><a class="page-link" href="{{ url('resta') }}">2</a></li>
                <li class="page-item"><a class="page-link" href="{{ url('multiplicacion') }}">3</a></li>
                <li class="page-item"><a class="page-link" href="{{ url('division') }}">4</a></li>
            </ul>
        </nav>
    @endif


</x-app-layout>
