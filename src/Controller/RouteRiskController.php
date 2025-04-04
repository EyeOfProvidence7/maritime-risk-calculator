<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class RouteRiskController extends AbstractController
{
    #[Route('/api/risk', name: 'api_risk', methods: ['POST'])]
    public function risk(Request $request, WeatherService $weatherService): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $start = $data['start'];
        $end = $data['end'];

        $segments = $weatherService->getWindData($start, $end);
        foreach ($segments as &$segment) {
            $segment['risk'] = $weatherService->getRiskLevel($segment['wind']);
        }

        return $this->json($segments);
    }
}
