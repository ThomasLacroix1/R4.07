<?php


// Là ou la classe est déclarée (où son fichier se trouve)
namespace App\Service;

use \PDO;
use App\Entity\Lego;

class DatabaseInterface
{
    public function getAllLegos()
    {
        $pdo = new \PDO("mysql:host=tp-symfony-mysql;dbname=lego_store", 'root', 'root');
        $statement = $pdo->query('SELECT * FROM lego');
        $data = $statement->fetchAll();
        $legosData = json_decode(json_encode($data));
        $legos = array();

        foreach ($legosData as $el) {
            $lego = new Lego($el->id, $el->name, $el->collection);
            $lego->setDescription($el->description);
            $lego->setPrice($el->price);
            $lego->setPieces($el->pieces);
            $lego->setBoxImage($el->imagebox);
            $lego->setLegoImage($el->imagebg);
            array_push($legos, $lego);
        }

        return $legos;
    }

    public function getLegosByCollection($collection){
        $pdo = new \PDO("mysql:host=tp-symfony-mysql;dbname=lego_store", 'root', 'root');
        $statement = $pdo->query('SELECT * FROM lego');
        $data = $statement->fetchAll();
        $legosData = json_decode(json_encode($data));
        $legos = array();

        foreach ($legosData as $el) {
            if(str_replace(' ', '_', strtolower($el->collection)) == $collection){
                $lego = new Lego($el->id, $el->name, $el->collection);
                $lego->setDescription($el->description);
                $lego->setPrice($el->price);
                $lego->setPieces($el->pieces);
                $lego->setBoxImage($el->imagebox);
                $lego->setLegoImage($el->imagebg);
                array_push($legos, $lego);
            }
        }
        return $legos;
    }
}