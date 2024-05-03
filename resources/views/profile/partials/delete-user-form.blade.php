<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4"> {{ __('Delete Account') }}</h4>
                <p class="mb-4">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </p>
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger waves-effect waves-light">{{ __('Delete Account') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
