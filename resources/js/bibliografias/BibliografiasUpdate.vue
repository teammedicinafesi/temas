<template>
	<div>
		<div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" style="margin-top:70px">
			    <div class="modal-content">
				    <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Modificar datos de la Bibliografía</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				    </div>
				    <div class="modal-body">
						<form>
				        	<label class="mb-0" for="">Título</label>
				        	<input type="text" class="form-control form-control-sm mb-3" v-model='titulo_new'>

				        	<label class="mb-0" for="">Descripción <small>(opcional)</small></label>
				        	<input type="text" class="form-control form-control-sm mb-3" v-model='descripcion_new'>
								
							<label class="mb-0">Tipo</label>
							<select class="form-control form-control-sm mb-3" v-model='tipo_new'>
								<option value="articulo">Articulo</option>
								<option value="libro">Libro</option>
								<option value="sitio_web">Sitio Web</option>
								<option value="gpc">Guia de Practica Clínica</option>
							</select>

				        	<label class="mb-0" for="">Cita</label>
				        	<textarea class="form-control mb-3" rows="2" v-model='cita_new'></textarea>

				        	<label class="mb-0" for="">Link <small>(opcional)</small></label>
				        	<input type="text" class="form-control form-control-sm mb-3" v-model='link_new'>
				        </form>
				    </div>
				    <div class="modal-footer">
				        <small style="font-size:.9em"> {{ mensaje_bibliografia }}</small>
				    	<button type="button" class="btn btn-primary pt-1 pb-1" @click='updateBibliografia' :disabled='habilitar_boton==false'>Aceptar</button>
				        <button type="button" class="btn btn-secondary pt-1 pb-1" data-dismiss="modal">Close</button>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</template>

<script>
	import {mapState} from'vuex';
	export default{
		data(){
			return{
				titulo_new:'',
				descripcion_new:'',
				tipo_new:'',
				cita_new:'',
				link_new:'',
				mensaje_bibliografia:'',
				habilitar_boton:true
			}
		},
		computed:{
			...mapState('bibliografias',['bibliografiax'])
		},
		methods:{
			updateBibliografia(){
				if (this.titulo_new == '' || this.tipo_new == '' || this.cita_new=='') {
					this.mensaje_bibliografia = 'Los campos Titulo, Tipo y Cita son obligatorios'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false
				}
				if (this.titulo_new.length < 3 || this.tipo_new.length < 3 || this.cita_new.length < 3) {
					this.mensaje_bibliografia = 'El numero de caracteres minimo es de 3'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				if (this.titulo_new.length > 200 || this.tipo_new.length > 11 || this.cita_new.length > 1000) {
					this.mensaje_bibliografia = 'Se exedio en el numero de caracteres permitidos en un campo'
					this.clase_alert = 'alert-warning'
					this.habilitar_alert =true
					return false	
				}
				this.habilitar_boton = false
				axios.post('/bibliografias/update/'+this.bibliografiax.id,{
					titulo:this.titulo_new,
					descripcion:this.descripcion_new,
					tipo:this.tipo_new,
					cita:this.cita_new,
					link:this.link_new
				})
				.then((res)=>{
					this.habilitar_boton = true
					//this.bibliografias.push(res.data.bibliografia)
					//this.mensaje_bibliografia = res.data.mens
					console.log(res.data)
					this.mensaje_bibliografia = res.data.mens
					this.bibliografiax.titulo = this.titulo_new 
					this.bibliografiax.descripcion = this.descripcion_new
					this.bibliografiax.tipo = this.tipo_new
					this.bibliografiax.cita = this.cita_new
					this.bibliografiax.link = this.link_new
				})
				.catch((err)=>{
					this.habilitar_boton = true
					console.log(err)
				})
			}

		},
		watch:{
			bibliografiax:function(){
				this.titulo_new=this.bibliografiax.titulo
				this.descripcion_new=this.bibliografiax.descripcion
				this.tipo_new=this.bibliografiax.tipo
				this.cita_new=this.bibliografiax.cita
				this.link_new=this.bibliografiax.link
			}
		}
	};
</script>