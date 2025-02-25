<x-main_layout pageTitle="Register">

    <form action="{{ route('register.post') }}" method="post">

        @csrf

        <label for="name">
            <input type="name" name="name" placeholder="Name">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
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

        <button type="submit">Register</button>
    </form>
    
    <a href="{{ route('login') }}">Login</a>

</x-main_layout>