<template>
	<div>
		<div v-if="(habilitar==true)" class="mb-4">
			<p class="mb-0" style="font-size:1.1em">
				<label class="text-danger">Eliminar Subtema</label> - "{{ subtema.subtema }}"
			</p>
			<p class="mb-2">¿Desea eliminar a este subtema de manera permanente?</p>
			<button class="btn btn-danger pt-1 pb-1" @click.prevent="eliminarSubtema"
				:disabled="habilitar_boton==false"
				>Aceptar
			</button>
			<a href="" class="btn btn-primary pt-1 pb-1" @click.prevent='aparecer_subtemas_info'>Regresar al contenido</a>
		</div>
		<div v-else class="mb-4">
			<p class="mb-1" style="font-size:1.1em">{{ mensaje }}</p>
			<a href="" @click.prevent='aparecer_temas_contenido'><i class="fas fa-arrow-left"></i> Regresar a la portada</a>
		</div>	
	</div>
</template>

<script>
	import {mapState} from 'vuex';
	import {mapMutations} from 'vuex';
	export default{
		data(){
			return{
				habilitar:true,
				habilitar_boton:true,
				mensaje:''
			}
		},
		computed:{
			...mapState('temas',['subtema','subtemas']),
		},
		methods:{
			...mapMutations('temas/subtemasx',['aparecer_subtemas_info']),
			...mapMutations('temas',['aparecer_temas_contenido']),
			eliminarSubtema(){
				this.habilitar_boton = false
				axios.delete('/subtemas/delete/'+this.subtema.id)
				.then((res)=>{
					this.mensaje = res.data
					this.habilitar = false
					let myQueryId = this.subtema.id
					let resultado = this.subtemas.find(busqueda=> busqueda.id === myQueryId);
					let pos = this.subtemas.indexOf(resultado)
					this.subtemas.splice(pos,1);
					
				})
				.catch((err)=>{
					this.habilitar_boton =true;
				})
			}
		},
		watch:{
			subtema:function(){
				this.habilitar = true;
				this.habilitar_boton = true;
			}
		}
	};
</script>