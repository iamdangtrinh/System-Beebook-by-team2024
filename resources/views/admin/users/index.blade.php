<title>@yield('title', 'Tài khoản')</title>
@extends('layout.admin')

@section('body')
@livewireStyles
@livewire('user-admin')
@livewireScripts
<script src="{{ asset('/') }}backend/js/product/index.js"></script>
<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
<script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
@endsection