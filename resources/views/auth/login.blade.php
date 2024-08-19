<x-guest-layout>

    <div class="">
        <h1 class="text-center mb-5">Inicia sesión</h1>
        <form class="d-flex flex-column gap-3 p-0" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address name:email -->
            <div>
                <label class="user-select-none form-label" for="email">Correo electrónico</label>
                <input class="w-100 form-control @error('email') text-danger @enderror" type="email"
                    placeholder="correo electrónico" name="email" id="email">
                @error('email')
                    <ul class="text-danger">
                        <li> {{ $message }} </li>
                    </ul>
                @enderror
            </div>

            <!-- Password name:password -->
            <div>
                <label class="user-select-none form-label" for="password">Contraseña</label>
                <input class="w-100 form-control @error('password') text-danger @enderror" type="password"
                    placeholder="contraseña" name="password" id="password">
                @error('password')
                    <ul class="text-danger">
                        <li> {{ $message }} </li>
                    </ul>
                @enderror
            </div>

            <!-- Remember Me name:remember -->
            <div class="d-flex align-items-center justify-content-start gap-3">
                <input class="form-check-input mt-0" name="remember" type="checkbox" id="remember">
                <label class="form-label" for="remember">Recordar usuario</label>
            </div>

            <div class="">
                <a href="{{ route('register') }}">
                    ¿Todavía no tienes una cuenta?
                </a>
            </div>

            <button type="submit" class="btn btn-secondary">Iniciar sesión</button>

        </form>
    </div>
</x-guest-layout>
