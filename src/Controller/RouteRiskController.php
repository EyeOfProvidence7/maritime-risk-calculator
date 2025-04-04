<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\WeatherService;


final class RouteRiskController extends AbstractController
{
    #[Route('/api/risk', name: 'api_risk', methods: ['POST'])]
    public function risk(Request $request, WeatherService $weatherService): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['start'], $data['end'])) {
            return $this->json(['error' => 'Missing start or end'], 400);
        }
        $start = $data['start'];
        $end = $data['end'];

        $segments = $weatherService->getWindData($start, $end);
        foreach ($segments as &$segment) {
            $segment['risk'] = $weatherService->getRiskLevel($segment['wind']);
        }

        return $this->json($segments);
    }
}
