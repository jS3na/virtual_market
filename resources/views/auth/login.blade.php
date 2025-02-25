<x-main_layout pageTitle="Login">

    <form action="{{ route('login.post') }}" method="post">

        @csrf

        <label for="email">
            <input type="email" name="email" placeholder="E-mail">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        <label for="password">
            <input type="password" name="password" placeholder="Password">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>

        @if (session('invalid_login'))
        <div class="alert alert-danger text-center mt-4">
            {{ session('invalid_login') }}
        </div>
        @endif

        <button type="submit">Login</button>
    </form>

</x-main_layout>