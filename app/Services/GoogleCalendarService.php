<?php

namespace App\Services;


use App\User;
use Google_Client;
use Google_Service_Calendar;

class GoogleCalendarService
{
    /**
     * @var Google_Client
     */
    private $client;

    /**
     * @var Google_Service_Calendar
     */
    public $service;

    /**
     * GoogleCalendarService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
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
}