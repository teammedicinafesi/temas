<template>
	<div style="margin-left:1px">
		
		<div v-for="(submodulo,index) in submodulos" :key="index">
			<p style="font-size:1.1em" class="mb-3">{{ submodulo.submodulo }}</p>
			
			<p  style="font-size:1.05em;" v-for='(tema,indexT) in submodulos[index].temas'>
				<router-link :to="'/temas/'+tema.id+'/modulo/'+modulo.id" class='text-dark' style='margin-left:15px'>
					<i class="fas fa-caret-right"></i> 
				    {{ tema.tema }}
				</router-link>
			</p>
			<hr>

		</div>


		
	</div>
</template>
<script>
	import {mapState} from 'vuex';
	export default{
		computed:{
			...mapState('submodulos',['submodulos','modulo'])
		}
	};
</script>