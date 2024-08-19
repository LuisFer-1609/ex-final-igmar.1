<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Resultados de evaluación</title>

    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;

            font-family: system-ui;
        }

        .cards__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            justify-content: center;
            gap: 50px;
            padding: 20px;
        }

        .card {
            display: flex;
            flex-direction: column;

            border: 1px solid #efefef;
            padding: 20px;
            border-radius: 10px;

            color: rgb(0 0 0 / 50%);

            .card__title {
                text-align: center;
                margin-bottom: 20px;
            }

            .card__body {
                display: flex;
                flex-direction: column;
                font-size: 14px;
            }

            .card__footer {
                text-align: end;
            }
        }

        .card__body__input {
            width: 100%;
            border: 0;
            padding: 5px 10px;
            outline: 1px solid #d8d8d8;
            border-radius: 5px;

            color: rgb(0 0 0 / 50%);
        }

        .is-valid-check {
            display: none;
        }

        .card__body__input.is-valid {
            outline: 1px solid green;

            ~.is-valid-check {
                display: block;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 10px;
            }
        }

        .is-invalid-check {
            display: none;
        }

        .card__body__input.is-invalid {
            outline: 1px solid rgb(255, 0, 0);

            ~.is-invalid-check {
                display: block;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 10px;
            }
        }
    </style>
</head>

<body class="">
    <main>
        <h1 class="">{{ $evaluacion->id }}: {{ $evaluacion->nombre }}</h1>

        <section class="cards__grid">
            @foreach ($respuestas as $respuesta)
                <article class="card">
                    <header class="card__title">
                        <h1 style="color: {{ $respuesta->es_correcta === 1 ? 'green' : 'red' }};">
                            {{ $respuesta->es_correcta === 1 ? 'Correcta' : 'Incorrecta' }}</h1>
                    </header>
                    <div class="card__body">
                        <label for="">{{ $respuesta->descripcion }} {{ $respuesta->operando_uno }}
                            {{ $respuesta->tipo === 'suma' ? '+' : false }}
                            {{ $respuesta->tipo === 'resta' ? '-' : false }}
                            {{ $respuesta->tipo === 'multiplicacion' ? '*' : false }}
                            {{ $respuesta->tipo === 'division' ? '/' : false }}

                            {{ $respuesta->operando_dos }}</label>
                        <div style="position: relative">
                            <input
                                class="card__body__input {{ $respuesta->es_correcta === 1 ? 'is-valid' : 'is-invalid' }} "
                                type="text"
                                value="{{ $respuesta->es_correcta === 1 ? $respuesta->respuesta : 'respuesta correcta: ' . $respuesta->respuesta_correcta }}"
                                style="flex-grow: 1" />
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#155908" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="is-valid-check icon icon-tabler icons-tabler-outline icon-tabler-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#ff0000" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="is-invalid-check icon icon-tabler icons-tabler-outline icon-tabler-x">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M18 6l-12 12" />
                                <path d="M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                    <footer class="card__footer">
                        <small style="font-weight: 700">{{ $respuesta->created_at }}</small>
                    </footer>
                </article>
            @endforeach
        </section>

        <a href="{{ $signedUrl }}">Descargar en formato PDF</a>

    </main>
</body>

</html>
