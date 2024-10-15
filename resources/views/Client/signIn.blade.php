@extends('Client.components.header')
<title>
    @yield('title', 'Đăng nhập')
</title>
@section('body')
@livewireStyles
@livewire('signin')
@livewireScripts
@endsection