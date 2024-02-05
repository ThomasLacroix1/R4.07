<?php


/* indique où "vit" ce fichier */

namespace App\Controller;


/* indique l'utilisation du bon bundle pour gérer nos routes */

use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Lego;

/* le nom de la classe doit être cohérent avec le nom du fichier */

class LegoController extends AbstractController
{
   public $legos = array();
   // L’attribute #[Route] indique ici que l'on associe la route
   // "/" à la méthode home pour que Symfony l'exécute chaque fois
   // que l'on accède à la racine de notre site.
   public function __construct()
   {
      $json = file_get_contents(__DIR__ . "../../data.json");
      $data = json_decode($json);

      foreach ($data as $el) {
         $lego = new Lego($el->id, $el->name, $el->collection);
         $lego->setDescription($el->description);
         $lego->setPrice($el->price);
         $lego->setPieces($el->pieces);
         $lego->setBoxImage($el->images->box);
         $lego->setLegoImage($el->images->bg);
         array_push($this->legos, $lego);
      }
   }

   #[Route('/',)]
   public function home()
   {
      return $this->render("lego.html.twig", ["legos" => $this->legos]);
   }

   #[Route('/{collection}', 'filter_by_collection', requirements:(['page' => '(creator|starwars|expert)']))]
   public function filter($collection): Response
   {
      $tab = array();
      foreach ($this->legos as $lego){
         if ($collection ==  str_replace(' ', '_', strtolower($lego->getCollection()))){
            array_push($tab, $lego);
         }
      }
      return $this->render("lego.html.twig", ["legos" => $tab]);
      // die($collection);
   }
}
