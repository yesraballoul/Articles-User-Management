@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
   
    <div class="row">
        <div class="col">
            <div class="card"><div class="card-header">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    {{ __('Roles') }}
                    @can('create roles')
                    <div><a class="btn btn-primary" href="{{ route('roles.create') }}">{{ __('create role') }}</a></div>
                    @endcan
                </div>
            </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive-sm">
                        <table id="table_id" class="table table-hover">
                            <thead>
                                <tr>
                                    @foreach ($rolesTableColumnsDTFormat as $column)
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
        

      let rolesTableColumnsDTFormat = {{ Illuminate\Support\Js::from($rolesTableColumnsDTFormat) }}
      let withEditColumn = rolesTableColumnsDTFormat.find((columns) => columns.data === "edit");
      let withDeleteColumn = rolesTableColumnsDTFormat.find((columns) => columns.data === "delete");
      

      if (withEditColumn) {
            withEditColumn.data = "id";
            withEditColumn.render = function(data, type, row) {
                return `<a class="btn btn-xs btn-default text-primary mx-1 shadow" href="{{ route('roles.edit', ':id') }}"><i class="fa fa-lg fa-fw fa-pen"></i></a>`
                    .replace(
                        ":id", data);
            }
        }

        if (withDeleteColumn) {
            withDeleteColumn.data = "id";
            withDeleteColumn.render = function(data, type, row) {
                return `
                <form method="post" action="{{ route('roles.destroy', ':id') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                </form>`
                    .replace(
                        ":id", data);
            }
        }

       
      
        $(document).ready(function() {
            var table = $('#table_id').DataTable({
                searching: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('api.roles.index') }}",
                    dataSrc: "data"
                },
                columns: rolesTableColumnsDTFormat
            });
            //closeAlertsAfter(3000);
        });
    </script>
@stop