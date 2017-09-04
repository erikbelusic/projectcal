<?php

namespace App\Jobs;

use App\Project;
use App\Services\GoogleCalendarService;
use Google_Service_Calendar_Event;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateProjectOnGoogle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Project
     */
    private $project;

    /**
     * Create a new job instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->project->existsOnGoogle()) {
            if (is_null($this->project->start_date) && is_null($this->project->end_date)) {
                $calService = new GoogleCalendarService($this->project->user);

                $calService->deleteEvent($this->project->calendar_event_id);

                $this->project->update(['calendar_event_id' => null]);
            } else {
                $calService = new GoogleCalendarService($this->project->user);

                $calService->updateEvent($this->project->calendar_event_id, $this->getEventDataArrayFromProject($this->project));
            }
        } else {
            if (!is_null($this->project->start_date) || !is_null($this->project->end_date)) {
                $gEvent = $this->makeGoogleEventForProject($this->project);

                $calService = new GoogleCalendarService($this->project->user);

                $createdEvent = $calService->newEvent($gEvent);

                $this->project->update(['calendar_event_id' => $createdEvent->getId()]);
            }
        }
    }

    protected function makeGoogleEventForProject($project)
    {
        return new Google_Service_Calendar_Event($this->getEventDataArrayFromProject($project));
    }

    private function getEventDataArrayFromProject($project)
    {
        $start = !is_null($project->start_date) ? $project->start_date : $project->end_date;
        $end = !is_null($project->end_date) ? $project->end_date : $project->start_date;

        return [
                'summary' => '[Project] - ' . $project->name,
                'start' => array(
                    'date' => $start->toDateString(),
//                    'timeZone' => 'America/New_York',
                ),
                'end' => array(
                    'date' => $end->toDateString(),
//                    'timeZone' => 'America/New_York',
                ),
                'colorId' => '6'
        ];
    }
}
