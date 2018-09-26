@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col col-md-6">
                        <h2>
                            Directory
                        </h2>
                    </div>
                    <div class="col col-md-6 text-right">
                        <a href="{{ url('user/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</a>
                    </div>
                </div>
                

                <hr>

                <table class="table table-hover table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Job title</th>
                            <th>Location</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
<script src="{{asset('js/pages/directory.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    Directory.loadUsers("{{ url('user/list') }}");
});
</script>
@endpush
