<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
    #[Route('/')]
    public function homepage()
    {

        $tracks = [
            ['song' => 'hello1', 'artist' => 'op2' ],
            ['song' => 'hello1', 'artist' => 'op2' ],
            ['song' => 'hello1', 'artist' => 'op2' ]
        ];
        
       return $this->render('vinyl/homepage.html.twig', [
        'title' => 'Adam Sandler',
        'tracks' => $tracks
       ]);
    }

    #[Route('/browse/{slug}')]
    public function browse(string $slug = null)
    {
       $genre =  $slug ? u(str_replace('-', ' ', $slug))->title(true) : 'All genres';

        return $this->render('vinyl/browse.html.twig', [
            'title' => 'Adam Sandler',
            'genre' => $genre
           ]);
    }
}