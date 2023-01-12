<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112134818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, number_vehicles INT DEFAULT NULL, agency_location VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental (id INT AUTO_INCREMENT NOT NULL, renter_id INT DEFAULT NULL, vehicle_id INT DEFAULT NULL, start_rental DATETIME DEFAULT NULL, end_rental DATETIME DEFAULT NULL, start_location VARCHAR(255) DEFAULT NULL, end_location VARCHAR(255) DEFAULT NULL, INDEX IDX_1619C27DE289A545 (renter_id), INDEX IDX_1619C27D545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, toto_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, full_name VARCHAR(255) DEFAULT NULL, points INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649979B1AD6 (company_id), INDEX IDX_8D93D6498AFE2BB1 (toto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_vehicle (user_id INT NOT NULL, vehicle_id INT NOT NULL, INDEX IDX_438DFA8CA76ED395 (user_id), INDEX IDX_438DFA8C545317D1 (vehicle_id), PRIMARY KEY(user_id, vehicle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, vehicle_brand VARCHAR(255) DEFAULT NULL, vehicle_model VARCHAR(255) DEFAULT NULL, vehicle_type VARCHAR(255) DEFAULT NULL, vehicle_gear_box_type VARCHAR(255) DEFAULT NULL, vehicle_seat_count INT DEFAULT NULL, vehicle_door_count INT DEFAULT NULL, vehicle_fuel_type VARCHAR(255) DEFAULT NULL, year INT DEFAULT NULL, status TINYINT(1) DEFAULT NULL, price INT DEFAULT NULL, INDEX IDX_1B80E486979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27DE289A545 FOREIGN KEY (renter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498AFE2BB1 FOREIGN KEY (toto_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE user_vehicle ADD CONSTRAINT FK_438DFA8CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_vehicle ADD CONSTRAINT FK_438DFA8C545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental DROP FOREIGN KEY FK_1619C27DE289A545');
        $this->addSql('ALTER TABLE rental DROP FOREIGN KEY FK_1619C27D545317D1');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498AFE2BB1');
        $this->addSql('ALTER TABLE user_vehicle DROP FOREIGN KEY FK_438DFA8CA76ED395');
        $this->addSql('ALTER TABLE user_vehicle DROP FOREIGN KEY FK_438DFA8C545317D1');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486979B1AD6');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE rental');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_vehicle');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
