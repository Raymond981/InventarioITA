{!! Form::open(array('url'=>'almacen/materiales', 'method'=>'GET','autocomplete'=>'off', 'role'=>'search'))!!}
<div class="form-group">
	<div class="input-group">
		<input type="text" name="searchText" class="form-control form-group" placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-warning">Buscar</button>
		</span>
	</div>
</div>
{{Form::close()}}