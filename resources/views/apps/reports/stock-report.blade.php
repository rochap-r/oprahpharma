@extends('layouts.app')
@section('title','Rapport de stock')
@push('style')
    {{-- CSS complementaires --}}
@endpush

@section('content')
    @livewire('apps.stock-report')
@endsection
@push('script')
    {{-- JS complementaires --}}
@endpush
