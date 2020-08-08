<template>
	<div>
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" style="margin-top:70px">
			    <div class="modal-content">
				    <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Registrar nueva Bibliografia</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				    </div>
				    <div class="modal-body">
				        <form>
				        	<!--
							a futuro poner aqui las opciones de los distintos formatos para registrar info
							tambien poner como opcion rapida articulos y libros
				        	-->
				        	<label class="mb-0" for="">Título</label>
				        	<input type="text" class="form-control form-control-sm mb-3" v-model='titulo'>

				        	<label class="mb-0" for="">Descripción <small>(opcional)</small></label>
				        	<input type="text" class="form-control form-control-sm mb-3" v-model='descripcion'>
								
							<label class="mb-0">Tipo</label>
							<select class="form-control form-control-sm mb-3" v-model='tipo'>
								<option value="articulo">Articulo</option>
								<option value="libro">Libro</option>
								<option value="sitio_web">Sitio Web</option>
								<option value="gpc">Guia de Practica Clínica</option>
							</select>

				        	<label class="mb-0" for="">Cita</label>
				        	<textarea class="form-control mb-3" rows="2" v-model='cita'></textarea>

				        	<label class="mb-0" for="">Link <small>(opcional)</small></label>
				        	<input type="text" class="form-control form-control-sm mb-3" v-model='link'>
				        </form>
				    </div>
				    <div class="modal-footer">
				    	<small style="font-size:.9em"> {{ mensaje_bibliografia }}</small>
				    	<button type="button" class="btn btn-primary pt-1 pb-1" @click='guardarBibliografia' :disabled='habilitar_boton==false'>Aceptar</button>
				        <button type="button" class="btn btn-secondary pt-1 pb-1" data-dismiss="modal">Close</button>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</template>

<script>
	import {mapState} from 'vuex';
	export default{
		data(){
			return{
				habilitar_boton:true,
				titulo:'',
				descripcion:'',
				tipo:'',
				cita:'',
				link:'',
				mensaje_bibliografia:'',
			}
		},
		computed:{
            ...mapState('temas',['tema','bibliografias'])
        },
		methods:{
			guardarBibliografia(){
				if (this.titulo == '' || this.tipo == '' || this.cita=='') {
					this.mensaje_bibliografia = 'Los campos Titulo, Tipo y Cita son obligatorios'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}
				if (this.titulo.length < 3 || this.tipo.length < 3 || this.cita.length < 3) {
					this.mensaje_bibliografia = 'El numero de caracteres minimo es de 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				if (this.titulo.length > 200 || this.tipo.length > 11 || this.cita.length > 1000) {
					this.mensaje_bibliografia = 'Se exedio en el numero de caracteres permitidos en un campo'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				this.habilitar_boton = false
				axios.post('/bibliografias/create/'+this.tema.id,{
					titulo:this.titulo,
					descripcion:this.descripcion,
					tipo:this.tipo,
					cita:this.cita,
					link:this.link
				})
				.then((res)=>{
					this.habilitar_boton = true
					this.bibliografias.push(res.data.bibliografia)
					this.mensaje_bibliografia = res.data.mens
					console.log(res.data)
				})
				.catch((err)=>{
					this.habilitar_boton = true
					console.log(err)
				})
			}
		}
	};
</script>