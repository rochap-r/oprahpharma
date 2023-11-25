@extends('layouts.app')
@section('title','Approvisionnement')
@push('style')
    {{-- CSS complementaires --}}
    <style>
        .select2-dropdown {
            z-index: 9999;
        }

    </style>
@endpush

@section('content')
    @livewire('apps.supplies')
@endsection
@push('script')
    <script>

        window.addEventListener('hideSupplyModal', function (e) {
            $('#supply_modal').modal('hide');
        });

        window.addEventListener('showEditSupplyModal', function (e) {
            $('#supply_modal').modal('show');
        });

        // Réinitialisation du formulaire dans la modale
        $('#supply_modal').on('hidden.bs.modal', function (e) {
            Livewire.emit('resetSupplyForm');
        });

        function handleProductInput(event) {
            const productName = event.target.value;

            Livewire.emit('searchProducts', productName);
        }

        window.addEventListener('deleteSupply', function (event) {
            swal.fire({
                title: event.detail.title,
                imageWidth: 56,
                imageHeight: 56,
                html: event.detail.html,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButton: 'Oui, Supprimer',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                width: 500,
                allowOutsideClick: false,
            }).then(function (result) {
                if (result.value) {
                    Livewire.emit('deleteSupplyAction', event.detail.id);
                }
            });
        });
        //select searchable
        // $(document).ready(function() {
        //     $('#product_id').selectize();
        // });

        // document.addEventListener("livewire:load", function(event) {
        //     $('#product_id').selectize();
        // });
        //
        // document.addEventListener("livewire:update", function(event) {
        //     $('#product_id').selectize();
        // });


    </script>
@endpush

