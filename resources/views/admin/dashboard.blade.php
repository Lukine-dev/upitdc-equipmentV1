@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Admin Dashboard</h2>

    {{-- Nav Tabs --}}
    <ul class="nav nav-tabs mb-3" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab">User Stats</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="equipment-tab" data-bs-toggle="tab" data-bs-target="#equipment" type="button" role="tab">Equipment Stats</button>
        </li>
    </ul>

    <div class="tab-content" id="dashboardTabsContent">
        {{-- User Stats Tab --}}
        <div class="tab-pane fade show active" id="user" role="tabpanel">
            <div class="row mb-4">
                <div class="col-md-3"><div class="card text-bg-primary"><div class="card-body"><h5>Total Users</h5><p class="fs-4">{{ $totalUsers }}</p></div></div></div>
                <div class="col-md-3"><div class="card text-bg-success"><div class="card-body"><h5>Admins</h5><p class="fs-4">{{ $totalAdmins }}</p></div></div></div>
                <div class="col-md-3"><div class="card text-bg-warning"><div class="card-body"><h5>Editors</h5><p class="fs-4">{{ $totalEditors }}</p></div></div></div>
                <div class="col-md-3"><div class="card text-bg-danger"><div class="card-body"><h5>Unverified</h5><p class="fs-4">{{ $unverifiedUsers }}</p></div></div></div>
            </div>

            <h5>Recent Users</h5>
            <ul class="list-group mb-4">
                @foreach ($recentUsers as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $user->name }} <span class="badge bg-secondary">{{ $user->role }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Equipment Stats Tab --}}
        <div class="tab-pane fade" id="equipment" role="tabpanel">
            <div class="row mb-4">
                <div class="col-md-3"><div class="card text-bg-primary"><div class="card-body"><h5>Total Equipment</h5><p class="fs-4">{{ $totalEquipment }}</p></div></div></div>
                <div class="col-md-3"><div class="card text-bg-success"><div class="card-body"><h5>Available</h5><p class="fs-4">{{ $availableEquipment }}</p></div></div></div>
                <div class="col-md-3"><div class="card text-bg-secondary"><div class="card-body"><h5>Reserved</h5><p class="fs-4">{{ $reservedEquipment }}</p></div></div></div>
                <div class="col-md-3"><div class="card text-bg-danger"><div class="card-body"><h5>Unavailable</h5><p class="fs-4">{{ $unavailableEquipment }}</p></div></div></div>
            </div>

            {{-- Chart: Requests by Status --}}
            <div class="mt-5">
                <h5 class="mb-3">Equipment Request Status</h5>
                <canvas id="statusChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pending', 'Approved', 'Declined', 'Returned'],
            datasets: [{
                label: 'Requests',
                data: [
                    {{ $requestsByStatus['pending'] ?? 0 }},
                    {{ $requestsByStatus['approved'] ?? 0 }},
                    {{ $requestsByStatus['declined'] ?? 0 }},
                    {{ $requestsByStatus['returned'] ?? 0 }}
                ],
                backgroundColor: ['#facc15', '#22c55e', '#ef4444', '#6b7280'],
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endsection
