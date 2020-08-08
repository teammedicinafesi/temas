<template>
	<div class="row" style="margin-top: 37px;margin-bottom:100px">
		<div class="col-md-9 mb-3">
			<div class="card" style="border:1px solid #ecf0f5;border-top:3px solid #3c8dbc">
				<div class="card-header pb-0" style="background-color: white;">
					<h5 style="margin-left:-4px">{{ tema.tema }}</h5>
				</div>
				<div class="card-body pl-3 pt-3 pb-2">
					<temas-contenido v-show='(temas_contenido==true)'></temas-contenido>
					<subtemas-create v-show='(subtemas_create==true)'></subtemas-create>
					<temas-edicion v-show='(temas_edicion==true)'></temas-edicion>
					<subtemas-contenido v-show='(subtemas_contenido==true)'></subtemas-contenido>
					<bibliografias-index v-show='(bibliografias_index==true)'></bibliografias-index>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<temas-indice></temas-indice>
		</div>
	</div>
</template>

<script>
	import {mapState} from 'vuex';
	export default{
		computed:{
			...mapState('temas',['tema','temas_contenido','subtemas_create','temas_edicion','subtemas_contenido','bibliografias_index'])
		},
		created(){
			this.$store.dispatch('temas/actionTemas',this.$route.params.id)
			this.$store.commit('temas/restarTemasIndex')
		}
	};
</script>