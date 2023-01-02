<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizRepository::class)
 */
class Quiz
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
    private $quizTheme;

    /**
     * @ORM\Column(type="integer")
     */
    private $color_id;

    /**
     * @ORM\ManyToOne(targetEntity=Color::class, inversedBy="quiz")
     * @ORM\JoinColumn(nullable=false)
     */
    private $color_theme;

    /**
     * @ORM\OneToMany(targetEntity=Questions::class, fetch="EAGER",mappedBy="quiz")
     */
    private $questions;

  

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuizTheme(): ?string
    {
        return $this->quizTheme;
    }

    public function setQuizTheme(string $quizTheme): self
    {
        $this->quizTheme = $quizTheme;

        return $this;
    }

    public function getColorId(): ?int
    {
        return $this->color_id;
    }

    public function setColorId(int $color_id): self
    {
        $this->color_id = $color_id;

        return $this;
    }

    public function getColorTheme(): ?Color
    {
        return $this->color_theme;
    }

    public function setColorTheme(?Color $color_theme): self
    {
        $this->color_theme = $color_theme;

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Questions $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }

   
   
}
