<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220801082041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, question_id INT NOT NULL, option_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, color_text VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, quiz_id INT NOT NULL, color_text VARCHAR(255) NOT NULL, question_texte LONGTEXT NOT NULL, correction INT NOT NULL, INDEX IDX_8ADC54D5853CD175 (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, color_theme_id INT NOT NULL, quiz_theme VARCHAR(255) NOT NULL, color_id INT NOT NULL, INDEX IDX_A412FA928587EFC5 (color_theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_questions_options (id INT AUTO_INCREMENT NOT NULL, quiz_id INT NOT NULL, question_id INT NOT NULL, option_text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_questions_options_questions (quiz_questions_options_id INT NOT NULL, questions_id INT NOT NULL, INDEX IDX_28D183B4EBA8B31C (quiz_questions_options_id), INDEX IDX_28D183B4BCB134CE (questions_id), PRIMARY KEY(quiz_questions_options_id, questions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_questions_options_answers (quiz_questions_options_id INT NOT NULL, answers_id INT NOT NULL, INDEX IDX_46E31717EBA8B31C (quiz_questions_options_id), INDEX IDX_46E3171779BF1BCE (answers_id), PRIMARY KEY(quiz_questions_options_id, answers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, user_first_name VARCHAR(15) NOT NULL, user_last_name VARCHAR(15) NOT NULL, birthday DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', gender VARCHAR(15) NOT NULL, account_created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_answers (user_id INT NOT NULL, answers_id INT NOT NULL, INDEX IDX_8DDD80CA76ED395 (user_id), INDEX IDX_8DDD80C79BF1BCE (answers_id), PRIMARY KEY(user_id, answers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA928587EFC5 FOREIGN KEY (color_theme_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE quiz_questions_options_questions ADD CONSTRAINT FK_28D183B4EBA8B31C FOREIGN KEY (quiz_questions_options_id) REFERENCES quiz_questions_options (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_questions_options_questions ADD CONSTRAINT FK_28D183B4BCB134CE FOREIGN KEY (questions_id) REFERENCES questions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_questions_options_answers ADD CONSTRAINT FK_46E31717EBA8B31C FOREIGN KEY (quiz_questions_options_id) REFERENCES quiz_questions_options (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_questions_options_answers ADD CONSTRAINT FK_46E3171779BF1BCE FOREIGN KEY (answers_id) REFERENCES answers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_answers ADD CONSTRAINT FK_8DDD80CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_answers ADD CONSTRAINT FK_8DDD80C79BF1BCE FOREIGN KEY (answers_id) REFERENCES answers (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz_questions_options_answers DROP FOREIGN KEY FK_46E3171779BF1BCE');
        $this->addSql('ALTER TABLE user_answers DROP FOREIGN KEY FK_8DDD80C79BF1BCE');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA928587EFC5');
        $this->addSql('ALTER TABLE quiz_questions_options_questions DROP FOREIGN KEY FK_28D183B4BCB134CE');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5853CD175');
        $this->addSql('ALTER TABLE quiz_questions_options_questions DROP FOREIGN KEY FK_28D183B4EBA8B31C');
        $this->addSql('ALTER TABLE quiz_questions_options_answers DROP FOREIGN KEY FK_46E31717EBA8B31C');
        $this->addSql('ALTER TABLE user_answers DROP FOREIGN KEY FK_8DDD80CA76ED395');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE quiz_questions_options');
        $this->addSql('DROP TABLE quiz_questions_options_questions');
        $this->addSql('DROP TABLE quiz_questions_options_answers');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_answers');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
