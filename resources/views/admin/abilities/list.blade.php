@extends('adminlte::page')

@section('title', 'Listar Permissões')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  
	<div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de permissões</h3>
        </div>
            
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
	                <tr>
	                  <th>Rendering engine</th>
	                  <th>Browser</th>
	                  <th>Platform(s)</th>
	                  <th>Engine version</th>
	                  <th>CSS grade</th>
	                </tr>
                </thead>
                <tbody>
	                <tr>
	                	<td>Trident</td>
	                  	<td>Internet Explorer 4.0</td>
	                  	<td>Win 95+</td>
	                  	<td> 4</td>
	                  	<td>X</td>
	                </tr>
	                <tr>
						<td>Misc</td>
						<td>IE Mobile</td>
						<td>Windows Mobile 6</td>
						<td>-</td>
						<td>C</td>
	                </tr>
	                <tr>
						<td>Misc</td>
						<td>PSP browser</td>
						<td>PSP</td>
						<td>-</td>
						<td>C</td>
	                </tr>
	                <tr>
						<td>Other browsers</td>
						<td>All others</td>
						<td>-</td>
						<td>-</td>
						<td>U</td>
	                </tr>
                </tbody>
                <tfoot>
	                <tr>
						<th>Rendering engine</th>
						<th>Browser</th>
						<th>Platform(s)</th>
						<th>Engine version</th>
						<th>CSS grade</th>
	                </tr>
                </tfoot>
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

@stop