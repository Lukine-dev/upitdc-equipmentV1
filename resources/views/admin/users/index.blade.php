@extends('layouts.app')

@section('content')
<div class="container">
    
</div>
<h2>All Users</h2>

<div class="mb-3">
    <input type="text" id="search" class="form-control" placeholder="Search users by name, email, or role...">
</div>

<div id="user-table">
    @include('admin.users.partials.table', ['users' => $users])
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#search').on('keyup', function () {
        let query = $(this).val();
        $.ajax({
            url: '{{ route('admin.users.search') }}',
            type: 'GET',
            data: { query: query },
            success: function (res) {
                $('#user-table').html(res.html);
            }
        });
    });
</script>
@endpush