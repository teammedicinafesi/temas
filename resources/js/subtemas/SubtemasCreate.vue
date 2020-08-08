<template>
	<div>
		<p class="mb-2" style="font-size:1.1em">
			Crear un subtema
			&nbsp; <a href="" style="font-size:.9em" @click.prevent='aparecer_temas_contenido'>regresar al contenido</a>
		</p>
		<form class="mb-4">
			<mensajes :mensaje='mensaje' :habilitar_alert='habilitar_alert' :clase_alert='clase_alert'></mensajes>
			<label>Nombre del nuevo subtema</label>
			<input type="text" class="form-control" v-model='subtema'>
			<button class="btn btn-primary mt-2 pt-1 pb-1" :disabled="habilitar_boton==false" @click.prevent='createTema'>
				Aceptar
			</button>
		</form>
	</div>
</template>
<script>
	import {mapState} from 'vuex'
	import {mapMutations} from 'vuex'
	export default{
		data(){
			return{
				subtema:'',
				habilitar_boton:true,
				clase_alert:'',
				habilitar_alert:false,
				mensaje:''
			}
		},
		computed:{
			...mapState('temas',['subtemas','aleatorio']),
		},
		methods:{
			...mapMutations('temas',['aparecer_temas_contenido']),
			createTema(){
				if (this.subtema == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}

				if (this.subtema.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				if (this.subtema.length > 150 ) {
					this.mensaje = 'Numero de caracteres maximos 220'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				this.habilitar_boton = false;
				axios.post('/subtemas/create/'+this.$route.params.id,{
					subtema:this.subtema
				})
				.then((res)=>{
					this.mensaje  = res.data.mens;
					this.clase_alert = res.data.color;
					this.habilitar_alert = true
					this.habilitar_boton = true;
					console.log(res.data)
					this.subtemas.push(res.data.subtema)
				})
				.catch((err)=>{
					this.habilitar_boton = true
				})
			}
		},
		watch:{
			aleatorio:function(){
				this.subtema=''
				this.habilitar_boton=true
				this.clase_alert=''
				this.habilitar_alert=false
				this.mensaje=''
			}
		}
	};
</script>