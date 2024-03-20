@extends('layouts.app')
@section('title', 'Page des Ventes')
@push('style')
    {{-- CSS complementaires --}}
    <style>
        /* Pour les tablettes et smartphones avec une résolution de 800 x 1280 pixels */
        @media only screen and (max-width: 820px)  {
            .table {
                width: 100%;
                margin: 0 auto; /* Centre le tableau sur l'écran */
            }

            .table th,
            .table td {
                font-size: 12px; /* Réduit la taille de la police à 85% */
                margin-top: 5px;
            }

            .table tfoot td {
                text-align: center;
            }

            .table tfoot button {
                font-size: 0.95em; /* Réduit la taille de la police à 95% */
                padding: 10px 20px; /* Ajuste le padding pour une taille adaptée */
            }
        }
    </style>
@endpush

@section('content')
    @livewire('apps.cart')
@endsection
@push('script')
    <script>
        /*window.addEventListener('showCheckoutModal', function() {
            var modalElement = document.getElementById('checkout_modal');
            var modal = new bootstrap.Modal(modalElement, {
                backdrop: 'static', // Empêche l'utilisateur de fermer la fenêtre en cliquant à l'extérieur
                keyboard: false // Empêche l'utilisateur de fermer la fenêtre en appuyant sur ECHAP
            });
            modal.show();
        });*/

        window.addEventListener('showCheckoutModal', function (e) {
            $('#checkout_modal').modal('show');
        });


        window.addEventListener('hideCheckoutModal', function(e) {
            $('#checkout_modal').modal('hide');

            // Émettre l'événement de rafraîchissement
            window.livewire.emit('updateCart');
        });

        window.addEventListener('hideCartModal', function(e) {
            $('#cart_modal').modal('hide');

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
