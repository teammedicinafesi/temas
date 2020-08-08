<template>
	<div>
		<p class="mb-2" style="font-size:1.1em">
			Modificar nombre a: "{{ submodulo.submodulo }}"
			&nbsp;&nbsp; <a href="" style="font-size:.9em" @click.prevent='aparecer_submodulos_temas'>regresar al listado</a>
		</p> 
		<form class="mb-4">
			<mensajes :mensaje='mensaje' :habilitar_alert='habilitar_alert' :clase_alert='clase_alert'></mensajes>
			<label class="d-block mt-2" for="">Nuevo nombre</label>
			<input type="text" class="form-control" v-model='submodulo_new'>
			<button class="btn btn-primary mt-2 pt-1 pb-1" :disabled="habilitar_boton==false" @click.prevent='editarSubmodulo'>Aceptar</button>
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
				habilitar_alert:false,
				clase_alert:'',
				habilitar_boton:true,
				submodulo_new:''

			}
		},
		computed:{
			...mapState('submodulos',['submodulo','submodulos'])
		},
		methods:{
			...mapMutations('submodulos',['aparecer_submodulos_temas']),
			editarSubmodulo(){
				if (this.submodulo_new == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}

				if (this.submodulo_new.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				if (this.submodulo_new.length > 150 ) {
					this.mensaje = 'Numero de caracteres maximos 120'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				this.habilitar_boton = false
				axios.put('/submodulos/update/'+this.$route.params.id+'/'+this.submodulo.id,{
					submodulo:this.submodulo_new
				})
				.then((res)=>{
					console.log(res.data)
					this.mensaje = res.data.mens
					this.habilitar_alert = true
					this.clase_alert = res.data.color
					this.habilitar_boton = true
					if (res.data.color=='alert-success') {	
						let myQueryId = res.data.submodulo.id
					    this.submodulos[this.submodulos.findIndex(m => m.id === myQueryId)].submodulo = res.data.submodulo.submodulo
					}
				})
				.catch((error)=>{
					alert("error")
					this.habilitar_boton = true
				})
			}
		},
		watch:{
			submodulo:function(){
				this.submodulo_new = this.submodulo.submodulo
				this.mensaje = '';
				this.habilitar_boton=true;
				this.habilitar_alert=false;
				this.clase_alert='';
			}
		}
	};
</script>