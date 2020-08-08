export default{
	namespaced:true,
	state:{
		subtemas_info:true,
		subtemas_delete:false,
		subtemas_update:false,
		elementos_create:false,
		apuntes_panel:false,
		apunte:''
	},
	mutations:{
		aparecer_subtemas_info(state){
			state.apuntes_panel = false
			state.elementos_create = false
			state.subtemas_delete = false
			state.subtemas_update = false
			state.subtemas_info = true
		},
		aparecer_subtemas_update(state){
			state.apuntes_panel = false
			state.elementos_create = false
			state.subtemas_info   = false
			state.subtemas_delete = false
			state.subtemas_update = true
		},
		aparecer_subtemas_delete(state){
			state.apuntes_panel = false
			state.elementos_create = false
			state.subtemas_info   = false
			state.subtemas_update = false
			state.subtemas_delete = true
		},
		aparecer_elementos_create(state){
			state.apuntes_panel = false
			state.subtemas_info    = false
			state.subtemas_update  = false
			state.subtemas_delete  = false
			state.elementos_create = true
		},
		aparecer_apuntes_panel(state,value){
			state.subtemas_info    = false
			state.subtemas_update  = false
			state.subtemas_delete  = false
			state.elementos_create = false
			state.apuntes_panel    = true
			state.apunte = value
		},
		memin(state){
			let memo = state.valorsito
			alert(memo)
		},
		restartOpciones(state){
			state.apuntes_panel    = false
			state.subtemas_delete  = false
			state.subtemas_update  = false
			state.elementos_create = false
			state.subtemas_info    = true
		},
	}
}