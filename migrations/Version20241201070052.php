<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241201070052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE familly_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guest (id INT AUTO_INCREMENT NOT NULL, famillygroup_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, groupe_famille VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_ACB79A35C8283B1 (famillygroup_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guest ADD CONSTRAINT FK_ACB79A35C8283B1 FOREIGN KEY (famillygroup_id) REFERENCES familly_group (id)');
        $this->addSql('ALTER TABLE user ADD familly_group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64984B81D54 FOREIGN KEY (familly_group_id) REFERENCES familly_group (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64984B81D54 ON user (familly_group_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64984B81D54');
        $this->addSql('ALTER TABLE guest DROP FOREIGN KEY FK_ACB79A35C8283B1');
        $this->addSql('DROP TABLE familly_group');
        $this->addSql('DROP TABLE guest');
        $this->addSql('DROP INDEX IDX_8D93D64984B81D54 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP familly_group_id');
    }
}
