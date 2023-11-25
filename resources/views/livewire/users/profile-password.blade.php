<div>
    {{-- Stop trying to control. --}}

    <form class="pb-6"  method="post" wire:submit.prevent='changePassword()'>
        <div class="row align-center">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Ancien Mot de Passe</label>
                    <input type="password" class="form-control" name="passwordA" placeholder="Ancien mot de passe" wire:model="passwordA">
                    <span class="text-danger">@error('passwordA'){{ $message }}@enderror</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Nouveau Mot de Passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Nouveau mot de passe" wire:model="password">
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">rétaper le nouveau Mot de Passe</label>
                    <input type="password" class="form-control" name="passwordC" placeholder="rétaper le nouveau Mot de Passe" wire:model="passwordC">
                    <span class="text-danger">@error('passwordC'){{ $message }}@enderror</span>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Changer le mot de passe</button>
    </form>


</div>
