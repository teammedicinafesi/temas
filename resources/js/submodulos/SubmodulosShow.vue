<template>
	<div style="margin-left:1px">
		<submodulos-temas v-show='(submodulos_temas==true)'></submodulos-temas>
		<submodulos-update v-show='(submodulos_update==true)'></submodulos-update>
		<submodulos-delete v-show='(submodulos_delete==true)'></submodulos-delete>
		<temas-create v-show='(temas_create==true)'></temas-create>
	</div>
</template>
<script>
	import {mapState} from 'vuex';
	export default{
		computed:{
			...mapState('submodulos',['submodulo','submodulos_temas','submodulos_update','submodulos_delete','temas_create'])
		},
		watch:{
			submodulo:function(){
				this.$store.commit('submodulos/restarModulosShow')
			}
		}

	};
</script>