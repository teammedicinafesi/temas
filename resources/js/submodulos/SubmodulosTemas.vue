<template>
	<div>
		<p style="font-size:1.1em" class="mb-3">{{ submodulo.submodulo }}</p>

		<p  style="font-size:1.05em;" v-for='(tema,index) in submodulo.temas' :key='index'>
			<router-link :to="'/temas/'+tema.id+'/modulo/'+modulo.id" class='text-dark' style='margin-left:15px'><i class="fas fa-caret-right"></i> {{ tema.tema }}</router-link>
		</p>

		<p class="mt-4">
			<a href="" @click.prevent='aparecer_submodulos_update'>
				<i class="fas fa-eraser" style="font-size:.9em"></i> Editar submodulo
			</a> &nbsp;&nbsp;
			<a href="" @click.prevent='aparecer_submodulos_delete'>
				<i class="far fa-trash-alt" style="font-size:.9em"></i> Eliminar submodulo
			</a> &nbsp;&nbsp;
			<a href="" @click.prevent='aparecer_temas_create'>
				<i class="far fa-plus-square" style="font-size:.9em"></i> Crear Tema
			</a>
		</p>
	</div>
</template>

<script>
	import {mapState} from 'vuex';
	import {mapMutations} from 'vuex';
	export default{
		computed:{
			...mapState('submodulos',['submodulo','modulo'])
		},
		methods:{
			...mapMutations('submodulos',['aparecer_submodulos_update','aparecer_submodulos_delete','aparecer_temas_create'])
		}
	};
</script>