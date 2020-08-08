<template>
	<div class="mb-3">
		<textarea name="" id="" cols="30" rows="3" class="form-control mb-2" v-model='apunte'></textarea>
		<button class="btn btn-sm btn-primary" @click.prevent='enviarApunte' :disabled='habilitar_boton==false'>Agregar</button>
		<button class="btn btn-sm btn-secondary" @click='limpiarCampo'>Limpiar campo</button>
		<button class="btn btn-sm btn-secondary">Ocultar campo</button>
		&nbsp;
		<a href="" @click.prevent='esconderTextarea' class="align-bottom"><i class="far fa-minus-square"></i></a> 
		&nbsp; <small  :class="['align-bottom',clase_mensaje]"  style="font-size:.9em">{{ mensaje }}</small>
	</div>
</template>

<script>
	import {mapState} from 'vuex';
	export default{
		data(){
			return{
				apunte:'',
				mensaje:'',
				clase_mensaje:'',
				habilitar_boton:true
			}
		},
		computed:{
			...mapState('temas',['subtema']),
		},
		methods:{
			limpiarCampo(){
				this.apunte = '';
			},
			esconderTextarea(){
				this.$emit('esconderTextarea',true)
			},
			enviarApunte(){
				if (this.apunte == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_mensaje = 'text-secondary'
					this.habilitar_alert =true
					return false
				}

				if (this.apunte.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_mensaje = 'text-secondary'
					this.habilitar_alert =true
					return false	
				}

				if (this.apunte.length > 2000 ) {
					this.mensaje = 'Numero de caracteres maximos 2000'
					this.clase_mensaje = 'text-secondary'
					this.habilitar_alert =true
					return false	
				}
				this.habilitar_boton = false;
				axios.post('/subtemas/create_apunte/'+this.subtema.id,{
					apunte:this.apunte
				})
				.then((res)=>{
					console.log(res.data)
					this.habilitar_boton = true
					this.mensaje = res.data.mensaje
					this.clase_mensaje = 'text-success'
					this.subtema.apuntes.push(res.data.apunte)
				})
			}
		},
		watch:{
			subtema:function(){
				this.apunte=''
				this.mensaje=''
				this.clase_mensaje=''
			}
		}
	};
</script>