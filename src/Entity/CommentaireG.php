<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Timestampable;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class CommentaireG
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post:read")
     */
    private $contenuCom;

    /**
     * @ORM\ManyToOne(targetEntity=Publication::class, inversedBy="commentaires")
     * @ORM\JoinColumn(name="pub_id", referencedColumnName="id")
     */
    private $Pub;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("post:read")
     */
    private $created;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuCom(): ?string
    {
        return $this->contenuCom;
    }

    public function setContenuCom(string $contenuCom): self
    {
        $this->contenuCom = $contenuCom;

        return $this;
    }

    public function getPub()
    {
        return $this->Pub;
    }

    public function setPub( $idPub)
    {
        $this->Pub = $idPub;

        return $this;
    }

    public function __toString()
    {
        return (string)$this-> getPub();
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

}
