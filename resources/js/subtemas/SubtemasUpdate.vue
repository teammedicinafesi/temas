<template>
	<div>
		<p class="mb-2" style="font-size:1.1em">
			Modificar nombre a: "{{ subtema.subtema }}"
			&nbsp; <a href="" style="font-size:.9em" @click.prevent='aparecer_subtemas_info'>regresar al text</a>
		</p> 
		<form class="mb-4">
			<mensajes :mensaje='mensaje' :habilitar_alert='habilitar_alert' :clase_alert='clase_alert'></mensajes>
			<label class="d-block mt-2" for="">Nuevo nombre</label>
			<input type="text" class="form-control" v-model='subtema_new'>
			<button class="btn btn-primary mt-2 pt-1 pb-1" :disabled="habilitar_boton==false" @click.prevent='editarSubtema'>Aceptar</button>
		</form>
	</div>
</template>

<script>
	import {mapState} from 'vuex';
	import {mapMutations} from 'vuex';
	export default{
		data(){
			return{
				mensaje:'',
				habilitar_alert:false,
				clase_alert:'',
				habilitar_boton:true,
				subtema_new:''
			}
		},
		computed:{
			...mapState('temas',['subtema']),
		},
		methods:{
			...mapMutations('temas/subtemasx',['aparecer_subtemas_info']),
			editarSubtema(){
				if (this.subtema_new == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}

				if (this.subtema_new.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				if (this.subtema_new.length > 150 ) {
					this.mensaje = 'Numero de caracteres maximos 220'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				axios.put('/subtemas/update/'+this.$route.params.id+'/'+this.subtema.id,{
					subtema:this.subtema_new
				})
				.then((res)=>{
					console.log(res.data)
					this.mensaje         = res.data.mens
					this.clase_alert     = res.data.color
					this.habilitar_alert = true
					this.habilitar_boton = true
					if (res.data.color=='alert-success') {
						this.subtema.subtema = res.data.subtema.subtema
					} 
				})
				.catch((err)=>{
					this.habilitar_boton = true
					console.log('error')
				})
			}

		},
		watch:{
			subtema:function(){
				this.subtema_new=this.subtema.subtema
				this.mensaje = ''
				this.habilitar_alert = false
				this.clase_alert = ''
				
			}
		}
	};
</script>