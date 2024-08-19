<x-guest-layout>

    <div class="">
        <h1 class="text-center mb-5">Sign up now</h1>
        <form class="d-flex flex-column gap-3 p-0" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="d-flex flex-row gap-3">
                <!-- Name name:name -->
                <div class="flex-grow-1">
                    <input class="w-100 form-control @error('name') text-danger @enderror" type="text"
                        placeholder="nombre" name="name" id="name" value="{{ old('name') }}">
                    @error('name')
                        <ul class="text-danger">
                            <li> {{ $message }} </li>
                        </ul>
                    @enderror
                </div>

                <!-- Lastname name:lastname -->
                <div class="flex-grow-1">
                    <input class="w-100 form-control @error('lastname') text-danger @enderror" type="text"
                        placeholder="apellidos" name="lastname" id="lastname" value="{{ old('lastname') }}">
                    @error('lastname')
                        <ul class="text-danger">
                            <li> {{ $message }} </li>
                        </ul>
                    @enderror
                </div>
            </div>

            <!-- Email Address name:email -->
            <div>
                <input class="w-100 form-control @error('email') text-danger @enderror" type="email"
                    placeholder="correo electrónico" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <ul class="text-danger">
                        <li> {{ $message }} </li>
                    </ul>
                @enderror
            </div>

            <!-- Password name:password -->
            <div>
                <input class="w-100 form-control @error('password') text-danger @enderror" type="password"
                    placeholder="contraseña" name="password" id="password" value="{{ old('password') }}">
                @error('password')
                    <ul class="text-danger">
                        <li> {{ $message }} </li>
                    </ul>
                @enderror
            </div>

            <input type="number" name="rol" value="0" hidden>

            <div class="">
                <a href="{{ route('login') }}">
                    ¿Ya estás registrado?
                </a>
            </div>

            <button type="submit" class="btn btn-secondary">Iniciar sesión</button>

        </form>
    </div>
</x-guest-layout>
