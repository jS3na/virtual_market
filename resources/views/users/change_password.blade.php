<x-main_layout pageTitle="Change User Password">

    <form action="{{ route('users.change_password.post') }}" method="post">

        @csrf
        @method('PUT')

        <label for="actual_password">
            <input type="password" name="actual_password" placeholder="Actual Password">
            @error('actual_password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        <label for="new_password">
            <input type="password" name="new_password" placeholder="New Password">
            @error('new_password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>
        <label for="new_password_confirmation">
            <input type="password" name="new_password_confirmation" placeholder="New Password Confirmation">
            @error('new_password_confirmation')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </label>

        @if (session('invalid_form'))
        <div class="alert alert-danger text-center mt-4">
            {{ session('invalid_form') }}
        </div>
        @endif

        <button type="submit">Change</button>
    </form>

</x-main_layout>