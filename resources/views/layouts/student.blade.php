@extends('layouts.base')

@section('body')
    <div 
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
    >
        <!-- Right content area -->
        <div class="flex flex-col flex-1 w-full">
            {{-- <!-- Header (auto height) -->
            @include('includes.header') --}}
            
            <!-- Main should fill remaining space and scroll if needed -->
            <main class="flex flex-col flex-1 min-h-0">
                @yield('content')
            </main>
        </div>
    </div>
@endsection
