window.Vue = require('vue');
import VueRouter from 'vue-router';

import ModulosIndex from '../modulos/ModulosIndex.vue';
import SubmodulosIndex from '../submodulos/SubmodulosIndex';
import TemasIndex from '../temas/TemasIndex';

Vue.use(VueRouter);
export default new VueRouter({
	mode: 'history',
	routes:[
		{path:'/modulos', component: ModulosIndex},
		{path: '/submodulos/:id',component: SubmodulosIndex},
		{path: '/temas/:id/modulo/:id_modulo',component: TemasIndex}
	]
})