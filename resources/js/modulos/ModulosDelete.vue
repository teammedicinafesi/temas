<template>
	<div>
		<div v-if="(habilitar==true)">
			<h5>Eliminar Modulo - "{{ modulo.modulo }}"</h5>
			<p class="mb-2">Al eliminar el modulo tambien se eliminaran todos los submodulos y temas relacionados de manera permanente</p>
			<button class="btn btn-danger pt-1 pb-1" @click.prevent="eliminarModulo"
				:disabled="habilitar_boton==false"
				>Aceptar
			</button>
			<a href="" class="btn btn-primary pt-1 pb-1" @click.prevent='aparecer_modulos_listado'>Regresar al listado</a>
		</div>
		<div v-else>
			<h4>{{ mensaje }}</h4>
			<a href="" @click.prevent='aparecer_modulos_listado'><i class="fas fa-arrow-left"></i> Regresar al listado</a>
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
				habilitar_boton:true
			}
		},
		computed:{
			...mapState('modulos',['modulos','modulo']),
		},
		methods:{
			...mapMutations('modulos',['aparecer_modulos_listado']), 
			eliminarModulo(){
				this.habilitar_boton = false
				axios.delete('/modulos/delete/'+this.modulo.id)
				.then((res)=>{
					this.mensaje = res.data
					this.habilitar = false
					let myQueryId = this.modulo.id
					let resultado = this.modulos.find(busqueda=> busqueda.id === myQueryId);
					let pos = this.modulos.indexOf(resultado)
					this.modulos.splice(pos,1);
					
				})
			}
		},
		watch:{
			modulo:function(){
				this.habilitar = true;
				this.habilitar_boton = true;
			}
		}
	};
</script>