<?php
/**
 * Created by PhpStorm.
 * User: erikbelusic
 * Date: 8/24/17
 * Time: 10:03 PM
 */

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
            'history' => $project->revisionHistory,
        ];
    }
}