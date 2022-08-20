<?php

namespace App\Entity;

use App\Repository\DislikesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DislikesRepository::class)
 */
class Dislikes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Publication::class, inversedBy="dislikes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pub;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPub(): ?Publication
    {
        return $this->pub;
    }

    public function setPub(?Publication $pub): self
    {
        $this->pub = $pub;

        return $this;
    }
}
