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
                </tr>
                </thead>
                <tbody>
                <tr v-if="projects.length == 0">
                    <td>No Projects</td>
                </tr>
                <project v-else v-for="project in projects" :project="project" :key="project.id" v-on:update="updateParent"></project>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['projects'],
        methods: {
            updateParent() {
                this.$emit('update');
            }
        }
    }
</script>