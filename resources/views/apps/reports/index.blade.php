@extends('layouts.app')
@section('title','Rapport de vente')
@push('style')
    {{-- CSS complementaires --}}
@endpush

@section('content')
    @livewire('apps.report')
@endsection
@push('script')
    {{-- JS complementaires --}}
@endpush
