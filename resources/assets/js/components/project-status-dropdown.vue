<template>
    <select ref="statusPicker" class="form-control" :class="inputClass" :id="id" :value="value" @change="updateValue">
        <option value="New">New</option>
        <option value="In Progress">In Progress</option>
        <option value="On Hold">On Hold</option>
        <option value="Blocked">Blocked</option>
        <option value="Abandoned">Abandoned</option>
        <option value="Completed">Completed</option>
    </select>
</template>

<script>
    export default {
        props: ['value', 'inputClass', 'id'],
        methods: {
            updateValue() {
                this.$emit('input', this.$refs.statusPicker.value);
                this.$emit('change');
            }
        }
    }
</script>