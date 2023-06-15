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
                    <table id="table_id" class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Column 1</th>
                                <th>Column 2</th>
                                <th>Column 3</th>
                                <th>Column 4</th>
                                <th>Column 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 3</td>
                                <td>Row 1 Data 4</td>
                                <td>Row 1 Data 5</td>
                            </tr>
                            <tr>
                                <td>Row 2 Data 1</td>
                                <td>Row 2 Data 2</td>
                                <td>Row 2 Data 3</td>
                                <td>Row 2 Data 4</td>
                                <td>Row 2 Data 5</td>
                            </tr>
                        </tbody>
                    </table>
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
        
        var data = [
            [
                "Tiger Nixon",
                "System Architect",
                "Edinburgh",
                "5421",
                "2011/04/25",
                "$3,120"
            ],
            [
                "Garrett Winters",
                "Director",
                "Edinburgh",
                "8422",
                "2011/07/25",
                "$5,300"
            ]
        ]
        var data2 = [{
                "name": "Tiger Nixon",
                "position": "System Architect",
                "salary": "$3,120",
                "start_date": "2011/04/25",
                "office": "Edinburgh",
                "extn": "5421"
            },
            {
                "name": "Garrett Winters",
                "position": "Director",
                "salary": "$5,300",
                "start_date": "2011/07/25",
                "office": "Edinburgh",
                "extn": "8422"
            }
        ]
        $(document).ready(function() {
            $('#table_id').DataTable({
                // data: data2,
                // columns: [{
                //         data: 'name'
                //     },
                //     {
                //         data: 'position'
                //     },
                //     {
                //         data: 'salary'
                //     },
                //     {
                //         data: 'office'
                //     }
                // ]
            });
        });
    </script>
@stop