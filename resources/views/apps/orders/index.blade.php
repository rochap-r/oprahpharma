@extends('layouts.app')
@section('title', 'Page des Ventes')
@push('style')
    {{-- CSS complementaires --}}
    <style>
        /* Pour les tablettes et smartphones */
        @media only screen and (max-width: 768px) {
            .table {
                width: 100%;
                max-width: 600px; /* Limite la largeur du tableau */
                margin: 0 auto; /* Centre le tableau sur l'écran */
            }

            .table th,
            .table td {
                font-size: 70%;
                padding: 5px;
                margin-top: 10px;
            }

            .table tfoot td {
                text-align: center;
            }

            .table tfoot button {
                font-size: 95%;
                padding: 10px 20px; /* Ajustez le padding pour une taille adaptée */
            }


        }
    </style>
@endpush

@section('content')
    @livewire('apps.cart')
@endsection
@push('script')
    <script>
        window.addEventListener('showCheckoutModal', function() {
            var modalElement = document.getElementById('checkout_modal');
            var modal = new bootstrap.Modal(modalElement, {
                backdrop: 'static', // Empêche l'utilisateur de fermer la fenêtre en cliquant à l'extérieur
                keyboard: false // Empêche l'utilisateur de fermer la fenêtre en appuyant sur ECHAP
            });
            modal.show();
        });


        window.addEventListener('hideCheckoutModal', function(e) {
            $('#checkout_modal').modal('hide');

            // Émettre l'événement de rafraîchissement
            window.livewire.emit('updateCart');
        });


        window.addEventListener('clearSearch', function(e) {
            document.getElementById('input_search').value = '';
            // Remplacez 'yourSearchInputId' par l'ID de votre champ de recherche
        });

        //ce code bloque l'ajout au panier d'un produit avec une quantité superieur au stock
        window.addEventListener('quantity-error', function(event) {
            var quantity = event.detail.quantity;
            var quantityInStock = event.detail.quantityInStock;
            alert('La quantité spécifiée (' + quantity + ') est supérieure à la quantité en stock (' +
                quantityInStock + ')');
        });

        //ce code bloque l'ajout au panier d'un produit avec une quantité superieur au stock
        window.addEventListener('quantity-extist-error', function(event) {
            var quantity = event.detail.quantity;
            var quantityInStock = event.detail.quantityInStock;
            alert('La quantité spécifiée (' + quantity + ') est supérieure à la quantité en stock (' +
                quantityInStock + ')');
        });

        window.addEventListener('quantity-error-empty', function(event) {
            var quantity = event.detail.quantity;
            alert('Désolé, vous ne pouvez pas ajouter un produit au panier avec (' + quantity + ') comme quantité');
        });

        window.addEventListener('quantity-error-checkout', function(event) {
            var quantity = event.detail.quantity;
            alert('Désolé, vous ne pouvez pas passer une commande avec une quantité de ' +
                quantity + '. Veuillez sélectionner les produits que vous souhaitez commander.');

        });
    </script>
@endpush
