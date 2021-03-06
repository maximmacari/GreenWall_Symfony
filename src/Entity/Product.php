<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#https://symfony.com/doc/current/controller/upload_file.html
/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;


    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $taxRate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $percentReduction;

    /**
     * @ORM\Column(type="array")
     */
    private $images;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $Weight;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=Basket::class, inversedBy="products")
     */
    private $basket;

    

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getRetailPrice(): ?string {
        $retailPrice = $this->price * (1 - $this->percentReduction / 100);
        return number_format($retailPrice, 2, ',', ' ');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

   

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTaxRate(): ?int
    {
        return $this->taxRate;
    }

    public function setTaxRate(int $taxRate): self
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPercentReduction(): ?int
    {
        return $this->percentReduction;
    }

    public function setPercentReduction(?int $percentReduction): self
    {
        $this->percentReduction = $percentReduction;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function __toString(){
        return $this->name;
    }

    public function getWeight(): ?string
    {
        return $this->Weight;
    }

    public function setWeight(?string $Weight): self
    {
        $this->Weight = $Weight;

        return $this;
    }

    public function removeCategory(category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getProducts() === $this) {
                $category->setProducts(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function jsonSerialize()
    {
        return
            [
                $this->getName(),
                $this->getPrice(),
                $this->getTaxRate(),
                $this->getDescription(),
                $this->getStock(),
                $this->getPercentReduction(),
                $this->getImages()
            ];
    }

    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    public function setBasket(?Basket $basket): self
    {
        $this->basket = $basket;

        return $this;
    }
}