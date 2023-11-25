@extends('layouts.app')
@section('title','Gestion des permissions')
@push('style')
    {{-- CSS complementaires --}}
@endpush

@section('content')

    @livewire('apps.permissions')

@endsection
@push('script')
    {{-- JS complementaires --}}
    <script >
        window.addEventListener('hidePermissionsModal',function (e) {
            $('#permissions_update_modal').modal('hide');

        });

        window.addEventListener('showEditPermissionsModal',function (e) {
            $('#permissions_update_modal').modal('show');
        });

        //reunitialisation du form dans le modal
        $('#permissions_update_modal').on('hidden.bs.modal',function (e) {
            Livewire.emit('resetForm');
        });

    </script>
@endpush

