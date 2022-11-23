<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SongController extends AbstractController {

    #[Route('api/songs/{id<\d+>}', methods:['GET'])]
    public function getSong(int $id, LoggerInterface $logger): Response 
    {
        $song = [
            'id' => $id,
            'name' => 'Waterfall',
            'url' => 'https://www.service-public.fr'
        ];

        $logger->info('Return API response for {song}', [
            'song' => $id
        ]);

        return new JsonResponse($song);
    }
}