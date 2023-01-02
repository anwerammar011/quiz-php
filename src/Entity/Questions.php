<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 */
class Questions
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
    private $quiz_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color_text;

    /**
     * @ORM\Column(type="text")
     */
    private $questionTexte;

    /**
     * @ORM\OneToOne(targetEntity=QuizQuestionsOptions::class, inversedBy="correctionQuestion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $correction;

    /**
     * @ORM\ManyToOne(targetEntity=Quiz::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quiz;

    /**
     * @ORM\ManyToMany(targetEntity=QuizQuestionsOptions::class, mappedBy="question")
     */
    private $questionOption;

    public function __construct()
    {
        $this->questionOption = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuizId(): ?int
    {
        return $this->quiz_id;
    }

    public function setQuizId(int $quiz_id): self
    {
        $this->quiz_id = $quiz_id;

        return $this;
    }

    public function getColorText(): ?string
    {
        return $this->color_text;
    }

    public function setColorText(string $color_text): self
    {
        $this->color_text = $color_text;

        return $this;
    }

    public function getQuestionTexte(): ?string
    {
        return $this->questionTexte;
    }

    public function setQuestionTexte(string $questionTexte): self
    {
        $this->questionTexte = $questionTexte;

        return $this;
    }

    public function getCorrection(): ?QuizQuestionsOptions
    {
        return $this->correction;
    }

    public function setCorrection(QuizQuestionsOptions $correction): self
    {
        $this->correction = $correction;

        return $this;
    }

    public function getQuiz(): ?quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?quiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * @return Collection<int, QuizQuestionsOptions>
     */
    public function getQuestionOption(): Collection
    {
        return $this->questionOption;
    }

    public function addQuestionOption(QuizQuestionsOptions $questionOption): self
    {
        if (!$this->questionOption->contains($questionOption)) {
            $this->questionOption[] = $questionOption;
            $questionOption->addQuestion($this);
        }

        return $this;
    }

    public function removeQuestionOption(QuizQuestionsOptions $questionOption): self
    {
        if ($this->questionOption->removeElement($questionOption)) {
            $questionOption->removeQuestion($this);
        }

        return $this;
    }
}
