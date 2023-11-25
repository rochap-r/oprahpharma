<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="avatar avatar-xxxl rounded-circle">
                    <img class="avatar-img rounded-circle" src="{{ $user->image ? asset('storage/'.$user->image->path) : asset('placeholders/picture.jpg')}}" alt="Avatar">
                </span>
            </div>
            <div class="col">
                <h2 class="page-title">{{ Str::ucfirst($user->name) }} {{ Str::ucfirst($user->sname) }}</h2>
                <div class="page-subtitle">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <i class="bi bi-person" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-md-6">
                            <div class="ff-heading fs-14 fw-normal text-gray text-reset">
                                {{ Str::upper($user->role->name=='user'?'UTILISATEUR':$user->role->name) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto d-md-flex">
                <input type="file" name="picture" id="changeProfile" class="d-none"
                       onchange="this.dispatchEvent(new InputEvent('input'))">

                <a href="#" class="btn btn-primary"
                   onclick="event.preventDefault();document.getElementById('changeProfile').click();">
                    <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 8l.01 0"></path>
                        <path d="M4 4m0 3a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3z">
                        </path>
                        <path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5"></path>
                        <path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2"></path>
                    </svg>Changez votre photo
                </a>
            </div>
        </div>
    </div>

</div>
