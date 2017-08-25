/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.Vue.component('project', require('./components/project.vue'));
window.Vue.component('project-status-dropdown', require('./components/project-status-dropdown.vue'));
window.Vue.component('project-list', require('./components/project-list.vue'));
window.Vue.component('new-project-form', require('./components/new-project-form.vue'));

import datePicker from 'vue-bootstrap-datetimepicker';
import 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css';
Vue.use(datePicker);



var projects = [];

const app = new Vue({
    el: '#app',
    data: {
        projectType: 'active',
        showForm: false,
        projects: projects
    },
    methods: {
        handleNewProject() {
            this.showForm = false;
            this.getActiveProjects();
        },
        cancelNewProject() {
            this.showForm = false;
        },
        getActiveProjects() {
            this.projectType = 'active';
            this.getProjects();
        },
        getArchivedProjects() {
            this.projectType = 'archived';
            this.getProjects();
        },
        getProjects() {
            var url = '/projects'
            if (this.projectType == 'archived') {
                url = '/projects?archived=1'
            }
            window.axios.get(url).then((response) => {
                this.projects = response.data;
            });
        }
    },
    mounted() {
        this.getActiveProjects();
    }
});
