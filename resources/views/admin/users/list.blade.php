@extends('adminlte::page')

@section('title', 'Listar Permissões')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  
	<div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Usuários</h3>
        </div>
            
        <div class="box-body">
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
            </table>
        </div>
   </div>
        
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/fc-3.3.2/fh-3.1.7/kt-2.5.3/r-2.2.7/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.1/datatables.min.css"/>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/fc-3.3.2/fh-3.1.7/kt-2.5.3/r-2.2.7/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.1/datatables.min.js"></script>

    <script type="text/javascript">
        $(function () {
            
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.list') }}",
                dom: 'Blfrtip',
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0
                }],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                columns: [
                    {defaultContent: '', orderable: false, searchable: false },
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
    });
</script>
@stop