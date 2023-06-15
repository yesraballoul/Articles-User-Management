@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div>
        <p>Welcome to this beautiful admin panel.</p>
    </div>
    

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table id="table_id" class="table table-hover">
                            <thead>
                                <tr>
                                    @foreach ($usersTableColumnsDTFormat as $column)
                                        <th>{{ $column['data'] }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

@section('js')
    <script> console.log('Hi!'); 
      
      let usersTableColumnsDTFormat = {{ Illuminate\Support\Js::from($usersTableColumnsDTFormat) }}
      
        $(document).ready(function() {
            var table = $('#table_id').DataTable({
                searching: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('api.users.index') }}",
                    dataSrc: "data"
                },
                columns: usersTableColumnsDTFormat
            });
        });
    </script>
@stop