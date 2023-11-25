@extends('layouts.app')
@section('title','Profile Utilisateur')
    @push('style')
        {{-- CSS complementaires --}}
    @endpush

<!--Including BODY -->
@section('content')
    {{-- head page --}}
    @livewire('users.profile')
    {{-- end head page --}}
    <hr>
    {{-- content --}}

    @livewire('users.profile-tabs')

@endsection

<!--Including JS-->
@push('script')
    <script>
        $('#changeProfile').ijaboCropTool({
            preview: '',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('app.changeImage') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                //alert(message);
                //listeners en ecoute pour l'actualisation de deux endroits ou se trouve les deux pictures
                Livewire.emit('UpdateHeader');
                Livewire.emit('UpdateProfile');

                toastr.success(message)
            },
            onError: function(message, element, status) {
                //alert(message);
                toastr.error(message)
            }
        });
    </script>
@endpush
