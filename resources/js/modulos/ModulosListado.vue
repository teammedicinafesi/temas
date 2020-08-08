<template>
	<div>
		<h4 class="d-inline">Modulos</h4> &nbsp;&nbsp;
		<a href="" @click.prevent='aparecer_modulos_create'><i class="far fa-plus-square" style="font-size:.9em"></i> crear modulo</a>
		<div class="row mt-2">
			<div class="col-md-4 mb-3" v-for="modulo in modulos" :key="modulo.modulo">
				<div class="card">
					<div class="card-body">
					    <h5 class="card-title">{{ modulo.modulo }}</h5>
					    <h6 class="card-subtitle mb-2 text-muted">
					    	<router-link :to="'/submodulos/'+modulo.id">Acceder - N Submodulos</router-link>
					    </h6>
					    <p class="card-text">
					    	<a href="" @click.prevent="aparecer_modulos_update(modulo)">
					    		<i class="fas fa-eraser" style="font-size:.9em"></i>
					    	</a>
					    	<a href="" @click.prevent="aparecer_modulos_delete(modulo)">
					    		<i class="far fa-trash-alt" style="font-size:.9em"></i>
					    	</a>
					    </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import {mapMutations} from 'vuex'
	import {mapState} from 'vuex'
	export default{
		computed:{
			...mapState('modulos',['modulos'])
		},
		methods:{
			...mapMutations('modulos',['aparecer_modulos_create','aparecer_modulos_update','aparecer_modulos_delete']),
		},
	};
</script>