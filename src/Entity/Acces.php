<?php

namespace App\Entity;

use App\Repository\AccesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccesRepository::class)
 */
class Acces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=utilisateurs::class, inversedBy="acces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateurs;

    /**
     * @ORM\ManyToOne(targetEntity=authorisation::class, inversedBy="acces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $authorisation;

    /**
     * @ORM\ManyToOne(targetEntity=documents::class, inversedBy="acces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $documents;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateurs(): ?utilisateurs
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(?utilisateurs $utilisateurs): self
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }

    public function getAuthorisation(): ?authorisation
    {
        return $this->authorisation;
    }

    public function setAuthorisation(?authorisation $authorisation): self
    {
        $this->authorisation = $authorisation;

        return $this;
    }

    public function getDocuments(): ?documents
    {
        return $this->documents;
    }

    public function setDocuments(?documents $documents): self
    {
        $this->documents = $documents;

        return $this;
    }
}
