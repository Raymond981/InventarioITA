@extends('layout.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar MATERIAL: {{$material->nombre_material}}</h3>
            @if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
            @endif

            {!!Form::model($material, ['method'=>'patch', 'route'=>['materiales.update',$material->idmateriales]])!!}
			{!!Form::token()!!}
				<div class="form-group">
					<label for="nombre_material">Nombre del material: </label>
					<input type="text" name="nombre_material" value="{{$material->nombre_material}}" placeholder="Nombre del material.." class="form-control"></input>
				</div>
				<div class="form-group">
					<label for="descripcion_material">Descripción del material: </label>
					<input type="text" name="descripcion_material" value="{{$material->descripcion_material}}" placeholder="Descripción del material.." class="form-control"></input>
				</div>
				<div class="form-group">
					<label for="stock_material">Stock del material: </label>
					<input type="text" name="stock_material" value="{{$material->stock_material}}" placeholder="Stock del material.." class="form-control"></input>
				</div>
				<div class="form-group">
					<label for="stock_material">Capacidad del material: </label>
					<input type="text" name="capacidad_material" value="{{$material->capacidad_material}}" placeholder="Capacidad del material.." class="form-control"></input>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-warning" type="reset">Cancelar</button>
				</div>
            {!!Form::close()!!}
		</div>
	</div>

@endsection