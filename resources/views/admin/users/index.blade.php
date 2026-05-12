@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold"><i class="cil-people mr-2"></i> Users Management</h5>
            <a href="{{ route('admin.users.trash') }}" class="btn btn-outline-warning btn-sm">
                <i class="cil-trash"></i> View Trash Bin
            </a>
        </div>
        
        <div class="card-body">
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="cil-search"></i> Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Clear</a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border-light">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">Avatar</th>
                            <th class="border-0">User Details</th>
                            <th class="border-0 text-center">Status</th>
                            <th class="border-0 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="text-muted">#{{ $user->id }}</td>
                                <td>
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle shadow-sm" width="40" height="40" style="object-fit: cover;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" class="rounded-circle shadow-sm" width="40">
                                    @endif
                                </td>
                                <td>
                                    <div class="font-weight-bold text-dark">{{ $user->name }}</div>
                                    <div class="small text-muted">{{ $user->email }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill {{ $user->status ? 'bg-success-light text-success' : 'bg-secondary-light text-secondary' }} px-3 py-2">
                                        ● {{ $user->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.users.status', $user->id) }}" class="btn btn-sm btn-outline-info border-0" title="Toggle Status">
                                            <i class="cil-swap-horizontal"></i>
                                        </a>

                                        <a href="#" class="btn btn-sm btn-outline-primary border-0" title="Edit User">
                                            <i class="cil-pencil"></i>
                                        </a>

                                        <button type="button" class="btn btn-sm btn-outline-danger border-0" onclick="confirmDelete({{ $user->id }})">
                                            <i class="cil-trash"></i>
                                        </button>

                                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="cil-mood-bad d-block mb-2" style="font-size: 2rem;"></i>
                                    No users found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="small text-muted">
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
                </div>
                <div>
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .bg-success-light { background-color: #e6f9ed; }
    .bg-secondary-light { background-color: #f0f2f5; }
    .table-hover tbody tr:hover { background-color: #fbfbfb; }
    .font-weight-bold { font-weight: 600; }
</style>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "User will be moved to trash!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e55353',
            cancelButtonColor: '#a4b0be',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endsection