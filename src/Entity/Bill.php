<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

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
     * @ORM\Column(type="integer")
     */
    private $ExpeditionDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpeditionDate(): ?int
    {
        return $this->ExpeditionDate;
    }

    public function setExpeditionDate(int $ExpeditionDate): self
    {
        $this->ExpeditionDate = $ExpeditionDate;

        return $this;
    }
}
