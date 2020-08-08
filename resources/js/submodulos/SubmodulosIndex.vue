<template>
	<div class="row" style="margin-top: 37px">
		<div class="col-md-9">
			<div class="mr-3">
				<div class="card mb-5" style="border:1px solid #ecf0f5;border-top:3px solid #3c8dbc">
					<div class="card-header pb-0" style="background-color: white;">
			            <h5 style="margin-left:-4px">{{ modulo.modulo }}</h5>
			        </div>
			        <div class="card-body pl-3 pt-3 pb-2">
			        	<submodulos-portada v-show='(submodulos_portada==true)'></submodulos-portada>
			        	<submodulos-create  v-show='(submodulos_create==true)'></submodulos-create>
			        	<submodulos-show    v-show='(submodulos_show==true)'></submodulos-show>
			        </div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<submodulos-listado></submodulos-listado>
		</div>
	</div>
</template>
<script>
	import {mapState} from 'vuex';
	export default{
		data(){
			return{

			}
		},
		computed:{
			...mapState('submodulos',['modulo','submodulos_portada','submodulos_create','submodulos_show'])
		},
		created(){
			this.$store.dispatch('submodulos/actionSubmodulos',this.$route.params.id)
			this.$store.commit('submodulos/restarModulosIndex')
		},
	};
</script>