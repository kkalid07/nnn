<?php

namespace App\Entity;

use App\Repository\LikesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LikesRepository::class)
 */
class Likes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Publication::class, inversedBy="likes")
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
