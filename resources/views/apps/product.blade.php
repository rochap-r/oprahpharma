@extends('layouts.app')
@section('title','Gestion de Produits pharmaceutiques')
@push('style')
    {{-- CSS complementaires --}}
@endpush

@section('content')
    @livewire('apps.product')
@endsection
@push('script')
    <script >
        window.addEventListener('hideProductModal',function (e) {
            $('#product_modal').modal('hide');
        });

        window.addEventListener('showEditProductModal',function (e) {
            $('#product_modal').modal('show');
        });

        //reunitialisation du form dans le modal
        $('#product_modal').on('hidden.bs.modal',function (e) {
            Livewire.emit('resetForm');
        });

        window.addEventListener('deleteProduct',function (event){
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
                    Livewire.emit('deleteProductAction',event.detail.id);
                }});
        })
    </script>
@endpush
