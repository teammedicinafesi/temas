export default{
	namespaced:true,
	state:{
		modulos:'',
        modulos_listado: true,
        modulos_create:false,
        modulos_update:false,
        modulos_delete:false,
        modulo:''
	},
	mutations:{
		aparecer_modulos_listado(state){
            state.modulos_create  = false
            state.modulos_update  = false
            state.modulos_delete  = false
            state.modulos_listado = true
        },
        aparecer_modulos_create(state){
            state.modulos_listado = false
            state.modulos_update  = false
            state.modulos_delete  = false
            state.modulos_create  = true
        },
        aparecer_modulos_update(state,modulo){
            state.modulos_create  = false
            state.modulos_delete  = false
            state.modulos_listado = false
            state.modulos_update  = true
            state.modulo = modulo
        },
        aparecer_modulos_delete(state,modulo){
            state.modulos_create  = false
            state.modulos_update  = false
            state.modulos_listado = false
            state.modulos_delete  = true
            state.modulo = modulo
        },
        commitModulos(state,accion){
            state.modulos = accion
        }
	},
	actions:{
		actionModulos({commit}){
            axios.get('/modulosapi/')
            .then((res)=>{
                let vari = res.data.modulos
                commit('commitModulos',vari)
            })
        }
	}
}