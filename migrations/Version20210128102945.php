<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210128102945 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, brand_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE energy (id INT AUTO_INCREMENT NOT NULL, energy_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garage (id INT AUTO_INCREMENT NOT NULL, professional_id INT NOT NULL, garage_name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, post_code VARCHAR(255) NOT NULL, commune VARCHAR(255) NOT NULL, garage_phone VARCHAR(255) NOT NULL, INDEX IDX_9F26610BDB77003 (professional_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, model_name VARCHAR(255) NOT NULL, INDEX IDX_D79572D944F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT DEFAULT NULL, photo_link VARCHAR(255) DEFAULT NULL, main_photo TINYINT(1) NOT NULL, INDEX IDX_14B784184A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professional (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, personnal_tel VARCHAR(255) NOT NULL, account_valid TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_B3B573AAE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, garage_id INT NOT NULL, model_id INT NOT NULL, energy_id INT DEFAULT NULL, reference_ad VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, kilometer INT NOT NULL, price INT NOT NULL, year INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_292FFF1DC4FFF555 (garage_id), INDEX IDX_292FFF1D7975B7E7 (model_id), INDEX IDX_292FFF1DEDDF52D (energy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE garage ADD CONSTRAINT FK_9F26610BDB77003 FOREIGN KEY (professional_id) REFERENCES professional (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784184A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DC4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DEDDF52D FOREIGN KEY (energy_id) REFERENCES energy (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DEDDF52D');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DC4FFF555');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D7975B7E7');
        $this->addSql('ALTER TABLE garage DROP FOREIGN KEY FK_9F26610BDB77003');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784184A4A3511');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE energy');
        $this->addSql('DROP TABLE garage');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE professional');
        $this->addSql('DROP TABLE vehicule');
    }
}
