<template>
	<div>
		<div v-if="(habilitar==true)" class="mb-4">
			<p class="mb-0" style="font-size:1.1em">
				<label class="text-danger">Eliminar kkk</label> - "{{ tema.tema }}"
			</p>
			<p class="mb-2">Al eliminar el tema se eliminara en todos los submodulos de manera permanente</p>
			<button class="btn btn-danger pt-1 pb-1" @click.prevent="eliminarSubmodulo"
				:disabled="habilitar_boton==false"
				>Aceptar
			</button>
			<a href="" class="btn btn-primary pt-1 pb-1" @click.prevent='aparecer_temas_opciones'>Regresar a edición</a>
		</div>
		<div v-else class="mb-4">
			<p class="mb-1" style="font-size:1.1em">{{ mensaje }}</p>
			<a href="" @click.prevent='aparecer_temas_contenido'><i class="fas fa-arrow-left"></i> Regresar a contenido</a>
		</div>
	</div>
</template>
<script>
	import {mapState} from 'vuex'
	import {mapMutations} from 'vuex'
	export default{
		data(){
			return{
				habilitar:true,
				habilitar_boton:true,
				mensaje:''
			}
		},
		computed:{
			...mapState('temas',['tema'])
		},
		methods:{
			...mapMutations('temas',['aparecer_temas_opciones','aparecer_temas_contenido']),
			eliminarSubmodulo(){
				this.habilitar_boton = false
				axios.delete('/temas/delete/'+this.tema.id)
				.then((res)=>{
					alert(res.data)
					window.location="/submodulos/"+this.$route.params.id_submodulo;
				})
				.catch((err)=>{
					this.habilitar_boton = true
				})
			}
		}

	};	
</script>