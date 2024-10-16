@extends('Client.components.header')
<title>
    @yield('title', 'Đăng ký')
</title>
@section('body')
@livewireStyles
@livewire('signup')
@livewireScripts
@endsection