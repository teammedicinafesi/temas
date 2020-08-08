<template>
	<div>
		<h6 class="text-uppercase text-secondary fonr-weight-bolder">
            PANEL DE OPCIONES
            <!----> <!----> 
        </h6>
        <div class="form-row">
            <div class="form-group col-md-6">
                <button class="btn btn-sm btn-block btn-secondary" @click='aparecer_temas_contenido'>Contenido</button>
            </div> 
            <div class="form-group col-md-6">
                <button class="btn btn-sm btn-block btn-secondary" @click='aparecer_bibliografias_index'>Bibliografia</button>
            </div>
        </div>
        <div v-for="(subtema,index) in subtemas" :key='index'>
            <p>
                <a href="" style="color:black" @click.prevent='aparecer_subtemas_contenido(subtema)'>
                    <i class="far fa-circle" style="font-size:.75em;color:#3490dc"></i>
                    {{ subtema.subtema }}
                </a> 

                <a  v-for='(elemento,indexT) in subtemas[index].elementos' style="margin-left:10px;color:black" href="" class="d-block">
                    <i class="fas fa-angle-right" style="font-size:.9em;color:#3490dc"></i> {{ elemento.elemento }}
                </a>

            </p>
        </div>
        <p class="mb-2">
        	<a href="" @click.prevent='aparecer_subtemas_create'><i class="far fa-plus-square" style="font-size:.9em"></i> Crear Subtema</a>
        </p>
        <!--<p class="mb-2">
        	<a href="" @click.prevent='aparecer_submodulos_create'><i class="far fa-plus-square" style="font-size:.9em"></i> Creacion rapido</a>
        </p>-->
        <p class="mb-2">
        	<a href="" @click.prevent='aparecer_temas_edicion'><i class="fas fa-wrench" style="font-size:.9em"></i> Opciones de edición</a>
        </p>
        <p>
			<router-link :to="'/submodulos/'+$route.params.id_modulo"><i class="fas fa-arrow-left" style="font-size:.9em"></i> Regresar al Submodulo</router-link>
		</p>

	</div>
</template>

<script>
	import {mapMutations} from 'vuex';
    import {mapState} from 'vuex';
	export default{
        computed:{
            ...mapState('temas',['subtemas'])
        },
		methods:{
			...mapMutations('temas',[
				'aparecer_temas_contenido',
				'aparecer_subtemas_create',
				'aparecer_temas_edicion',
                'aparecer_subtemas_contenido',
                'aparecer_bibliografias_index'
				])
		}
	};
</script>