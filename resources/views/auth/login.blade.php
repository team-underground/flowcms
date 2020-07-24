@extends('flowcms::layouts.app')

@section('title')
Login
@stop

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('js-content').classList.add('animate', 'fadeIn');
    });
    document.addEventListener('turbolinks:load', () => {
        document.getElementById('js-content').classList.add('animate', 'fadeIn');
    });
</script>
@endpush

@section('content')
 <x-flowcms-section-centered class="md:mt-24" id="js-content" data-turbolinks="false">

    <a href="{{ url('/') }}" class="mb-8 block md:w-1/3 mx-auto text-center justify-center">
        @if(setting('site_logo') != '')
            <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name') }}" class="w-auto object-contain mx-auto">
        @else
            <span class="text-gray-800 font-bold text-xl md:text-2xl tracking-tight">{{ setting('site_name') }}</span>
        @endif
    </a>

    <x-flowcms-card class="md:max-w-sm md:mx-auto p-8">
        <h1 class="mb-4 text-gray-800 text-2xl heading text-center">Welcome Back!</h1>
        <x-flowcms-form action="{{ route('flowcms::login') }}" method="POST">
            <x-flowcms-text-input type="email" label="Email" name="email" />
            <x-flowcms-text-input type="password" label="Password" name="password" />
            <x-flowcms-button type="submit" class="w-full bg-gray-800 justify-center text-white">Log in</x-flowcms-button>
        </x-flowcms-form>
    </x-flowcms-card>

 </x-flowcms-section-centered>
@endsection
