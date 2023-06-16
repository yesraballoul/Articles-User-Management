@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Articles</h1>
@stop

@section('content')
  
    

    <div class="row">
        <div class="col">
            <div class="card"><div class="card-header">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    {{ __('Articles') }}
                    @can('create articles')
                    <div><a class="btn btn-primary" href="{{ route('articles.create') }}">{{ __('create article') }}</a></div>
                    @endcan
                </div>
            </div>
                <div class="card-body">
                    @if (session('status')
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive-sm">
                        <table id="table_id" class="table table-hover">
                            <thead>
                                <tr>
                                    @foreach ($articlesTableColumnsDTFormat as $column)
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
        

      let articlesTableColumnsDTFormat = {{ Illuminate\Support\Js::from($articlesTableColumnsDTFormat) }}
      let withEditColumn = articlesTableColumnsDTFormat.find((columns) => columns.data === "edit");
      let withDeleteColumn = articlesTableColumnsDTFormat.find((columns) => columns.data === "delete");
      let withAuthorColumn = articlesTableColumnsDTFormat.find((columns) => columns.data === "author");

      if (withEditColumn) {
            withEditColumn.data = "id";
            withEditColumn.render = function(data, type, row) {
                return `<a class="btn btn-xs btn-default text-primary mx-1 shadow" href="{{ route('articles.edit', ':id') }}"><i class="fa fa-lg fa-fw fa-pen"></i></a>`
                    .replace(
                        ":id", data);
            }
        }

        if (withDeleteColumn) {
            withDeleteColumn.data = "id";
            withDeleteColumn.render = function(data, type, row) {
                return `
                <form method="post" action="{{ route('articles.destroy', ':id') }}">
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
        
        
        
        if (withAuthorColumn) {
            withAuthorColumn.data = "user";
            withAuthorColumn.render = function(data, type, row) {
                if(data){
                    return data.username;
                }
               else {
                return "";
               }
            } 
            
        }

        
        $(document).ready(function() {
            var table = $('#table_id').DataTable({
                searching: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('api.articles.index') }}",
                    dataSrc: "data"
                },
                columns: articlesTableColumnsDTFormat
            });
            closeAlertsAfter(3000);
        });
    </script>
@stop