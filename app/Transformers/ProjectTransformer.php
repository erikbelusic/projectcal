<?php

namespace App\Transformers;


class ProjectTransformer
{
    public function transform($project)
    {
        return [
            'id' => $project->id,
            'name' => $project->name,
            'status' => $project->status,
            'start_date' => $project->start_date ? $project->start_date->format('m/d/Y') : null,
            'end_date' => $project->end_date ? $project->end_date->format('m/d/Y') : null,
            'next_action' => $project->next_action,
            'responsible_party' => $project->responsible_party,
            'history' => $project->revisionHistory->map(function($item) {return (new RevisionHistoryTransformer)->transform($item);})->toArray()
        ];
    }
}