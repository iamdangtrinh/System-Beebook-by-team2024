<title>@yield('title', 'Bài viết')</title>
@extends('layout.admin')
@section('body')
@livewireStyles
@livewire('blog-admin')
@livewireScripts
@endsection