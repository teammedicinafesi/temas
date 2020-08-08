
<!--<button @click="$store.commit('aumentar')" class="btn btn-sm btn-primary">+</button>-->
<template>
	<div>
		este es un hijo
		<button @click="aumentar" class="btn btn-sm btn-primary">+</button> - num: {{ count }}
		<button @click="disminuir(2)" class="btn btn-sm btn-primary">-</button>
		<button @click="obtenerCursos">obtener</button>
		{{ cursos }}
	</div>
</template>

<script>
	import {mapState} from 'vuex'
	import {mapMutations} from 'vuex'
	import {mapActions} from 'vuex'
	export default{
		computed:{
			/*numero(){
				return this.$store.state.count
			}*/
			...mapState(['count','cursos'])
		},
		methods:{
			...mapMutations(['aumentar','disminuir']),
			...mapActions(['obtenerCursos']) 

		},
		created(){
			this.$store.dispatch('obtenerCursos',4)
		}
	};
</script>