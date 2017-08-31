<template>
    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Responsible</th>
                    <th>Next Action</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="projects.length == 0">
                    <td>No Projects</td>
                </tr>
                <project v-else v-for="project in orderedProjects" :project="project" :key="project.id"
                         v-on:update="updateParent"></project>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    const _ = window._;
    const moment = window.moment;

    export default {
        props: ['projects', 'order'],
        computed: {
            orderedProjects() {
                switch (this.order) {
                    case 'name':
                        return _.orderBy(this.projects, [project => project.name.toLowerCase()]);
                        break;
                    case 'date':
                        return _.orderBy(this.projects, [project => moment(project.end_date, 'MM/DD/YYYY')]);
                        break;
                    case 'status':
                        return _.orderBy(this.projects, 'status');
                        break;
                }
            }
        },
        methods: {
            updateParent() {
                this.$emit('update');
            }
        }
    }
</script>