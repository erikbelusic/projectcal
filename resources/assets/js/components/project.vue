<template>

    <tr :class="statuses[project.status]">
        <th><input @blur="updateProject" class="form-control" v-model="project.name"></th>
        <td>
            <project-status-dropdown @change="updateProject" v-model="project.status"></project-status-dropdown>
        </td>
        <td>
            <div class="input-group">
                <date-picker v-model="project.start_date" :config="{format: 'MM/DD/YYYY'}"></date-picker>
                <div class="input-group-btn">
                    <button @click.prevent="project.start_date = null" class="btn btn-default"><i class="glyphicon glyphicon-remove"></i></button>
                </div>
            </div>
        </td>
        <td>
            <div class="input-group">
                <date-picker v-model="project.end_date" :config="{format: 'MM/DD/YYYY'}"></date-picker>
                <div class="input-group-btn">
                    <button @click.prevent="project.end_date = null" class="btn btn-default"><i class="glyphicon glyphicon-remove"></i></button>
                </div>
            </div>
        </td>
        <th><input @blur="updateProject" class="form-control" v-model="project.responsible_party"></th>
        <th><input @blur="updateProject" class="form-control" v-model="project.next_action"></th>
        <td>
            <a v-show="project.history.length" class="btn btn-default" @click.prevent="showHistory = !showHistory">{{ (showHistory) ? "Hide History" : "Show History" }}</a>
            <div v-if="showHistory" :style="{height: historyHeight}">
                <div class="history-row">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="item in project.history">{{ item.key }} was changed from {{ item.old_value }} to {{ item.new_value }}</li>
                    </ul>
                </div>
            </div>
        </td>
    </tr>

</template>

<script>
    export default {
        props: ['project'],
        data() {
            return {
                showHistory: false,
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
        computed: {
            historyHeight: function() {
                return (this.project.history.length * 41 + 11) + 'px';
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