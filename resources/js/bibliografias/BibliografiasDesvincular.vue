<template>
	<div>
		<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" style="margin-top:70px">
			    <div class="modal-content">
				    <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Desvincular Bibliografia</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				    </div>
				    <div class="modal-body">
						<div v-if='(habilitar==true)'>		
							¿Desea desvincular a "<a class="text-danger">{{ bibliografiax.titulo }}</a>" de este apunte?
							<br>
							Si lo hace todos los segmentos con los que haya sido relacionados se desvincularan
						</div>
						<div v-else>
							{{ mensaje_eliminar }}
						</div>
				    </div>
				    <div class="modal-footer">
					    <div v-if='(habilitar==true)'>	
					    	<button type="button" class="btn btn-danger pt-1 pb-1" @click='deleteBibliografia' :disabled='habilitar_boton==false'>Aceptar</button>   
					    	<button type="button" class="btn btn-secondary pt-1 pb-1" data-dismiss="modal">Close</button>
					    </div>
					    <div v-else>
					    	<button type="button" class="btn btn-secondary pt-1 pb-1" data-dismiss="modal">Close</button>
					    </div>

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
				habilitar:true,
				mensaje_eliminar:''
			}
		},
		computed:{
			...mapState('bibliografias',['bibliografiax']),
			...mapState('temas',['tema','bibliografias']),
		},
		methods:{
			deleteBibliografia(){
				this.habilitar_boton = false
				axios.delete('/bibliografias/delete/'+this.$route.params.id+'/'+this.bibliografiax.id)
				.then((res)=>{
					this.habilitar_boton = true
					console.log(res.data)
					let myQueryId = this.bibliografiax.id
					let resultado = this.bibliografias.find(busqueda=> busqueda.id === myQueryId);
					let pos = this.bibliografias.indexOf(resultado)
					this.bibliografias.splice(pos,1);
					this.habilitar = false
					this.mensaje_eliminar = res.data.mens
				})
				.catch((err)=>{
					this.habilitar_boton = true
				})
			}
		},
		watch:{
			bibliografiax:function(){
				this.habilitar_boton=true
				this.habilitar=true
				this.mensaje_eliminar=''
			}
		}
	};
</script>