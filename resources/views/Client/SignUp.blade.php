@extends('layout.client')

<title>
    @yield('title', 'Đăng ký')
</title>
@section('body')
@livewireStyles
@livewire('signup')
@livewireScripts
@endsection