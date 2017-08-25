@extends('layouts.app')
@section('content')
    <div id="app">
        <a href="#" class="pull-right btn btn-primary" @click.prevent="showForm=true" :disabled="!!showForm">New Project</a>
        <div class="pull-right btn-group" style="margin-right:15px;">
            <a @click.prevent="getActiveProjects" class="btn btn-default" :class="{active: projectType == 'active'}">Active</a>
            <a @click.prevent="getArchivedProjects" class="btn btn-default" :class="{active: projectType == 'archived'}">Archived</a>
        </div>
        <h1>Dash</h1>
        <new-project-form v-show="showForm" v-on:new-project="handleNewProject" v-on:cancel-new-project="cancelNewProject"></new-project-form>
        <project-list :projects="projects" v-on:update="getProjects"></project-list>
    </div>
@endsection