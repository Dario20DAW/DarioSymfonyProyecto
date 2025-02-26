<?php

namespace App\Controller;
use App\Entity\Playlist;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistController extends AbstractController
{
    #[Route('/playlist', name: 'app_playlist')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PlaylistController.php',
        ]);
    }


    #[Route('/playlist/new', name: 'app_playlist_crear')]
    public function crearPlaylist(EntityManagerInterface $entityManager): JsonResponse
    {

        $usuarioRepository = $entityManager->getRepository(Usuario::class);
        $usuario = $usuarioRepository->findOneByNombre('Dario');


        $playlist = new Playlist();
        $playlist->setNombre('Playlist 1');
        $playlist->setVisibilidad('Publica');
        $playlist->setPropietario($usuario);
        $playlist->setReproducciones(23);
        $playlist->setLikes(1);
        $entityManager->persist($playlist);
        $entityManager->flush();

        return $this->json([
            'message' => 'playlist creada',
            'path' => 'src/Controller/PlaylistController.php',
        ]);
    }
}
