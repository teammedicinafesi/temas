<template>
	<div>
		<div v-show='(edicion==true)'>
			<p class="mb-2" style="font-size:1.1em">
				Subtema: "{{ subtema.subtema }}"
				&nbsp; <a href="" style="font-size:.9em" @click.prevent='aparecer_subtemas_info'>regresar al texto</a>
			</p> 
			<div>
				<textarea name="" id="" cols="30" rows="3" class="form-control mb-2" v-model='apunte_new'>{{ apunte.apunte}}</textarea>
				<button class="btn btn-sm btn-primary" @click.prevent='updateApunte' :disabled='habilitar_boton==false'>Guardar Cambios</button>
				<button class="btn btn-sm btn-secondary">Limpiar campo</button>
				<button class="btn btn-sm btn-secondary">Campo avanzado</button>
				<button class="btn btn-sm btn-danger" @click='mostrarConfirmacion'><i class="far fa-trash-alt" style="font-size:.9em"></i></button>
				<button class="btn btn-sm btn-danger" v-show='(mostrar_confirmacion==true)' @click='deleteApunte'>Aceptar</button>
				&nbsp; <small  :class="['align-bottom',clase_mensaje]"  style="font-size:.9em">{{ mensaje }}</small>
			</div>
		</div>
		<div v-show='(eliminar==true)'>
			{{ mensaje_eliminar }}
			<a href="" style="font-size:.9em" @click.prevent='aparecer_subtemas_info' class="d-block mt-1"> <i class="fas fa-arrow-left"></i> regresar al texto</a>
		</div>

	</div>
</template>
<script>
	import {mapState} from 'vuex'
	import {mapMutations} from 'vuex';
	export default{
		data(){
			return{
				apunte_new:'',
				habilitar_boton: true,
				clase_mensaje:'',
				mensaje:'',
				mostrar_confirmacion:false,
				edicion:true,
				eliminar:false,
				mensaje_eliminar:''
			}
		},
		computed:{
			...mapState('temas/subtemasx',['apunte']),
			...mapState('temas',['subtema'])
		},
		methods:{
			...mapMutations('temas/subtemasx',['aparecer_subtemas_info']),
			deleteApunte(){
				axios.delete('/subtemas/delete_apunte/'+this.apunte.id)
				.then((res)=>{
					console.log(res.data)
					let myQueryId = this.apunte.id
					let resultado = this.subtema.apuntes.find(busqueda=> busqueda.id === myQueryId);
					let pos = this.subtema.apuntes.indexOf(resultado)
					this.subtema.apuntes.splice(pos,1);
					this.edicion = false;
					this.eliminar = true;
					this.mensaje_eliminar = res.data
				})
			},
			mostrarConfirmacion(){
				this.mostrar_confirmacion = true
			},
			updateApunte(){
				if (this.apunte_new == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_mensaje = 'text-secondary'
					this.habilitar_alert =true
					return false
				}

				if (this.apunte_new.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_mensaje = 'text-secondary'
					this.habilitar_alert =true
					return false	
				}

				if (this.apunte_new.length > 2000 ) {
					this.mensaje = 'Numero de caracteres maximos 2000'
					this.clase_mensaje = 'text-secondary'
					this.habilitar_alert =true
					return false	
				}
				this.habilitar_boton = false;
				axios.put('/subtemas/update_apunte/'+this.subtema.id+'/'+this.apunte.id,{
					apunte:this.apunte_new
				})
				.then((res)=>{
					this.mensaje = res.data.mens
					this.clase_mensaje = 'text-success'
					this.habilitar_boton = true;
					this.apunte.apunte = this.apunte_new 
					console.log(res.data)
				})

			}
		},
		watch:{
			apunte:function(){
				this.apunte_new = this.apunte.apunte
				this.habilitar_boton= true
				this.clase_mensaje=''
				this.mensaje=''
				this.mostrar_confirmacion=false
				this.edicion=true
				this.eliminar=false
				this.mensaje_eliminar=''
			}
		}
	};
</script>