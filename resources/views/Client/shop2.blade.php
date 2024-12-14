@extends('layout.client')
@section('title', 'Cửa hàng')
@section('body')
    @livewire('shopLiveWire', ['type' => $type ?? 'index', 'slug' => $slug ?? null])
@endsection
