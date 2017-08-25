<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i @click="cancel" class="pull-right glyphicon glyphicon-remove"></i>
            <h3 class="panel-title">New Project</h3>
        </div>
        <div class="panel-body">
            <div class="form-inline form-group">
                <div class="form-group">
                    <label for="name">Name:</label><br/>
                    <input id="name" class="form-control" v-model="form.name">
                </div>
                <div class="form-group">
                    <label for="status">Status:</label><br/>
                    <project-status-dropdown id="status" class="form-control" v-model="form.status"></project-status-dropdown>
                </div>

                <div class="form-group" style="position:relative">
                    <label for="start_date">Start Date:</label><br/>
                    <date-picker v-model="form.start_date" :config="{format: 'MM/DD/YYYY', showClear: true}"></date-picker>
                </div>
                <div class="form-group" style="position:relative">
                    <label for="end_date">End Date:</label><br/>
                    <date-picker v-model="form.end_date" :config="{format: 'MM/DD/YYYY', showClear: true}"></date-picker>
                </div>
            </div>
            <div class="form-group">
                <button @click="save" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    function getBlankForm() {
        return {
            name: '',
            status: 'New',
            start_date: null,
            end_date: null,
        }
    }

    export default {
        data() {
            return {
                form: getBlankForm()
            }
        },
        computed: {
            maxDate: function(){
                return this.form.end_date == null ? false : this.form.end_date;
            },
            minDate: function(){
                return this.form.start_date == null ? false : this.form.start_date;
            },
        },
        methods: {
            resetForm() {
                this.form = getBlankForm();
            },
            cancel() {
                this.$emit('cancel-new-project');
            },
            save() {
                window.axios.post('/projects', this.form).then(() => {
                    this.resetForm();
                    this.$emit('new-project');
                })
            }
        }
    }
</script>