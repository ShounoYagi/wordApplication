import VueRouter from 'vue-router';
import HeaderComponent from "./components/HeaderComponent";
import QuestionShowComponent from "./components/QuestionShowComponent";
import QuestionCreateComponent from "./components/QuestionCreateComponent";
import QuestionEditComponent from "./components/QuestionEditComponent";
import QuestionListComponent from "./components/QuestionListComponent"

import QuestionSetsListComponent from "./components/QuestionSetsListComponent";
import QuestionSetsCreateComponent from "./components/QuestionSetsCreateComponent";
import QuestionSetsEditComponent from "./components/QuestionSetsEditComponent";

import ExaminationComponent from "./components/ExaminationComponent"

import ExampleComponent from "./components/ExampleComponent"
import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/ja'
import 'element-ui/lib/theme-chalk/index.css'
import 'element-ui/lib/theme-chalk/display.css'
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(VueRouter);
Vue.use(ElementUI, { locale })

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/questions',
            name: 'question.list',
            component: QuestionListComponent
        },
        {
            path: '/questions/create',
            name: 'question.create',
            component: QuestionCreateComponent
        },
        {
            path: '/questions/:questionId',
            name: 'question.show',
            component: QuestionShowComponent,
            props: true
        },
        {
            path: '/questions/:questionId/edit',
            name: 'question.edit',
            component: QuestionEditComponent,
            props: true
        },

        {
            path: '/questionSets',
            name: 'questionSets.list',
            component: QuestionSetsListComponent
        },
        {
            path: '/questionSets/create',
            name: 'questionSets.create',
            component: QuestionSetsCreateComponent
        },
        {
            path: '/questionSets/:questionSetId/edit',
            name: 'questionSets.edit',
            component: QuestionSetsEditComponent,
            props: true
        },
        {
            path: '/examination/:questionSetId',
            name: 'examination',
            component: ExaminationComponent,
            props: true
        },
        {
            path: '/example',
            name: 'example',
            component: ExampleComponent
        },
        
    ]
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('header-component', HeaderComponent);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
