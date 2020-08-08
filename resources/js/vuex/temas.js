import subtemasx from '../vuex/subtemas.js';
export default{
	namespaced:true,
	state:{
		contenedor:'',
		tema:'',
		subtemas:'',
		subtema:'',
		bibliografias:'',
		temas_contenido:true,
		subtemas_create:false,
		temas_edicion:false,
		bibliografias_index:false,

		temas_opciones_edicion:true,
		temas_update:false,
		temas_delete:false,

		subtemas_contenido:false,
		aleatorio:''
	},
	mutations:{
		hijo(state,rootState){
			let session = context.rootState.instance.session; 
			alert(state.valorsito+'-'+session)
		},
		aparecer_temas_contenido(state){
			state.bibliografias_index = false;
			state.subtemas_contenido = false;
			state.subtemas_create = false;
			state.temas_edicion   = false;
			state.temas_contenido = true;
		},
		aparecer_subtemas_create(state){
			state.bibliografias_index = false;
			state.subtemas_contenido = false;
			state.temas_contenido = false;
			state.temas_edicion   = false;
			state.subtemas_create = true;
			state.aleatorio = Math.random()
		},
		aparecer_subtemas_contenido(state,value){
			state.bibliografias_index = false;
			state.subtemas_create = false;
			state.temas_edicion   = false;
			state.temas_contenido = false;
			state.subtemas_contenido = true;
			state.subtema = value
			state.aleatorio = Math.random();
		},
		aparecer_temas_edicion(state){
			state.bibliografias_index = false;
			state.subtemas_contenido = false;
			state.subtemas_create = false;
			state.temas_contenido = false;
			state.temas_edicion   = true;

			state.temas_update = false
			state.temas_delete = false
			state.temas_opciones_edicion = true
		},
		aparecer_bibliografias_index(state){
			state.subtemas_contenido = false;
			state.temas_contenido = false;
			state.temas_edicion   = false;
			state.subtemas_create = false;
			state.bibliografias_index = true;
		},


		/*------------------------------*/
		aparecer_temas_opciones(state){
			state.temas_update = false;
			state.temas_delete = false
			state.temas_opciones_edicion = true;
		},
		aparecer_temas_update(state){
			state.temas_opciones_edicion = false
			state.temas_delete = false
			state.temas_update = true
			state.aleatorio = Math.random()
		},
		aparecer_temas_delete(state){
			state.temas_opciones_edicion = false
			state.temas_update = false
			state.temas_delete = true
		},
		/*------------------------------*/
		restarTemasIndex(state){
			state.subtemas_contenido = false;
			state.subtemas_create = false;
			state.temas_edicion   = false;
			state.bibliografias_index = false;
			state.temas_contenido = true;
		},
		/*--------------------------------*/
		commitTemas(state,accion){
			state.tema     = accion.tema
			state.subtemas = accion.subtemas
			state.bibliografias = accion.bibliografias

		},

	},
	actions:{
		actionTemas({commit},id){
			axios.get('/temas/despachador/'+id)
			.then((res)=>{
				commit('commitTemas',res.data)
			})
			.catch((err)=>{
				
			})
		}
	},
	modules:{
		subtemasx
	}
}