<?php

namespace App\Entity;

use App\Repository\QuestionssRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=QuestionssRepository::class)
 */
class Questionss
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Question1;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Question2;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Question3;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Question4;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Question5;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Question6;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Question7;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion1(): ?string
    {
        return $this->Question1;
    }

    public function setQuestion1(string $Question1): self
    {
        $this->Question1 = $Question1;

        return $this;
    }

    public function getQuestion2(): ?string
    {
        return $this->Question2;
    }

    public function setQuestion2(string $Question2): self
    {
        $this->Question2 = $Question2;

        return $this;
    }

    public function getQuestion3(): ?string
    {
        return $this->Question3;
    }

    public function setQuestion3(string $Question3): self
    {
        $this->Question3 = $Question3;

        return $this;
    }

    public function getQuestion4(): ?string
    {
        return $this->Question4;
    }

    public function setQuestion4(string $Question4): self
    {
        $this->Question4 = $Question4;

        return $this;
    }

    public function getQuestion5(): ?string
    {
        return $this->Question5;
    }

    public function setQuestion5(string $Question5): self
    {
        $this->Question5 = $Question5;

        return $this;
    }

    public function getQuestion6(): ?string
    {
        return $this->Question6;
    }

    public function setQuestion6(string $Question6): self
    {
        $this->Question6 = $Question6;

        return $this;
    }

    public function getQuestion7(): ?string
    {
        return $this->Question7;
    }

    public function setQuestion7(string $Question7): self
    {
        $this->Question7 = $Question7;

        return $this;
    }
}
