<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BasketRepository::class)
 */
class Basket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $createDate;


    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="basket", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="array")
     */
    private $productsArr = [];

   

    

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->productsCollection = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateDate(): ?Int
    {
        return $this->createDate;
    }

    public function setCreateDate(Int $createDate): self
    {
        $this->createDate = $createDate;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setBasket(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getBasket() !== $this) {
            $user->setBasket($this);
        }

        $this->user = $user;

        return $this;
    }

    private function getProductsArr(): ?array
    {
        return $this->productsArr;
    }

    private function setProductsArr(array $productsArr): self
    {
        $this->productsArr = $productsArr;

        return $this;
    }

    

    public function addProduct(Product $product): self {
        #check if product is in array
        if ($key = array_search($product, $this->getProductsArr()[0])){
            #if it's in there, increment
            array_push($this->getProductsArr(), [$product => $this->getProductsArr()[1] + 1]);
        } else {
            #if not added
            array_push($this->getProductsArr(), [$product => 1]);
        }  
        return $this;
    }
    
   
}

