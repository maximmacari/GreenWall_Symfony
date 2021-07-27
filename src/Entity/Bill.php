<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BillRepository::class)
 */
class Bill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ExpeditionDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpeditionDate(): ?\DateTimeInterface
    {
        return $this->ExpeditionDate;
    }

    public function setExpeditionDate(\DateTimeInterface $ExpeditionDate): self
    {
        $this->ExpeditionDate = $ExpeditionDate;

        return $this;
    }
}
