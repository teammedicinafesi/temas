<template>
	<div>
		<div v-if="(habilitar==true)" class="mb-4">
			<p class="mb-0" style="font-size:1.1em">
				<label class="text-danger">Eliminar Submodulo</label> - "{{ submodulo.submodulo }}"
			</p>
			<p class="mb-2">Al eliminar el submodulo tambien se eliminaran todos los temas relacionados de manera permanente</p>
			<button class="btn btn-danger pt-1 pb-1" @click.prevent="eliminarSubmodulo"
				:disabled="habilitar_boton==false"
				>Aceptar
			</button>
			<a href="" class="btn btn-primary pt-1 pb-1" @click.prevent='aparecer_submodulos_temas'>Regresar al listado</a>
		</div>
		<div v-else class="mb-4">
			<p class="mb-1" style="font-size:1.1em">{{ mensaje }}</p>
			<a href="" @click.prevent='aparecer_submodulos_portada'><i class="fas fa-arrow-left"></i> Regresar al indice</a>
		</div>	
	</div>
</template>

<script>
	import {mapMutations} from 'vuex';
	import {mapState} from 'vuex';
	export default{
		data(){
			return{
				habilitar:true,
				habilitar_boton:true,
				mensaje:''
			}
		},
		computed:{
			...mapState('submodulos',['submodulo','submodulos'])
		},
		methods:{
			...mapMutations('submodulos',['aparecer_submodulos_temas','aparecer_submodulos_portada']),
			eliminarSubmodulo(){
				this.habilitar_boton = false
				axios.delete('/submodulos/delete/'+this.submodulo.id)
				.then((res)=>{
					this.mensaje = res.data
					this.habilitar = false
					let myQueryId = this.submodulo.id
					let resultado = this.submodulos.find(busqueda=> busqueda.id === myQueryId);
					let pos = this.submodulos.indexOf(resultado)
					this.submodulos.splice(pos,1);
					
				})
				.catch((err)=>{
					this.habilitar_boton =true;
				})
			}
		},
		watch:{
			submodulo:function(){
				this.habilitar = true;
				this.habilitar_boton = true;
			}
		}
	};
</script>