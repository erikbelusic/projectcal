<?php

namespace App\Services;


use App\Project;
use App\User;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;

class GoogleCalendarService
{
    /**
     * @var Google_Client
     */
    private $client;

    /**
     * @var Google_Service_Calendar
     */
    private $service;

    /**
     * @var User
     */
    private $user;

    /**
     * GoogleCalendarService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        $this->client = new Google_Client(
            [
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
            ]
        );

        $this->client->fetchAccessTokenWithRefreshToken($user->refresh_token);
        $this->service = new Google_Service_Calendar($this->client);
    }

    public function calendars()
    {
        return $this->service->calendarList->listCalendarList()->getItems();
    }

    public function newEvent(Google_Service_Calendar_Event $event) {
        return $this->service->events->insert($this->user->calendar_id, $event);
    }

    public function updateEvent(String $eventId, Array $data)
    {
        $event = $this->service->events->get($this->user->calendar_id, $eventId);

        $event->setSummary($data['summary']);
        $event->setStart(new Google_Service_Calendar_EventDateTime($data['start']));
        $event->setEnd(new Google_Service_Calendar_EventDateTime($data['end']));
        $event->setColorId($data['colorId']);

        return $this->service->events->update($this->user->calendar_id, $event->getId(), $event);
    }

    public function deleteEvent(String $eventId)
    {
        $this->service->events->delete($this->user->calendar_id, $eventId);
    }
}