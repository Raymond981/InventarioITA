@extends('layout.admin')
@section('contenido')
	
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<h3>Inventario - Materiales del Laboratorio <a href="materiales/create"><button class="btn btn-success">Nuevo</button></a></h3>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			@include('almacen.materiales.busqueda')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>ID</th>
						<th>Material</th>
						<th>Descripción</th>
						<th>Stock</th>
						<th>Capacidad</th>
						<th>Observaciones</th>
						<th>Opciones</th>
					</thead>
                    @foreach($materiales as $mat)
					<tr>
						<td>{{$mat->idmateriales}}</td>
						<td>{{$mat->nombre_material}}</td>
						<td>{{$mat->descripcion_material}}</td>
						<td>{{$mat->stock_material}}</td>
						<td>{{$mat->capacidad_material}}</td>
						<td>{{$mat->observaciones_material}}</td>
						<td>
							<a href="{{URL::action('MaterialController@edit', $mat->idmateriales)}}"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$mat->idmateriales}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('almacen.materiales.modal')
		            @endforeach		
				</table>
			</div>
			{{$materiales->render()}}
		</div>
		<center><a href="{{route('export.excel')}}" class="btn btn-success">Exportar a Excel</a></center>
	</div>

@endsection