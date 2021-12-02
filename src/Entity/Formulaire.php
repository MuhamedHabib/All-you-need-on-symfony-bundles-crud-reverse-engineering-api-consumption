<?php

namespace App\Entity;
use PHPUnit\Framework\Constraint\StringMatchesFormatDescription;
use Symfony\Component\Validator\Constraints as Assert;

use App\Repository\FormulaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=FormulaireRepository::class)
 */
class Formulaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255) 
     * @Assert\NotBlank
     */
    private $Nom;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $Prenom;

    /**
     *  @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first prenom must be at least {{ limit }} characters long",
     *      maxMessage = "Your first prenom cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Sexe", type="string", length=99, nullable=false)
     */
    public $Sexe;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Positive
     * @Assert\NotBlank
     */
    private $Age;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $DescriptionSymptomes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(string $Sexe): self
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->Age;
    }

    public function setAge(string $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getDescriptionSymptomes(): ?string
    {
        return $this->DescriptionSymptomes;
    }

    public function setDescriptionSymptomes(string $DescriptionSymptomes): self
    {
        $this->DescriptionSymptomes = $DescriptionSymptomes;

        return $this;
    }
}
