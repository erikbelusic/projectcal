<?php

namespace App\Transformers;


use Carbon\Carbon;

class RevisionHistoryTransformer
{
    public function transform($revisionHistory)
    {
        return [
            'field_name' => $revisionHistory->fieldName(),
            'old_value' => $this->formatForKey($revisionHistory->key, $revisionHistory->oldValue()),
            'new_value' => $this->formatForKey($revisionHistory->key, $revisionHistory->newValue()),
            'created_at' => $revisionHistory->created_at->timezone('America/New_York')->toDayDateTimeString(),
        ];
    }

    private function formatForKey($key, $value)
    {
        if(is_null($value)) {
            return 'nothing';
        }
        switch($key) {
            case 'start_date':
            case 'end_date':
                return Carbon::parse($value)->format('m/d/y');
            default:
                return $value;
                break;
        }
    }
}