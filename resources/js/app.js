require('./bootstrap');

import router from './assets/router.js';
import store from './assets/vuex.js';

Vue.component('mensajes',require('./generales/Mensajes.vue').default);

Vue.component('modulos-listado',require('./modulos/ModulosListado.vue').default);
Vue.component('modulos-create',require('./modulos/ModulosCreate.vue').default);
Vue.component('modulos-update',require('./modulos/ModulosUpdate.vue').default);
Vue.component('modulos-delete',require('./modulos/ModulosDelete.vue').default);

Vue.component('submodulos-listado',require('./submodulos/SubmodulosListado.vue').default);
Vue.component('submodulos-portada',require('./submodulos/SubmodulosPortada.vue').default);
Vue.component('submodulos-create',require('./submodulos/submodulosCreate.vue').default);
Vue.component('submodulos-show',require('./submodulos/SubmodulosShow.vue').default);

Vue.component('submodulos-temas',require('./submodulos/SubmodulosTemas.vue').default);
Vue.component('submodulos-update',require('./submodulos/SubmodulosUpdate.vue').default);
Vue.component('submodulos-delete',require('./submodulos/SubmodulosDelete.vue').default);

Vue.component('temas-create',require('./temas/TemasCreate.vue').default);
Vue.component('temas-indice',require('./temas/TemasIndice.vue').default);
Vue.component('temas-contenido',require('./temas/TemasContenido').default);
Vue.component('temas-edicion',require('./temas/TemasEdicion').default);
Vue.component('temas-update',require('./temas/TemasUpdate').default);
Vue.component('temas-delete',require('./temas/TemasDelete').default);

Vue.component('subtemas-create',require('./subtemas/SubtemasCreate.vue').default);
Vue.component('subtemas-contenido',require('./subtemas/SubtemasContenido.vue').default);

Vue.component('subtemas-texto',require('./subtemas/SubtemasTexto.vue').default);
Vue.component('subtemas-update',require('./subtemas/SubtemasUpdate.vue').default);
Vue.component('subtemas-delete',require('./subtemas/SubtemasDelete.vue').default);
Vue.component('subtemas-escritura',require('./subtemas/SubtemasEscritura.vue').default);

Vue.component('elementos-create',require('./elementos/ElementosCreate.vue').default);
Vue.component('apuntes-panel',require('./apuntes/ApuntesPanel.vue').default);

Vue.component('bibliografias-index',require('./bibliografias/BibliografiasIndex.vue').default);
Vue.component('bibliografias-tabla',require('./bibliografias/BibliografiasTabla.vue').default);
Vue.component('bibliografias-create',require('./bibliografias/BibliografiasCreate.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store
});
