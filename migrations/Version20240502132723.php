<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502132723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formulaire (id INT AUTO_INCREMENT NOT NULL, voyage_id INT DEFAULT NULL, statut_id INT DEFAULT NULL, formcontact_id INT DEFAULT NULL, nombre_de_place INT NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_5BDD01A868C9E5AF (voyage_id), INDEX IDX_5BDD01A8F6203804 (statut_id), INDEX IDX_5BDD01A8DB3D3B5B (formcontact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom_pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom_role VARCHAR(55) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, nom_user VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, telephone VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, reserver_id INT NOT NULL, nom_voyage VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, depart DATE NOT NULL, retour DATE NOT NULL, INDEX IDX_3F9D895544A67F3 (reserver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_pays (voyage_id INT NOT NULL, pays_id INT NOT NULL, INDEX IDX_A40DF42068C9E5AF (voyage_id), INDEX IDX_A40DF420A6E44244 (pays_id), PRIMARY KEY(voyage_id, pays_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_categorie (voyage_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_7B84F8AA68C9E5AF (voyage_id), INDEX IDX_7B84F8AABCF5E72D (categorie_id), PRIMARY KEY(voyage_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formulaire ADD CONSTRAINT FK_5BDD01A868C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE formulaire ADD CONSTRAINT FK_5BDD01A8F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE formulaire ADD CONSTRAINT FK_5BDD01A8DB3D3B5B FOREIGN KEY (formcontact_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895544A67F3 FOREIGN KEY (reserver_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE voyage_pays ADD CONSTRAINT FK_A40DF42068C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_pays ADD CONSTRAINT FK_A40DF420A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_categorie ADD CONSTRAINT FK_7B84F8AA68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_categorie ADD CONSTRAINT FK_7B84F8AABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formulaire DROP FOREIGN KEY FK_5BDD01A868C9E5AF');
        $this->addSql('ALTER TABLE formulaire DROP FOREIGN KEY FK_5BDD01A8F6203804');
        $this->addSql('ALTER TABLE formulaire DROP FOREIGN KEY FK_5BDD01A8DB3D3B5B');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D895544A67F3');
        $this->addSql('ALTER TABLE voyage_pays DROP FOREIGN KEY FK_A40DF42068C9E5AF');
        $this->addSql('ALTER TABLE voyage_pays DROP FOREIGN KEY FK_A40DF420A6E44244');
        $this->addSql('ALTER TABLE voyage_categorie DROP FOREIGN KEY FK_7B84F8AA68C9E5AF');
        $this->addSql('ALTER TABLE voyage_categorie DROP FOREIGN KEY FK_7B84F8AABCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE formulaire');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('DROP TABLE voyage_pays');
        $this->addSql('DROP TABLE voyage_categorie');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
