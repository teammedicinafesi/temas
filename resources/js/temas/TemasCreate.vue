<template>
	<div>
		<p class="mb-2" style="font-size:1.1em">
			Crear un tema para: "{{ submodulo.submodulo }}"
			&nbsp; <a href="" style="font-size:.9em" @click.prevent='aparecer_submodulos_temas'>regresar al listado</a>
		</p> 
		<form class="mb-4">
			<mensajes :mensaje='mensaje' :habilitar_alert='habilitar_alert' :clase_alert='clase_alert'></mensajes>
			<label>Nombre del nuevo tema</label>
			<input type="text" class="form-control" v-model='tema'>
			<button class="btn btn-primary mt-2 pt-1 pb-1" :disabled="habilitar_boton==false" @click.prevent='createTema'>
				Aceptar
			</button>
			<button class="btn btn-secondary mt-2 pt-1 pb-1" @click.prevent='limpiarFormulario'>
				Limpiar formulario
			</button>
		</form>
	</div>
</template>
<script>
	import {mapState} from 'vuex';
	import {mapMutations} from 'vuex';
	export default{
		data(){
			return{ 
				tema:'',
				mensaje:'',
				habilitar_boton:true,
				habilitar_alert:false,
				clase_alert:''
			}
		},
		computed:{
			...mapState('submodulos',['submodulo','submodulos'])
		},
		methods:{
			...mapMutations('submodulos',['aparecer_submodulos_temas']),
			limpiarFormulario(){
				this.tema = ''
			},	
			createTema(){
				if (this.tema == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}

				if (this.tema.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				if (this.tema.length > 150 ) {
					this.mensaje = 'Numero de caracteres maximos 250'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				this.habilitar_boton = false;
				axios.post('/temas/create/'+this.submodulo.id,{
					tema:this.tema
				})
				.then((res)=>{
					this.mensaje  = res.data.mens;
					this.clase_alert = res.data.color;
					this.habilitar_alert = true
					this.habilitar_boton = true;
					if (res.data.color == 'alert-success') {
						this.submodulo.temas.push(res.data.tema);
						//let myQueryId = this.submodulo.id
						//this.submodulos.find(busqueda=> busqueda.id === myQueryId).temas.push(res.data.tema);
						//console.log(this.submodulos.find(busqueda=> busqueda.id === myQueryId))
						//this.submodulo = array
					}
				})
				.catch((error)=>{
					
					this.habilitar_boton = true;
					console.log(err)
				})

			}
		},
		watch:{
			submodulo:function(){
				this.tema = '';
				this.mensaje = '';
				this.habilitar_boton = true;
				this.habilitar_alert = false;
				this.clase_alert = '';
			}
		}
	};
</script>