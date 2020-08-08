<template>
	<div>
		<div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" style="margin-top:70px">
			    <div class="modal-content">
				    <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Información de la Bibliografía</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				    </div>
				    <div class="modal-body">
						<p>Titulo: {{ bibliografiax.titulo }}</p>
						<p>Descripcion: {{ bibliografiax.descripcion }}</p>
						<p>Tipo {{ bibliografiax.tipo }} </p>
						<p>Cita {{ bibliografiax.cita }} </p>
						<p>Link {{ bibliografiax.link }} </p>
				    </div>
				    <div class="modal-footer">
				        <button type="button" class="btn btn-secondary pt-1 pb-1" data-dismiss="modal">Cerrar</button>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</template>

<script>
	import {mapState} from'vuex';
	export default{
		computed:{
			...mapState('bibliografias',['bibliografiax'])
		}
	};
</script>