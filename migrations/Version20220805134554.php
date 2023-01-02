<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220805134554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions CHANGE correction correction_id INT NOT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D594AE086B FOREIGN KEY (correction_id) REFERENCES quiz_questions_options (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8ADC54D594AE086B ON questions (correction_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D594AE086B');
        $this->addSql('DROP INDEX UNIQ_8ADC54D594AE086B ON questions');
        $this->addSql('ALTER TABLE questions CHANGE correction_id correction INT NOT NULL');
    }
}
