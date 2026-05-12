@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary shadow-sm border-0">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ \App\Models\User::count() }}</div>
                        <div>Total Users</div>
                    </div>
                </div>
                <div class="mt-3 mx-3" style="height:70px;">
                    <i class="cil-people" style="font-size: 2.5rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-info shadow-sm border-0">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ \App\Models\User::where('status', 1)->count() }}</div>
                        <div>Active Users</div>
                    </div>
                </div>
                <div class="mt-3 mx-3" style="height:70px;">
                    <i class="cil-user-follow" style="font-size: 2.5rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning shadow-sm border-0">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ \App\Models\User::where('status', 0)->count() }}</div>
                        <div>Inactive Users</div>
                    </div>
                </div>
                <div class="mt-3 mx-3" style="height:70px;">
                    <i class="cil-user-unfollow" style="font-size: 2.5rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-danger shadow-sm border-0">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ \App\Models\User::onlyTrashed()->count() }}</div>
                        <div>Trash Bin</div>
                    </div>
                </div>
                <div class="mt-3 mx-3" style="height:70px;">
                    <i class="cil-trash" style="font-size: 2.5rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-white fw-bold py-3">
                    <i class="cil-graph me-2 text-primary"></i> User Registration Analytics
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-white fw-bold py-3">
                    <i class="cil-history me-2 text-primary"></i> Recent Users
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                        <li class="list-group-item d-flex align-items-center py-3">
                            <div class="avatar avatar-md me-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" class="rounded-circle shadow-sm" width="40">
                            </div>
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-dark">{{ $user->name }}</div>
                                <div class="small text-muted">{{ $user->created_at->diffForHumans() }}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer bg-white text-center py-3">
                    <a href="{{ route('admin.users.index') }}" class="small fw-bold text-decoration-none text-primary">View All Users <i class="cil-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('userChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Registrations',
                    data:,
                    borderColor: '#321fdb',
                    backgroundColor: 'rgba(50, 31, 219, 0.05)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>

<style>
    .card { border-radius: 12px; overflow: hidden; transition: 0.3s; }
    .bg-primary { background: linear-gradient(45deg, #321fdb 0%, #1f1498 100%) !important; }
    .bg-info { background: linear-gradient(45deg, #39f 0%, #2982cc 100%) !important; }
    .bg-warning { background: linear-gradient(45deg, #f9b115 0%, #f6960b 100%) !important; }
    .bg-danger { background: linear-gradient(45deg, #e55353 0%, #d93737 100%) !important; }
</style>
@endsection