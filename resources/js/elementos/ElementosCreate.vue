<template>
	<div>
		<p class="mb-2" style="font-size:1.1em">
			Crear un elemento para: <a class="text-success d-inline">{{ subtema.subtema }}</a>
			&nbsp; <a href="" style="font-size:.9em" @click.prevent='aparecer_subtemas_info'>regresar al contenido</a>
		</p>
		<form class="mb-4">
			<mensajes :mensaje='mensaje' :habilitar_alert='habilitar_alert' :clase_alert='clase_alert'></mensajes>
			<label>Nombre del nuevo elemento</label>
			<input type="text" class="form-control" v-model='elemento'>
			<button class="btn btn-primary mt-2 pt-1 pb-1" :disabled="habilitar_boton==false" @click.prevent='createElemento'>
				Aceptar
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
				elemento:'',
				habilitar_boton:true,
				clase_alert:'',
				habilitar_alert:false,
				mensaje:''
			}
		},
		computed:{
			...mapState('temas',['subtema']),
		},
		methods:{
			...mapMutations('temas/subtemasx',['aparecer_subtemas_info']),
			createElemento(){
				if (this.elemento == '') {
					this.mensaje = 'Campo del formulario vacio'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}

				if (this.elemento.length < 3 ) {
					this.mensaje = 'Numero de caracteres minimo 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}

				if (this.elemento.length > 150 ) {
					this.mensaje = 'Numero de caracteres maximos 220'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				this.habilitar_boton = false;
				axios.post('/elementos/create/'+this.subtema.id,{
					elemento:this.elemento
				})
				.then((res)=>{
					this.mensaje  = res.data.mens;
					this.clase_alert = res.data.color;
					this.habilitar_alert = true
					this.habilitar_boton = true;
					this.subtema.elementos.push(res.data.elemento)
					console.log(res.data)
				})
				.catch((err)=>{
					this.habilitar_boton = true
				})
			}
		},
		watch:{
			subtema:function(){
				this.elemento = ''
				this.clase_alert=''
				this.habilitar_alert=false
				this.mensaje=''
			}
		}
	};
</script>