<template>
	<div>
		<form>
			<mensajes :mensaje='mensaje' :habilitar_alert='habilitar_alert' :clase_alert='clase_alert'></mensajes>
			<label for=""><strong>Nombre del nuevo submodulo</strong></label>
			<input type="text" class="form-control" v-model='submodulo'>
			<button class="btn btn-primary mt-2 pt-1 pb-1" @click.prevent='createSubmodulo' :disabled="habilitar_boton==false">Aceptar</button>
		</form><br>
	</div>
</template>
<script>
	import {mapState} from 'vuex'
	export default{
		data(){
			return{
				submodulo:'',
				mensaje:'',
				habilitar_boton:true,
				habilitar_alert:false,
				clase_alert:'',
			}
		},
		computed:{
			...mapState('submodulos',['aleatorio'])
		},
		methods:{
			createSubmodulo(){
				if (this.submodulo == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}

				if (this.submodulo.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				if (this.submodulo.length > 150 ) {
					this.mensaje = 'Numero de caracteres maximos 120'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				this.habilitar_boton = false;
				axios.post('/submodulos/create/'+this.$route.params.id,{
					submodulo:this.submodulo
				})
				.then((res)=>{
					this.mensaje = res.data.mens;
					this.clase_alert = res.data.color;
					this.habilitar_alert = true;
					this.habilitar_boton = true;
					console.log(res.data.submodulo)
					if (res.data.color=='alert-success') {
						this.$store.state.submodulos.submodulos.push(res.data.submodulo);
					}
				})
				.catch((error)=>{
					this.mensaje = "surgio un error interno";
					this.habilitar_boton = true;
					this.habilitar_alert = true;
					this.clase_alert = 'alert-danger';
				})

			}
		},
		watch:{
			aleatorio:function(){
				this.submodulo=''
				this.habilitar_boton=true
				this.clase_alert=''
				this.habilitar_alert=false
				this.mensaje=''
			}
		}
	};
</script>