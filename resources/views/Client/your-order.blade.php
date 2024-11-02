@extends('layout.client')
<title>@yield('title', 'Đơn hàng')</title>
@section('body')
    @livewireStyles
    @livewire('YourOrder')
    @livewireScripts
@endsection
