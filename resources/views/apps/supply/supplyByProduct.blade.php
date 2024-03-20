@extends('layouts.app')
@section('title','Approvisionnement')
@push('style')
    {{-- CSS complementaires --}}
@endpush

@section('content')
    @livewire('apps.supply-by-product')
@endsection
@push('script')
    <script>

        //time error
        window.addEventListener('time-error', function(event) {
            var supply_date = event.detail.supply_date;
            var hours = event.detail.hours;
            alert('Impossible d\'effectuer cette operation, car la durée d\'édition est déjà au plus de  ' + hours + ' heures depuis le '+supply_date+'');
            $('#supply_modal').modal('hide');
        });

        //maj error
        window.addEventListener('quantity-error', function(event) {

            alert('Impossible d\'effectuer cette operation, rassurez-vous que le stock n\'est pas encore utilisé ou ce que votre nouvelle quantité commandée est superieure à l\'ancienne');
            $('#supply_modal').modal('hide');
        });
        //delete error
        window.addEventListener('time-qte-error', function(event) {
            var heures = event.detail.heures
            alert('Impossible d\'effectuer cette operation, rassurez-vous que le stock n\'est ' +
                'pas encore utilisé et que la ligne d\'approvisionnement a été créé dans '+heures+' heures moins');
        });

        window.addEventListener('hideSupplyModal', function (e) {
            $('#supply_modal').modal('hide');
        });

        window.addEventListener('showEditSupplyModal', function (e) {
            $('#supply_modal').modal('show');
        });

        // Réinitialisation du formulaire dans la modale
        $('#supply_modal').on('hidden.bs.modal', function (e) {
            Livewire.emit('resetSupplyForm');
            Livewire.emit('resetComponent');

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
    </script>
@endpush


