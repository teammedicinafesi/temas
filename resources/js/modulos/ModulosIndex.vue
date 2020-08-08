<template>
	<div class="row" style="margin-top: 33px">
		<div class="col-md-12">
			<modulos-listado v-show='(modulos_listado==true)'></modulos-listado>
		    <modulos-create v-show='(modulos_create==true)'></modulos-create>
		    <modulos-update v-show='(modulos_update==true)'></modulos-update>
		    <modulos-delete v-show='(modulos_delete==true)' ></modulos-delete>
		</div>
	</div>
</template>
<script>
	import {mapState} from 'vuex';
	export default{
		computed:{
			...mapState('modulos',['modulos','modulos_listado','modulos_create','modulos_update','modulos_delete'])
		},
		created(){
			this.$store.dispatch('modulos/actionModulos')

		}
	};
</script>