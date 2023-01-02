<?php

namespace App\Entity;

use App\Repository\AnswersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswersRepository::class)
 */
class Answers
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
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $question_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $option_id;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="user")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=QuizQuestionsOptions::class, mappedBy="options_To_answer")
     */
    private $quizQuestionsOptions;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->quizQuestionsOptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

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

    public function getOptionId(): ?int
    {
        return $this->option_id;
    }

    public function setOptionId(int $option_id): self
    {
        $this->option_id = $option_id;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addUser($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, QuizQuestionsOptions>
     */
    public function getQuizQuestionsOptions(): Collection
    {
        return $this->quizQuestionsOptions;
    }

    public function addQuizQuestionsOption(QuizQuestionsOptions $quizQuestionsOption): self
    {
        if (!$this->quizQuestionsOptions->contains($quizQuestionsOption)) {
            $this->quizQuestionsOptions[] = $quizQuestionsOption;
            $quizQuestionsOption->addOptionsToAnswer($this);
        }

        return $this;
    }

    public function removeQuizQuestionsOption(QuizQuestionsOptions $quizQuestionsOption): self
    {
        if ($this->quizQuestionsOptions->removeElement($quizQuestionsOption)) {
            $quizQuestionsOption->removeOptionsToAnswer($this);
        }

        return $this;
    }
}
