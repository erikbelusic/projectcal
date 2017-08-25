<template>

    <tr :class="statuses[project.status]">
        <td>
            <li v-for="item in project.history">{{ item.key }} was changed from {{ item.old_value }} to {{ item.new_value }}</li>
        </td>
        <th><input @blur="updateProject" class="form-control" v-model="project.name"></th>
        <td><project-status-dropdown @change="updateProject" v-model="project.status"></project-status-dropdown></td>
        <td>
            <date-picker v-model="project.start_date" :config="{format: 'MM/DD/YYYY', showClear: true}"></date-picker>
        </td>
        <td>
            <date-picker v-model="project.end_date" :config="{format: 'MM/DD/YYYY', showClear: true}"></date-picker>
        </td>
        <th><input @blur="updateProject" class="form-control" v-model="project.responsible_party"></th>
        <th><input @blur="updateProject" class="form-control" v-model="project.next_action"></th>
    </tr>

</template>

<script>
    export default {
        props: ['project'],
        data() {
            return {
                statuses: {
                    "In Progress": 'success',
                    "New": 'warning',
                    "Blocked": 'danger',
                    "On Hold": 'info',
                    "Completed": 'success',
                    "Abandoned": 'active',
                }
            }
        },
        watch: {
            'project.start_date': function () {
                this.updateProject();
            },
            'project.end_date': function () {
                this.updateProject();
            }
        },
        methods: {
            updateProject() {
                window.axios.put('/projects/' + this.project.id, this.project).then(() => {
                    this.$emit('update');
                });
            }
        }
    }
</script>