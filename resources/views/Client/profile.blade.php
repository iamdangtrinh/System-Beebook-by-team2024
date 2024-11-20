@extends('layout.client')
<title>@yield('title', 'Hồ sơ')</title>
@section('body')
@livewireStyles
@livewire('profile')
@livewireScripts
@endsection