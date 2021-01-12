@extends('adminlte::page')

@section('title', 'Listar Permissões')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Dashboard</h1>
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item active"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                <li class="breadcrumb-item ">Fixed Navbar Layout</li>
            </ol>
        </div>
        <div class="col-sm-6">
           
        </div>
    </div>
@stop

@section('content')
  
	<div class="box mt-3">
        <div class="box-header">
          <h3 class="box-title">Lista de Usuários</h3>
        </div>
            
        <div class="box-body">
            <div class="table-responsive">  
                <table id="users-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach([1, 2, 3, 4, 5, 6] as $row)
                        <tr>
                            <td></td>
                            <td>{{ $row }}</td>
                            <td>Eric</td>
                            <td>ericlempe1994@gmail.com</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
   </div>
        
@stop

@section('js')
	
    <script type="text/javascript">
        $(function () {
            
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: false,
                // ajax: "{{ route('admin.users.list') }}",
                dom: 'Blfrtip',
                buttons: [
                    { extend: 'copyHtml5', text: '<i class="far fa-copy"></i>', titleAttr: 'Copiar' },
                    { extend: 'excelHtml5', text: '<i class="far fa-file-excel"></i>', titleAttr: 'Excel' },
                    { extend:'csvHtml5', text: '<i class="fas fa-file-csv"></i>', titleAttr: 'CSV' },
                    { extend: 'pdfHtml5', text: '<i class="far fa-file-pdf"></i>', titleAttr: 'PDF' },
                    { extend: 'print', text: '<i class="fas fa-print"></i>', titleAttr: 'Imprimir' }
                ],
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0
                }],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                // columns: [
                //     {defaultContent: '', orderable: false, searchable: false },
                //     {data: 'id', name: 'id'},
                //     {data: 'name', name: 'name'},
                //     {data: 'email', name: 'email'},
                //     {data: 'action', name: 'action', orderable: false, searchable: false},
                // ],
                initComplete: function () {
                }   
            });
        });
</script>
@stop