<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColorRepository::class)
 */
class Color
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $colorText;

    /**
     * @ORM\OneToMany(targetEntity=Quiz::class, mappedBy="color_theme")
     */
    private $quiz;

    public function __construct()
    {
        $this->quiz = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColorText(): ?string
    {
        return $this->colorText;
    }

    public function setColorText(string $colorText): self
    {
        $this->colorText = $colorText;

        return $this;
    }

    /**
     * @return Collection<int, quiz>
     */
    public function getQuiz(): Collection
    {
        return $this->quiz;
    }

    public function addQuiz(quiz $quiz): self
    {
        if (!$this->quiz->contains($quiz)) {
            $this->quiz[] = $quiz;
            $quiz->setColorTheme($this);
        }

        return $this;
    }

    public function removeQuiz(quiz $quiz): self
    {
        if ($this->quiz->removeElement($quiz)) {
            // set the owning side to null (unless already changed)
            if ($quiz->getColorTheme() === $this) {
                $quiz->setColorTheme(null);
            }
        }

        return $this;
    }
}
