@extends('layouts.app')
@section('title', 'Gestion d\'Utilisateurs')
@section('style')
    {{-- CSS complementaires --}}
@endsection
@section('content')


    @livewire('users.index')


@endsection
@push('script')
    <script>
        $(window).on('hidden.bs.modal', function() {
            Livewire.emit('resetForms');
        });
        window.addEventListener('hide_add_user_modal', function(event) {
            $('#modal-user').modal('hide');
        });
        window.addEventListener('showEditUserModal', function(event) {
            $('#modal-user-edit').modal('show')
        });
        window.addEventListener('hide_modal-user-edit', function(event) {
            Livewire.emit('UpdateHeader');
            $('#modal-user-edit').modal('hide');
        })
        window.addEventListener('deleteUser',function(event){
            swal.fire({
                title:event.detail.title,
                imageWidth:96,
                imageHeight:96,
                html:event.detail.html,
                showCloseButton:true,
                showCancelButton:true,
                cancelButtonText:'Annuler',
                confirmButtonText:'Oui, Supprimer',
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                width:400,
                allowOutsideClick:false
            }).then(function(result){
                if (result.value) {
                    Livewire.emit('deleteUserAction',event.detail.id);
                }
            });
        })
    </script>
@endpush

