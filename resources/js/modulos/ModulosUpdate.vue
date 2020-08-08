<template>
	<div>
		<h5 class="d-inline">Editar Modulo - {{ modulo.modulo }}</h5> &nbsp;&nbsp;
		<a href="" @click.prevent='aparecer_modulos_listado'>regresar al listado</a>
		<form class="mt-2">
			<mensajes :mensaje='mensaje' :habilitar_alert='habilitar_alert' :clase_alert='clase_alert'></mensajes>
			<label>Nuevo Nombre</label>
			<input type="text" class="form-control" name="modulo"  v-model="modulo_new">
			<button class="btn btn-primary mt-2 pt-1 pb-1" :disabled="habilitar_boton==false" @click.prevent='editarModulo'>Aceptar</button>
		</form>
	</div>
</template>
<script>
	import {mapMutations} from 'vuex';
	import {mapState} from 'vuex';
	export default{
		data(){
			return{
				mensaje:'',
				habilitar_boton:true,
				habilitar_alert:false,
				clase_alert:'',
				modulo_new:''
			}
		},
		computed:{
			...mapState('modulos',['modulos','modulo']),
			modulo_n () {
		    	return this.$store.state.modulo.modulo
		    }

		},
		methods:{
			...mapMutations('modulos',['aparecer_modulos_listado']), 
			editarModulo(){
				if (this.modulo_new == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}

				if (this.modulo_new.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				if (this.modulo_new.length > 120 ) {
					this.mensaje = 'Numero de caracteres maximos 120'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				this.habilitar_boton = false
				axios.put('/modulos/update/'+this.modulo.id,{
					modulo:this.modulo_new
				})
				.then((res)=>{
					console.log(res.data)
					this.mensaje = res.data.mens
					this.habilitar_alert = true
					this.clase_alert = res.data.color
					this.habilitar_boton = true
					if (res.data.color=='alert-success') {	
						let myQueryId = res.data.modulo.id
					    this.modulos[this.modulos.findIndex(m => m.id === myQueryId)].modulo = res.data.modulo.modulo
					}
				})
				.catch((error)=>{
					alert("error")
					this.habilitar_boton = true
				})
			}
		},
		watch:{
			modulo:function(){
				this.modulo_new = this.modulo.modulo
				this.mensaje = '';
				this.habilitar_boton=true;
				this.habilitar_alert=false;
				this.clase_alert='';
			}
		}
	};
</script>