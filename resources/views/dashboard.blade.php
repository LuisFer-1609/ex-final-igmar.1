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

    @if (Auth::user()->rol === 1)
        <div class="table-responsive">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $index => $usuario)
                        @if ($usuario->rol === 1)
                            <tr>
                                <td> {{ $index + 1 }} </td>
                                <td> {{ $usuario->name }} </td>
                                <td> {{ $usuario->lastname }} </td>
                                <td> {{ $usuario->email }} </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif (Auth::user()->rol === 0)
        <section class="flex-grow-1 d-flex flex-column justify-content-center">
            <form action="{{ url('post-evaluacion') }}" method="POST">
                @csrf
                <article class="flex-grow-1 tabs">
                    <input class="tabs__input" type="radio" name="operaciones" id="suma" checked>
                    <label class="tabs__label" for="suma">Suma</label>
                    <article class="tabs__article">
                        @foreach ($sumas as $index => $suma)
                            <div class="col-sm-12 col-md-5">
                                <span style="font-size: 14px">
                                    {{ $suma['descripcion'] }} {{ $suma['operando_uno'] }} +
                                    {{ $suma['operando_dos'] }}
                                </span>
                                <input class="form-control" name="respuestas[suma][{{ $index }}]" type="text"
                                    placeholder="respuesta">
                            </div>
                        @endforeach
                    </article>
                    <input class="tabs__input" type="radio" name="operaciones" id="resta">
                    <label class="tabs__label" for="resta">Resta</label>
                    <article class="mt-auto tabs__article">
                        @foreach ($restas as $index => $resta)
                            <div class="col-sm-12 col-md-5">
                                <span style="font-size: 14px">
                                    {{ $resta['descripcion'] }} {{ $resta['operando_uno'] }} -
                                    {{ $resta['operando_dos'] }}
                                </span>
                                <input class="form-control" name="respuestas[resta][{{ $index }}]"
                                    type="text" placeholder="respuesta">
                            </div>
                        @endforeach
                    </article>

                    <input class="tabs__input" type="radio" name="operaciones" id="multiplicacion">
                    <label class="tabs__label" for="multiplicacion">Multiplicación</label>
                    <article class="tabs__article">
                        @foreach ($multiplicaciones as $index => $multiplicacion)
                            <div class="col-sm-12 col-md-5">
                                <span style="font-size: 14px">
                                    {{ $multiplicacion['descripcion'] }} {{ $multiplicacion['operando_uno'] }} *
                                    {{ $multiplicacion['operando_dos'] }}
                                </span>
                                <input class="form-control" name="respuestas[multiplicacion][{{ $index }}]"
                                    type="text" placeholder="respuesta">
                            </div>
                        @endforeach
                    </article>

                    <input class="tabs__input" type="radio" name="operaciones" id="division">
                    <label class="tabs__label" for="division">División</label>
                    <article class="mt-auto tabs__article">
                        @foreach ($divisiones as $index => $divisiones)
                            <div class="col-sm-12 col-md-5">
                                <span style="font-size: 14px">
                                    {{ $divisiones['descripcion'] }} {{ $divisiones['operando_uno'] }} /
                                    {{ $divisiones['operando_dos'] }}
                                </span>
                                <input class="form-control" name="respuestas[division][{{ $index }}]"
                                    type="text" placeholder="respuesta">
                            </div>
                        @endforeach

                        <button>Terminar</button>
                    </article>
                </article>
                <input type="text" name="lastId" hidden value="{{ $lastId }}">
            </form>
        </section>
    @endif

    <style>
        span .w-5 {
            display: none;
        }

        .tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap
        }

        .tabs__input {
            display: none;
        }

        .tabs__label {
            margin-top: 50px;
            padding: 5px 15px;
            user-select: none;
            order: 1;

            cursor: pointer;

            border-radius: 10px;
        }

        .tabs__label:hover {
            background-color: rgba(255, 255, 255, 0.6);
        }

        .tabs__article {
            width: 100%;
            margin-top: auto;
            display: none;
            flex-wrap: wrap;
            justify-content: center;
            gap: 100px;
        }

        .tabs__input:checked+.tabs__label {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .tabs__input:checked+.tabs__label+.tabs__article {
            display: flex;
        }
    </style>

</x-app-layout>
