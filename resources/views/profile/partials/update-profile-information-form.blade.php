<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4"> {{ __('Profile Information') }}</h4>
                <p class="mb-4">{{ __("Update your account's profile information and email address.") }}</p>

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <div class="mb-4">
                                    <label class="form-label" for="name">{{ __('Name') }}</label>
                                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                    <span class="text-muted">{{ __('e.g "Jhon Doe"') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0">
                                <div class="mb-4">
                                    <label class="form-label" for="email">{{ __('Email') }}</label>
                                    <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                                    <span class="text-muted"> {{ __('e.g "jondoe@example.com"') }}</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark waves-effect waves-light">{{ __('Save') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
