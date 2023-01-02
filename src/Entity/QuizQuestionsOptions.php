<?php

namespace App\Entity;

use App\Repository\QuizQuestionsOptionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizQuestionsOptionsRepository::class)
 */
class QuizQuestionsOptions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quiz_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $question_id;

    /**
     * @ORM\Column(type="text")
     */
    private $optionText;

    /**
     * @ORM\ManyToMany(targetEntity=Questions::class, inversedBy="questionOption")
     */
    private $question;

    /**
     * @ORM\ManyToMany(targetEntity=Answers::class, inversedBy="quizQuestionsOptions")
     */
    private $options_To_answer;


    /**
     * @ORM\OneToOne(targetEntity=Questions::class, mappedBy="correction")
     */
    private $correctionQuestion;

    public function __construct()
    {
        $this->question = new ArrayCollection();
        $this->options_To_answer = new ArrayCollection();
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

    public function getQuestionId(): ?int
    {
        return $this->question_id;
    }

    public function setQuestionId(int $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function getOptionText(): ?string
    {
        return $this->optionText;
    }

    public function setOptionText(string $optionText): self
    {
        $this->optionText = $optionText;

        return $this;
    }

    /**
     * @return Collection<int, questions>
     */
    public function getQuestion(): Collection
    {
        return $this->question;
    }

    public function addQuestion(Questions $question): self
    {
        if (!$this->question->contains($question)) {
            $this->question[] = $question;
        }

        return $this;
    }

    public function removeQuestion(Questions $question): self
    {
        $this->question->removeElement($question);

        return $this;
    }

    /**
     * @return Collection<int, answers>
     */
    public function getOptionsToAnswer(): Collection
    {
        return $this->options_To_answer;
    }

    public function addOptionsToAnswer(answers $optionsToAnswer): self
    {
        if (!$this->options_To_answer->contains($optionsToAnswer)) {
            $this->options_To_answer[] = $optionsToAnswer;
        }

        return $this;
    }

    public function removeOptionsToAnswer(answers $optionsToAnswer): self
    {
        $this->options_To_answer->removeElement($optionsToAnswer);

        return $this;
    }

    public function getCorrectionQuestion(): ?Questions
    {
        return $this->correctionQuestion;
    }

    public function setCorrectionQuestion(Questions $correction): self
    {
        $this->correctionQuestion = $correctionQuestion;

        return $this;
    }
  
}
