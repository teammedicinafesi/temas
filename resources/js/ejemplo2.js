require('./bootstrap');

import router from './assets/router.js';
import Vuex from 'vuex';

const store = new Vuex.Store({
	state: {
	    modulos:'',
	    modulos_listado: true,
	    modulos_create:false,
	},
	mutations:{
	  	aparecer_modulos_listado(state){
	  		state.modulos_create  = false
	  		state.modulos_listado = true
		},
	  	aparecer_modulos_create(state){
	  		state.modulos_listado = false
	  		state.modulos_create  = true
	  	},
	  	commitModulos(state,accion){
	  		state.modulos = accion
	  	}
	},
	actions:{
		actionModulos({commit}){
			axios.get('/modulosapi/')
	  		.then((res)=>{
	  			commit('commitModulos',res.data)
	  		})
		}
	}
})

Vue.component('modulos-listado',require('./modulos/ModulosListado.vue').default);
Vue.component('modulos-create',require('./modulos/ModulosCreate.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store
});
