<template>
	<div class="mb-4">
		<subtemas-texto v-show='(subtemas_info==true)'></subtemas-texto>
		<subtemas-delete v-show='(subtemas_delete==true)'></subtemas-delete>
		<subtemas-update v-show='(subtemas_update==true)'></subtemas-update>
		<elementos-create v-show='(elementos_create==true)' ></elementos-create>
		<apuntes-panel v-show='(apuntes_panel==true)' ></apuntes-panel>
	</div>
</template>

<script>
	import {mapState} from 'vuex';
	import {mapMutations} from 'vuex';
	export default{
		data(){
			return{
				
			}
		},
		methods:{
			...mapMutations(['padre']),
			...mapMutations('temas',['hijo']),
			...mapMutations('temas/subtemasx',['memo']),
			
		},
		computed:{
			...mapState('temas',['subtema','aleatorio']),
			
			/*...mapState('temas/subtemasx', {
			    numero: state => state.numero,
			}),*/

			...mapState('temas/subtemasx',['subtemas_info','subtemas_delete','subtemas_update','elementos_create','apuntes_panel']),

			vari(){
				this.$store.state.temas.sub.numero
			}
		},
		watch:{
			subtema:function(){
				this.$store.commit('temas/subtemasx/restartOpciones')
			},
			aleatorio:function(){
				this.$store.commit('temas/subtemasx/restartOpciones')	
			}
		}
	};
</script>