<template>
	<div>
		<p class="d-inline" style="font-size:1.1em">{{ subtema.subtema }} 
			
			&nbsp;
			<a href="" @click.prevent='aparecerTextarea'>  
				<i class="far fa-edit" style="font-size:.7em"></i> 
			</a>
			<a href="" @click.prevent='aparecerUpdateDelete'>
				<i class="fas fa-highlighter" style="font-size:.8em"></i>
			</a>
		</p>
		<div class="mt-1" v-show='(aparecer_textarea==true)'>
			<subtemas-escritura @esconderTextarea='esconderTextarea'></subtemas-escritura>
		</div>
		<div class="mt-1" v-show='(aparecer_update_delete==true)'>
			<button class="btn btn-sm btn-success" @click='aparecer_elementos_create'>Crear Elemento</button>
			<button class="btn btn-sm btn-primary" @click='aparecer_subtemas_update'>Editar Subtema</button>
			<button class="btn btn-sm btn-danger"  @click='aparecer_subtemas_delete'>Eliminar subtema</button>
			&nbsp;
			<a href="" @click.prevent='esconderUpdateDelete' class="align-bottom"><i class="far fa-minus-square"></i></a>
		</div>

		<div>
			<ul style="margin-left: -15px;margin-right:10px" class="mt-2">
				<li v-for='(apunte,index) in subtema.apuntes' :key='index' class="mb-1 text-justify">
					<div class="resaltar">
						<a href="" @click.prevent='aparecer_apuntes_panel(apunte)' style="color:black" >
						{{ apunte.apunte }}
						</a>
					</div>
				</li>	
			</ul>
		</div>
	</div>
</template>

<script>
	import {mapState} from 'vuex';
	import {mapMutations} from 'vuex';
	export default{
		data(){
			return{
				aparecer_update_delete:false,
				aparecer_textarea:false
			}
		},
		computed:{
			...mapState('temas',['subtema','aleatorio']),
		},
		methods:{
			...mapMutations('temas/subtemasx',['aparecer_subtemas_update','aparecer_subtemas_delete','aparecer_elementos_create','aparecer_apuntes_panel']),
			aparecerUpdateDelete(){
				this.aparecer_textarea = false;
				this.aparecer_update_delete = true;
			},
			aparecerTextarea(){
				this.aparecer_update_delete = false;
				this.aparecer_textarea = true;
			},
			esconderTextarea(){
				this.aparecer_textarea = false;
			},
			esconderUpdateDelete(){
				this.aparecer_update_delete = false;
			}
		},
		watch:{
			subtema:function(){
				this.aparecer_update_delete = false;
				this.aparecer_textarea = false;
			},
			aleatorio:function(){
				this.aparecer_update_delete = false;
				this.aparecer_textarea = false;
			}
			/*subtema:function(){
				this.$store.commit('temas/subtemasx/restartOpciones')
			}*/
		}

	};
</script>