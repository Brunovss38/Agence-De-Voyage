<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502142236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formulaire ADD user_formulaire_contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formulaire ADD CONSTRAINT FK_5BDD01A8D96E181 FOREIGN KEY (user_formulaire_contact_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5BDD01A8D96E181 ON formulaire (user_formulaire_contact_id)');
        $this->addSql('ALTER TABLE voyage ADD user_voyage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89556829684B FOREIGN KEY (user_voyage_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3F9D89556829684B ON voyage (user_voyage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89556829684B');
        $this->addSql('DROP INDEX IDX_3F9D89556829684B ON voyage');
        $this->addSql('ALTER TABLE voyage DROP user_voyage_id');
        $this->addSql('ALTER TABLE formulaire DROP FOREIGN KEY FK_5BDD01A8D96E181');
        $this->addSql('DROP INDEX IDX_5BDD01A8D96E181 ON formulaire');
        $this->addSql('ALTER TABLE formulaire DROP user_formulaire_contact_id');
    }
}
