@extends('layouts.app')
@section('title','Rapport d\'expiration des produits')
@push('style')
    {{-- CSS complementaires --}}
@endpush

@section('content')
    @livewire('apps.expiration-report')
@endsection
@push('script')
    {{-- JS complementaires --}}
@endpush
