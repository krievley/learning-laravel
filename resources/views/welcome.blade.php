@extends('layouts.base')

@section('body')
    <div class="container mx-auto">
        <div class="h-screen flex justify-center items-center">
            <div>
                <h1 class="text-7xl text-center">Ready Player?</h1>
                <div class="my-5 grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                    <x-buttons.fill-link href="/login" type="brand">Log In</x-buttons.fill-link>
                    <x-buttons.outline-link href="/register" type="dark">Sign Up</x-buttons.outline-link>
                </div>
            </div>
        </div>
    </div>
@endsection
