<template>
	<div>
		<h4 class="d-inline">Crear Modulo</h4> &nbsp;&nbsp;
		<a href="" @click.prevent='aparecer_modulos_listado'>regresar al listado</a>
		<form class="mt-2">
			<mensajes :mensaje='mensaje' :habilitar_alert='habilitar_alert' :clase_alert='clase_alert'></mensajes>
			<label for="crear">Nombre del nuevo modulo</label>
			<input type="text" class="form-control" v-model="modulo" name="modulo">
			<button 
				class="btn btn-primary mt-2 pt-1 pb-1" 
				@click.prevent='createModulo'
				:disabled="habilitar_boton==false"
				>aceptar
			</button>
		</form>
	</div>
</template>

<script>
	import {mapMutations} from 'vuex';
	export default{
		data(){
			return{
				modulo:'',
				mensaje:'',
				habilitar_boton:true,
				habilitar_alert:false,
				clase_alert:''
			}
		},
		methods:{
			...mapMutations('modulos',['aparecer_modulos_listado']),

			createModulo(){
				if (this.modulo == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}

				if (this.modulo.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				if (this.modulo.length > 150 ) {
					this.mensaje = 'Numero de caracteres maximos 120'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				this.habilitar_boton = false;
				axios.post('/modulos/create',{
					modulo:this.modulo
				})
				.then((res)=>{
					this.mensaje = res.data.mens;
					this.clase_alert = res.data.color;
					this.habilitar_alert = true;
					this.habilitar_boton = true;
					if (res.data.color=='alert-success') {this.$store.state.modulos.modulos.push(res.data.modulo)}
					console.log(res.data)
				})
				.catch((error)=>{
					console.log(error)
					this.mensaje = "surgio un error interno";
					this.habilitar_boton = true;
					this.habilitar_alert = true;
					this.clase_alert = 'alert-danger';
				})
			}
		},
	};
</script>