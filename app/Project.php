<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Project extends Model
{
    use RevisionableTrait;

    protected $fillable = ['name', 'status', 'start_date', 'end_date', 'next_action', 'responsible_party'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['New','In Progress', 'On Hold', 'Blocked']);
    }

    public function scopeArchived($query)
    {
        return $query->whereIn('status', ['Completed', 'Abandoned']);
    }
}