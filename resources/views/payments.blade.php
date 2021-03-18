@extends('base')

@section('css')
    @livewireStyles
@endsection

@section('js')
    @livewireScripts
@endsection

@section('content')
    @livewire('payments')
@endsection
