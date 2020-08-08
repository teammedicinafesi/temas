require('./bootstrap');

import router from './assets/router.js';


Vue.component('padre',require('./modulos/padre.vue').default);
Vue.component('hijo',require('./modulos/hijo.vue').default);


import Vuex from 'vuex';

const store = new Vuex.Store({
  state: {
    count: 10,
    cursos:[]
  },
  mutations:{
  	aumentar(n){
  		this.state.count++
  	},
  	disminuir(state,n){
  		state.count -= n
  	},
  	llenar(state,cursosAccion){
  		state.cursos = cursosAccion
  	}

  },
  actions:{
  	obtenerCursos({commit},value){
  		axios.get('/modulosapi/'+value)
  		.then((res)=>{
  			commit('llenar',res.data)
  		})
  	}
  }
})

const app = new Vue({
    el: '#app',
    router,
    store
});
