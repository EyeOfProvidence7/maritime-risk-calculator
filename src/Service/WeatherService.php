<?php

// src/Service/WeatherService.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherService
{
    public function __construct(private HttpClientInterface $client) {}

    public function getWindData(string $start, string $end): array
    {
        // Dummy response for now (simulate API)
        return [
            ['location' => $start, 'wind' => 3],
            ['location' => 'Midpoint', 'wind' => 7],
            ['location' => $end, 'wind' => 6],
        ];
    }

    public function getRiskLevel(int $wind): string
    {
        return match (true) {
            $wind < 4 => 'Safe',
            $wind < 7 => 'Caution',
            default => 'Danger',
        };
    }
}
