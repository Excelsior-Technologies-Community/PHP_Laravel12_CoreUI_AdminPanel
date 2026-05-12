@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-danger">
                <i class="cil-trash mr-2"></i> Trash Bin (Deleted Users)
            </h5>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">
                <i class="cil-arrow-left"></i> Back to Users
            </a>
        </div>
        
        <div class="card-body">
            
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle border-light">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">Avatar</th>
                            <th class="border-0">User Details</th>
                            <th class="border-0 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="text-muted">#{{ $user->id }}</td>
                                <td>
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle shadow-sm" width="40" height="40" style="object-fit: cover; opacity: 0.7;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=666&color=fff" class="rounded-circle shadow-sm" width="40" style="opacity: 0.7;">
                                    @endif
                                </td>
                                <td>
                                    <div class="font-weight-bold text-muted" style="text-decoration: line-through;">{{ $user->name }}</div>
                                    <div class="small text-muted">{{ $user->email }}</div>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm px-3 shadow-sm" onclick="confirmRestore('{{ route('admin.users.restore', $user->id) }}')">
                                        <i class="cil-history"></i> Restore User
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="cil-trash" style="font-size: 3rem; opacity: 0.2;"></i>
                                    </div>
                                    <h5 class="font-weight-light">Your trash bin is empty!</h5>
                                    <p class="small">Deleted users will appear here for restoration.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover { background-color: #fff9f9; }
    .font-weight-bold { font-weight: 600; }
    .btn-success { border-radius: 8px; }
</style>

<script>
    function confirmRestore(url) {
        Swal.fire({
            title: 'Restore User?',
            text: "This user will be active again in your list.",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#2eb85c',
            cancelButtonColor: '#a4b0be',
            confirmButtonText: 'Yes, restore it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>
@endsection