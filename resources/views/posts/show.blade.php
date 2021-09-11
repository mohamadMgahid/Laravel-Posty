@extends('layouts.app')

@Section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <x-post :post="$post"></x-post>
        </div>
    </div>
    
@endsection