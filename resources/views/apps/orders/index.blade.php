@extends('layouts.app')
@section('title','Page des Ventes')
@push('style')
    {{-- CSS complementaires --}}
    <style>

    </style>
@endpush

@section('content')
    @livewire('apps.cart')
@endsection
@push('script')
    <script>

        window.addEventListener('showCheckoutModal', function () {
            $('#checkout_modal').modal('show');
        });

        window.addEventListener('hideCheckoutModal', function (e) {
            $('#checkout_modal').modal('hide');

            // Émettre l'événement de rafraîchissement
            window.livewire.emit('updateCart');
        });


        window.addEventListener('clearSearch', function (e) {
            document.getElementById('input_search').value = '';
            // Remplacez 'yourSearchInputId' par l'ID de votre champ de recherche
        });
        //
        // window.addEventListener('showEditSupplyModal', function (e) {
        //     $('#supply_modal').modal('show');
        // });
        //
        // // Réinitialisation du formulaire dans la modale
        // $('#supply_modal').on('hidden.bs.modal', function (e) {
        //     Livewire.emit('resetSupplyForm');
        // });
        //
        // function handleProductInput(event) {
        //     const productName = event.target.value;
        //
        //     Livewire.emit('searchProducts', productName);
        // }
        //
        // window.addEventListener('deleteSupply', function (event) {
        //     swal.fire({
        //         title: event.detail.title,
        //         imageWidth: 56,
        //         imageHeight: 56,
        //         html: event.detail.html,
        //         showCloseButton: true,
        //         showCancelButton: true,
        //         cancelButtonText: 'Annuler',
        //         confirmButton: 'Oui, Supprimer',
        //         cancelButtonColor: '#d33',
        //         confirmButtonColor: '#3085d6',
        //         width: 500,
        //         allowOutsideClick: false,
        //     }).then(function (result) {
        //         if (result.value) {
        //             Livewire.emit('deleteSupplyAction', event.detail.id);
        //         }
        //     });
        // });

        // $(document).ready(function() {
        //     $('#product_id').selectize();
        // });

        //ce code bloque l'ajout au panier d'un produit avec une quantité superieur au stock
        window.addEventListener('quantity-error', function (event) {
            var quantity = event.detail.quantity;
            var quantityInStock = event.detail.quantityInStock;
            alert('La quantité spécifiée (' + quantity + ') est supérieure à la quantité en stock (' + quantityInStock + ')');
        });
        window.addEventListener('quantity-error-checkout', function (event) {
            var quantity = event.detail.quantity;
            alert('Désolé, vous ne pouvez pas passer une commande avec une quantité de ' +
                quantity + '. Veuillez sélectionner les produits que vous souhaitez commander.');

        });





    </script>


@endpush

