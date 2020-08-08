<template>
	<div>
		<h6 class="text-uppercase text-secondary fonr-weight-bolder mb-3">
            ÍNDICE DE SUBMODULOS
        </h6> 
        
        <p v-for='(submodulo,index) in submodulos' :key='index'>
             <a href="" style="color:black" @click.prevent="aparecer_submodulos_show(submodulo)">
                <i class="far fa-circle" style="font-size:.75em;color:#3490dc"></i>
                {{ submodulo.submodulo.toUpperCase() }}
            </a>    
        </p>
        
        <p class="mb-2">
        	<a href="" @click.prevent='aparecer_submodulos_create'><i class="far fa-plus-square" style="font-size:.9em"></i> Crear un Submodulo</a>
        </p>
        <p class="mb-2">
        	<a href="" @click.prevent='aparecer_submodulos_portada' class="d-block">
				<i class="far fa-list-alt"></i> Ver portada
			</a>
        </p>
		<p>
			<router-link to="/modulos"><i class="fas fa-arrow-left" style="font-size:.9em"></i> Regresar a Modulos</router-link>
		</p>

	</div>
</template>
<script>
    import {mapMutations} from 'vuex';
    import {mapState} from 'vuex';
	export default{
        computed:{
            ...mapState('submodulos',['submodulos'])
        },
        methods:{
            ...mapMutations('submodulos',['aparecer_submodulos_portada','aparecer_submodulos_create','aparecer_submodulos_show']), 
        }
	};
</script>