<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220824124037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quiz_questions_options_questions (quiz_questions_options_id INT NOT NULL, questions_id INT NOT NULL, INDEX IDX_28D183B4EBA8B31C (quiz_questions_options_id), INDEX IDX_28D183B4BCB134CE (questions_id), PRIMARY KEY(quiz_questions_options_id, questions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_questions_options_answers (quiz_questions_options_id INT NOT NULL, answers_id INT NOT NULL, INDEX IDX_46E31717EBA8B31C (quiz_questions_options_id), INDEX IDX_46E3171779BF1BCE (answers_id), PRIMARY KEY(quiz_questions_options_id, answers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quiz_questions_options_questions ADD CONSTRAINT FK_28D183B4EBA8B31C FOREIGN KEY (quiz_questions_options_id) REFERENCES quiz_questions_options (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_questions_options_questions ADD CONSTRAINT FK_28D183B4BCB134CE FOREIGN KEY (questions_id) REFERENCES questions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_questions_options_answers ADD CONSTRAINT FK_46E31717EBA8B31C FOREIGN KEY (quiz_questions_options_id) REFERENCES quiz_questions_options (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_questions_options_answers ADD CONSTRAINT FK_46E3171779BF1BCE FOREIGN KEY (answers_id) REFERENCES answers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5AE1159F4');
        $this->addSql('DROP INDEX IDX_8ADC54D5AE1159F4 ON questions');
        $this->addSql('ALTER TABLE questions DROP question_option_id');
        $this->addSql('ALTER TABLE quiz_questions_options DROP FOREIGN KEY FK_2BA4D7C2B444B0F2');
        $this->addSql('DROP INDEX IDX_2BA4D7C2B444B0F2 ON quiz_questions_options');
        $this->addSql('ALTER TABLE quiz_questions_options ADD question_id INT DEFAULT NULL, CHANGE options_to_answer_id quiz_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE quiz_questions_options_questions');
        $this->addSql('DROP TABLE quiz_questions_options_answers');
        $this->addSql('ALTER TABLE questions ADD question_option_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5AE1159F4 FOREIGN KEY (question_option_id) REFERENCES quiz_questions_options (id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D5AE1159F4 ON questions (question_option_id)');
        $this->addSql('ALTER TABLE quiz_questions_options ADD options_to_answer_id INT DEFAULT NULL, DROP quiz_id, DROP question_id');
        $this->addSql('ALTER TABLE quiz_questions_options ADD CONSTRAINT FK_2BA4D7C2B444B0F2 FOREIGN KEY (options_to_answer_id) REFERENCES answers (id)');
        $this->addSql('CREATE INDEX IDX_2BA4D7C2B444B0F2 ON quiz_questions_options (options_to_answer_id)');
    }
}
