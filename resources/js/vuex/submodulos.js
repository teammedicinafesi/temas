export default{
	namespaced:true,
	state:{
		contenedor:'',
		modulo:'',
		submodulos:'',
		submodulo:'',
		submodulos_portada:true,
		submodulos_create:false,
		submodulos_show:false,

		submodulos_temas:true,
		submodulos_update:false,
		submodulos_delete:false,
		temas_create:false,
		aleatorio:''
	},
	mutations:{
		aparecer_submodulos_portada(state){ 
			state.submodulos_create  = false;
			state.submodulos_show    = false;
			state.submodulos_portada = true;
		},
		aparecer_submodulos_create(state){
			state.submodulos_portada = false;
			state.submodulos_show    = false;
			state.submodulos_create  = true;
			state.aleatorio = Math.random();
		},
		aparecer_submodulos_show(state,value){
			state.submodulos_portada = false;
			state.submodulos_create  = false;
			state.submodulos_show    = true;
			state.submodulo = value;
		},
		/*----------------------------------*/
		aparecer_submodulos_temas(state){
			state.temas_create      = false
			state.submodulos_update = false;
			state.submodulos_delete = false;
			state.submodulos_temas  = true;
		},
		aparecer_submodulos_update(state){
			state.temas_create      = false
			state.submodulos_delete = false;
			state.submodulos_temas  = false;
			state.submodulos_update = true;
		},
		aparecer_submodulos_delete(state){
			state.temas_create      = false
			state.submodulos_update = false;
			state.submodulos_temas  = false;
			state.submodulos_delete = true;
		},
		aparecer_temas_create(state){
			state.submodulos_update = false;
			state.submodulos_delete = false;
			state.submodulos_temas  = false;
			state.temas_create      = true
		},
		/*-------------------------------*/
		commitSubmodulos(state,accion){
			state.contenedor = accion
			state.modulo     = accion.modulo
			state.submodulos = accion.submodulos
		},
		restarModulosShow(state){
			state.temas_create      = false
			state.submodulos_update = false;
			state.submodulos_delete = false;
			state.submodulos_temas  = true;
		},
		restarModulosIndex(state){
			state.submodulos_create  = false;
			state.submodulos_show    = false;
			state.submodulos_portada = true;
		}
	},
	actions:{
		actionSubmodulos({commit},id){
			axios.get('/submodulos/despachador/'+id)
			.then((res)=>{
				commit('commitSubmodulos',res.data)
			})
		}
	}
}