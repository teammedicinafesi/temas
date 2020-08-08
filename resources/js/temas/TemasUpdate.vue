<template>
	<div>
		<p class="mb-2" style="font-size:1.1em">
			Modificar nombre a: "{{ tema.tema }}"
			&nbsp; <a href="" style="font-size:.9em" @click.prevent='aparecer_temas_opciones'>regresar a edicion</a>
		</p> 
		<form class="mb-4">
			<mensajes :mensaje='mensaje' :habilitar_alert='habilitar_alert' :clase_alert='clase_alert'></mensajes>
			<label class="d-block mt-2" for="">Nuevo nombre</label>
			<input type="text" class="form-control" v-model='tema_new'>
			<button class="btn btn-primary mt-2 pt-1 pb-1" :disabled="habilitar_boton==false" @click.prevent='editarTema'>Aceptar</button>
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
				tema_new:''
			}
		},
		computed:{
			...mapState('temas',['tema','aleatorio'])
		},
		methods:{
			...mapMutations('temas',['aparecer_temas_opciones']),
			editarTema(){
				if (this.tema_new == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}

				if (this.tema_new.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				if (this.tema_new.length > 150 ) {
					this.mensaje = 'Numero de caracteres maximos 120'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				this.habilitar_boton = false
				axios.put('/temas/update/'+this.$route.params.id_submodulo+'/'+this.tema.id,{
					tema:this.tema_new
				})
				.then((res)=>{
					this.mensaje     = res.data.mens
					this.clase_alert = res.data.color
					this.habilitar_alert = true
					this.habilitar_boton = true
					this.tema.tema = res.data.tema.tema
					console.log(res.data)
					console.log(this.tema.tema)
				})
				.catch((err)=>{
					this.habilitar_boton = true
					console.log('error')
				})
			}
		},
		watch:{
			tema:function(){
				this.tema_new=this.tema.tema
			},
			aleatorio:function(){
				this.mensaje=''
				this.habilitar_alert=false
				this.clase_alert=''
				this.habilitar_boton=true
				this.tema_new=''
			}
		}
	};
</script>