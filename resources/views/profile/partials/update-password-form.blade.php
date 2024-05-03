<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ __('Update Password') }}</h4>
                <p class="mb-4">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4">
                            <div>
                                <div class="mb-4">
                                    <label class="form-label" for="update_password_password">{{ __('Current Password') }}</label>
                                    <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" >
                                    <span class="text-muted">e.g "m#P52s@ap$V"</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <div class="mb-4">
                                    <label class="form-label" for="update_password_password">{{ __('New Password') }}</label>
                                    <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" >
                                    <span class="text-muted">e.g "m#P52s@ap$V"</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mt-4 mt-lg-0">
                                <div class="mb-4">
                                    <label class="form-label" for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
                                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                                    <span class="text-muted">e.g "m#P52s@ap$V"</span>
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
