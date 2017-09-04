@extends('layouts.app')
@section('content')
    <div id="app">
        <a href="#" class="pull-right btn btn-primary" @click.prevent="showForm=true" :disabled="!!showForm">New Project</a>
        <div class="pull-right btn-group" style="margin-right:15px;">
            <button @click.prevent="getActiveProjects" class="btn btn-default" :class="{active: projectType == 'active'}"><i class="glyphicon glyphicon-check"></i> Active</button>
            <button @click.prevent="getArchivedProjects" class="btn btn-default" :class="{active: projectType == 'archived'}"><i class="glyphicon glyphicon-folder-close"></i> Archived</button>
        </div>
        <div class="pull-right btn-group" style="margin-right:15px;">
            <button @click.prevent="projectOrder = 'status'" class="btn btn-default" :class="{active: projectOrder == 'status'}"><i class="glyphicon glyphicon-tasks"></i> Status</button>
            <button @click.prevent="projectOrder = 'name'" class="btn btn-default" :class="{active: projectOrder == 'name'}"><i class="glyphicon glyphicon-sort-by-alphabet"></i> Name</button>
            <button @click.prevent="projectOrder = 'date'" class="btn btn-default" :class="{active: projectOrder == 'date'}"><i class="glyphicon glyphicon-calendar"></i> End Date</button>
        </div>
        <h1>Dash</h1>
        <new-project-form v-show="showForm" v-on:new-project="handleNewProject" v-on:cancel-new-project="cancelNewProject"></new-project-form>
        <project-list :projects="projects" :order="projectOrder"></project-list>
    </div>
@endsection