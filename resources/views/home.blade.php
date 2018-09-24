@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">
                        <div class="panel-heading">List</div>

                        <div class="panel-body">
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
        $(document).ready(function(){
            Directory.loadUsers("{{ url('loadUsers') }}");
        });
    </script>
@endpush
