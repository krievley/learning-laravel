@extends('layouts.base')

@section('body')
    <div class="container mx-auto">
        <div class="h-screen flex justify-center items-center">
            <div>
                <h1 class="text-7xl text-center">Ready Player?</h1>
                <div class="my-5 grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                    <a href="/login" class="text-center">Log In</a>
                    <a href="/register" class="text-center">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
@endsection
