<x-app-layout>
    <x-slot name="header">
        <div class="row">
            
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Change Password</h4>
            </div>
            <div class="card-body">
                <x-alert session="updatePassword" color="success" />
                <form action="{{ route('users.updatePassword', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="existing_password">Existing Password</label>
                                <input type="password" name="existing_password" value="{{ old('error') }}" class="form-control @if(session('errorExistingPassword')) is-invalid @endif" required>
                                @if(session('errorExistingPassword'))
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{session('errorExistingPassword')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                <x-maz-input-error for="password" />
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Verify Password</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" required>
                                <x-maz-input-error for="password" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Change</button>
                </form>            
            </div>
        </div>
    </section>
</x-app-layout>

<!-- Modal untuk membuat pengguna baru -->

