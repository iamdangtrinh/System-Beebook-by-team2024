<title>
    @yield('title', 'Nhập Mật Khẩu')
</title>
@extends('layout.client')
@section('body')
@livewireStyles
<livewire:confirm-password :token=$token />
@livewireScripts
@endsection