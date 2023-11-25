<div>
    {{-- Stop trying to control. --}}

    <!-- Default Tab -->
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ $tab == 'profile_infos' ? 'active' : '' }}" href="{{ route('user.profile', ['tab' => 'profile_infos']) }}">Infos Personnelles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $tab == 'profile_password' ? 'active' : '' }}" href="{{ route('user.profile', ['tab' => 'profile_password']) }}">Sécurité</a>
            </li>
        </ul>
        <hr class="bg-primary">
        <div class="tab-content">
            <div class="tab-pane fade {{ $tab == 'profile_infos' ? 'show active' : '' }}" id="profile_infos">
                @livewire('users.profile-infos')
            </div>
            <div class="tab-pane fade {{ $tab == 'profile_password' ? 'show active' : '' }}" id="profile_password">
                @livewire('users.profile-password')
            </div>
        </div>

</div>
