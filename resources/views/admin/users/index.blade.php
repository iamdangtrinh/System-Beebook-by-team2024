<title>@yield('title', 'Tài khoản')</title>
@extends('layout.admin')

@section('body')
@livewireStyles
@livewire('user-admin')
@livewireScripts
<script src="{{ asset('/') }}backend/js/product/index.js"></script>
@endsection