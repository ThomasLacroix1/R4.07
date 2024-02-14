<?php


/* indique où "vit" ce fichier */

namespace App\Controller;


/* indique l'utilisation du bon bundle pour gérer nos routes */

use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Lego;
use App\Service\CreditsGenerator;
use App\Service\DatabaseInterface;

/* le nom de la classe doit être cohérent avec le nom du fichier */

class LegoController extends AbstractController
{
   // L’attribute #[Route] indique ici que l'on associe la route
   // "/" à la méthode home pour que Symfony l'exécute chaque fois
   // que l'on accède à la racine de notre site.
   #[Route('/',)]
   public function home(DatabaseInterface $database)
   {
      return $this->render("lego.html.twig", ["legos" => $database->getAllLegos()]);
   }

   #[Route('/{collection}', 'filter_by_collection', requirements:(['collection' => '(creator|star_wars|creator_expert|harry_potter)']))]
   public function filter($collection, DatabaseInterface $database): Response
   {
      // $tab = array();
      // foreach ($this->legos as $lego){
      //    if ($collection ==  str_replace(' ', '_', strtolower($lego->getCollection()))){
      //       array_push($tab, $lego);
      //    }
      // }
      return $this->render("lego.html.twig", ["legos" => $database->getLegosByCollection($collection)]);
   }

   #[Route('/credits', 'credits')]
   public function credits(CreditsGenerator $credits): Response
   {
       return new Response($credits->getCredits());
   }

}
