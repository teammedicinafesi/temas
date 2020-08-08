<template>
	<div>
		<table class="table mt-3">
			<thead>
				<tr>
					<th>##</th>
					<th>Titulo</th>
					<th>Tipo</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for='(bibliografia,index) in bibliografias' :key='index'>
					<td>{{ index+1}}</td>
					<td>{{ bibliografia.titulo }}</td>
					<td>{{ bibliografia.tipo }}</td>
					<td>
						<div style="width:100px">
							
						</div>
						<button class="btn btn-sm btn-info pt-0 pb-0" @click='infoBibliografia(bibliografia)' data-toggle='modal' data-target='#modalInfo'>
							<i class="fas fa-info" style="font-size:.9em;color:white"></i>
						</button>
						<button class="btn btn-sm btn-primary pt-0 pb-0" @click='updateBibliografia(bibliografia)' data-toggle='modal' data-target='#modalUpdate'>
							<i class="fas fa-eraser" style="font-size:.9em"></i>
						</button>
						<button class="btn btn-sm btn-danger pt-0 pb-0" @click='deleteBibliografia(bibliografia)' data-toggle='modal' data-target='#modalDelete'>
							<i class="fas fa-backspace" style="font-size:.9em"></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
		<bibliografias-info></bibliografias-info>
		<bibliografias-update></bibliografias-update>
		<bibliografias-desvincular></bibliografias-desvincular>
	</div>
</template>

<script>
	import {mapState} from'vuex';
	import {mapMutations} from'vuex'
	export default{
		computed:{
			...mapState('temas',['tema','bibliografias']),
		},
		methods:{
			...mapMutations('bibliografias',['infoBibliografia','updateBibliografia','deleteBibliografia'])
		}
	};
</script>