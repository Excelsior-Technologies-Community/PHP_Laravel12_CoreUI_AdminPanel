@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
                <h4 class="mb-4">My Profile Settings</h4>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle img-thumbnail shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=128" alt="Default Avatar" class="rounded-circle img-thumbnail shadow-sm" style="width: 120px; height: 120px;">
                            @endif
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label text-muted">Profile Picture</label>
                            <input type="file" name="avatar" class="form-control">
                            <small class="text-info">Recommended: Square image, max 2MB (JPG, PNG)</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <hr class="my-4">
                    <p class="text-sm text-info font-italic">Leave password blank if you don't want to change it.</p>

                    <div class="mb-3">
                        <label class="form-label text-muted">New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter new password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat new password">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-2 font-weight-bold">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection