import Vuex from 'vuex';
import modulos from '../vuex/modulos.js';
import submodulos from '../vuex/submodulos.js';
import temas from '../vuex/temas.js';
Vue.use(Vuex);

export default new Vuex.Store({
    state:{
    	valorsito:'1212'
    },
    modules:{
        modulos,
        submodulos,
        temas
    }
})