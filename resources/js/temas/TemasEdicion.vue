<template>
	<div>
		<div v-show='(temas_opciones_edicion==true)'>
			<p style="font-size:1.05em">
				<a href='' style="color:black" @click.prevent='aparecer_temas_update'><i class="fas fa-eraser text-success" style="font-size:.9em"></i> Editar nombre del tema</a>
			</p>
			<p style="font-size:1.05em">
				<a href='' style="color:black" @click.prevent='aparecer_temas_delete'><i class="far fa-trash-alt text-danger" style="font-size:.9em"></i> Borrar tema</a>
			</p>
			<p style="font-size:1.05em">
				<a href='' style="color:black"><i class="fas fa-paperclip" style="font-size:.9em"></i> Relacionar con otro subtema</a>
			</p>
		</div>
		<temas-update v-show='(temas_update==true)'></temas-update>
		<temas-delete v-show='(temas_delete==true)'></temas-delete>
	</div>
</template>

<script>
	import {mapState} from 'vuex';
	import {mapMutations} from 'vuex';
	export default{
		computed:{
			...mapState('temas',['tema','temas_opciones_edicion','temas_update','temas_delete'])
		},
		methods:{
			...mapMutations('temas',['aparecer_temas_update','aparecer_temas_delete'])
		}
	};
</script>