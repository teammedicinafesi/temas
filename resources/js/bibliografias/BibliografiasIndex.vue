<template>
	<div>
		<p style="font-size:1.1em" class="mb-0">Bibliografias para: {{ tema.tema }}</p>

		<button type="button" class="btn btn-sm btn-success mt-1 pt-1 pb-1" data-toggle="modal" data-target="#exampleModal">
	  		<i class="far fa-plus-square" style="font-size:.9em"></i>
	  		 Agregar
		</button>
		<button class="btn btn-sm btn-primary mt-1 pb-1 pt-1">
			<i class="fas fa-search" style="font-size:.9em"></i>
			 Buscar y relacionar
		</button>
		
		<bibliografias-tabla></bibliografias-tabla>
		<bibliografias-create></bibliografias-create>
	
	</div>
</template>
<script>
	import {mapMutations} from 'vuex';
    import {mapState} from 'vuex';
	export default{
		
        computed:{
            ...mapState('temas',['tema','bibliografias'])
        },

	};
</script>