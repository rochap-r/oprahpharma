@extends('layouts.app')
@section('title','Les Unités pharmaceutiques')
@push('style')
    {{-- CSS complementaires --}}
@endpush

@section('content')
    @livewire('apps.unit')
@endsection
@push('script')
    <script >
        window.addEventListener('hideUnitModal',function (e) {
            $('#unit_modal').modal('hide');
        });

        window.addEventListener('showEditUnitModal',function (e) {
            $('#unit_modal').modal('show');
        });

        //reunitialisation du form dans le modal
        $('#unit_modal').on('hidden.bs.modal',function (e) {
            Livewire.emit('resetForm');
        });

        window.addEventListener('deleteUnit',function (event){
            swal.fire({
                title:event.detail.title,
                imageWidth:56,
                imageHeight:56,
                html:event.detail.html,
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:'Annuler',
                confirmButton: 'Oui, Supprimer',
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                width:500,
                allowOutsideClick:false
            }).then(function(result){
                if (result.value) {
                    Livewire.emit('deleteUnitAction',event.detail.id);
                }});
        })
    </script>
@endpush
