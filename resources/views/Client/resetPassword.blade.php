<title>
    @yield('title', 'Quên mật khẩu')
</title>
@extends('layout.client')
@section('body')
@livewireStyles
@livewire('reset-password')
@livewireScripts
@endsection