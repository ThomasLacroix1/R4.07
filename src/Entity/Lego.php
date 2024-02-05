<?php
namespace App\Entity;

class Lego {
    private $id;
    private $name;
    private $collection;
    private $description;
    private $price;
    private $pieces;
    private $boxImage;
    private $legoImage;

    public function __construct($id, $name, $collec){
        $this->id = $id;
        $this->name = $name;
        $this->collection = $collec;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of collection
     */
    public function getCollection()
    {
        return $this->collection;
    }



    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of pieces
     */
    public function getPieces()
    {
        return $this->pieces;
    }

    /**
     * Set the value of pieces
     */
    public function setPieces($pieces): self
    {
        $this->pieces = $pieces;

        return $this;
    }

    /**
     * Get the value of boxImage
     */
    public function getBoxImage()
    {
        return $this->boxImage;
    }

    /**
     * Set the value of boxImage
     */
    public function setBoxImage($boxImage): self
    {
        $this->boxImage = $boxImage;

        return $this;
    }

    /**
     * Get the value of legoImage
     */
    public function getLegoImage()
    {
        return $this->legoImage;
    }

    /**
     * Set the value of legoImage
     */
    public function setLegoImage($legoImage): self
    {
        $this->legoImage = $legoImage;

        return $this;
    }
}

?>