@extends('layout.client')
@section('title', 'Cửa hàng')
@section('body')
    @livewireStyles
    @livewire('shopLiveWire', ['type' => $type ?? 'index', 'slug' => $slug ?? null])
    @livewireScripts
@endsection
