<!-- Ventana modal -->
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$mat->idmateriales}}">
	{{Form::open(array('action'=>array('MaterialController@destroy', $mat->idmateriales), 'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-Label="Close"><span aria-hidden="true">x</span></button>
				<h4 class="moda-title">Eliminar Material</h4>
			</div>
			<div class="modal-body">
				<p>¿Realmente quiere eliminar este material?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>