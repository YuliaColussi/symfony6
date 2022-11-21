<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController
{
    #[Route('/')]
    public function homepage()
    {
        die('Vinyl: Definitely NOT a fancy-looking frisbee!');
    }

    #[Route('/browse/{slug}')]
    public function browse(string $slug = null)
    {
        if($slug)  {
            $title = 'Genre: ' . u(str_replace('-', ' ', $slug))->title(true);
        } else  {
            $title = 'All genres';
        }

        return new Response($title);
    }
}