<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720141442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_CCF1F1BAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE writer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_97A0D882A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE editor ADD CONSTRAINT FK_CCF1F1BAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE writer ADD CONSTRAINT FK_97A0D882A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article ADD writer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E661BC7E6B6 FOREIGN KEY (writer_id) REFERENCES writer (id)');
        $this->addSql('CREATE INDEX IDX_23A0E661BC7E6B6 ON article (writer_id)');
        $this->addSql('ALTER TABLE page ADD writer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6201BC7E6B6 FOREIGN KEY (writer_id) REFERENCES writer (id)');
        $this->addSql('CREATE INDEX IDX_140AB6201BC7E6B6 ON page (writer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E661BC7E6B6');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6201BC7E6B6');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE writer');
        $this->addSql('DROP INDEX IDX_23A0E661BC7E6B6 ON article');
        $this->addSql('ALTER TABLE article DROP writer_id');
        $this->addSql('DROP INDEX IDX_140AB6201BC7E6B6 ON page');
        $this->addSql('ALTER TABLE page DROP writer_id');
    }
}
