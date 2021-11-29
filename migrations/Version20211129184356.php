<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211129184356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bestellingen (id INT AUTO_INCREMENT NOT NULL, reservering_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_35E67EBB1FC0CA1D (reservering_id), INDEX IDX_35E67EBBCCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorien (id INT AUTO_INCREMENT NOT NULL, sub_categorie_id INT NOT NULL, gerecht VARCHAR(20) NOT NULL, dranken VARCHAR(20) NOT NULL, INDEX IDX_59F52AB1ABA7A01B (sub_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, categorien_id INT NOT NULL, naam VARCHAR(20) NOT NULL, prijs DOUBLE PRECISION NOT NULL, omschrijving VARCHAR(50) NOT NULL, INDEX IDX_7D053A93619BF5 (categorien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservering (id INT AUTO_INCREMENT NOT NULL, datum DATE NOT NULL, tijd TIME NOT NULL, tafel INT NOT NULL, naam VARCHAR(50) NOT NULL, telefoon VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_categorie (id INT AUTO_INCREMENT NOT NULL, dranken VARCHAR(20) NOT NULL, warme_dranken VARCHAR(25) NOT NULL, hapjes VARCHAR(20) NOT NULL, voorgerecht VARCHAR(30) NOT NULL, hoofdgerecht VARCHAR(30) NOT NULL, nagerecht VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bestellingen ADD CONSTRAINT FK_35E67EBB1FC0CA1D FOREIGN KEY (reservering_id) REFERENCES reservering (id)');
        $this->addSql('ALTER TABLE bestellingen ADD CONSTRAINT FK_35E67EBBCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE categorien ADD CONSTRAINT FK_59F52AB1ABA7A01B FOREIGN KEY (sub_categorie_id) REFERENCES sub_categorie (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93619BF5 FOREIGN KEY (categorien_id) REFERENCES categorien (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93619BF5');
        $this->addSql('ALTER TABLE bestellingen DROP FOREIGN KEY FK_35E67EBBCCD7E912');
        $this->addSql('ALTER TABLE bestellingen DROP FOREIGN KEY FK_35E67EBB1FC0CA1D');
        $this->addSql('ALTER TABLE categorien DROP FOREIGN KEY FK_59F52AB1ABA7A01B');
        $this->addSql('DROP TABLE bestellingen');
        $this->addSql('DROP TABLE categorien');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE reservering');
        $this->addSql('DROP TABLE sub_categorie');
    }
}
