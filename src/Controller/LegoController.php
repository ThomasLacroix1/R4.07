<?php


/* indique où "vit" ce fichier */

namespace App\Controller;


/* indique l'utilisation du bon bundle pour gérer nos routes */

use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Lego;
use App\Entity\LegoCollection;
use App\Service\CreditsGenerator;
use App\Repository\LegoRepository;
use App\Repository\LegoCollectionRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/* le nom de la classe doit être cohérent avec le nom du fichier */

class LegoController extends AbstractController
{
   // L’attribute #[Route] indique ici que l'on associe la route
   // "/" à la méthode home pour que Symfony l'exécute chaque fois
   // que l'on accède à la racine de notre site.
   #[Route('/',)]
   public function home(LegoRepository $database)
   {
      return $this->render("lego.html.twig", ["legos" => $database->findAll()]);
   }

   #[Route('/{name}', 'filter_by_collection', requirements:(['collection' => '(Creator|Star Wars|Creator Expert|Harry Potter)']))]
   public function filter(LegoCollection $legoCollection): Response
   {
      return $this->render("lego.html.twig", ["legos" => $legoCollection->getLegos()]);
   }

   #[Route('/credits', 'credits')]
   public function credits(CreditsGenerator $credits): Response
   {
       return new Response($credits->getCredits());
   }
}