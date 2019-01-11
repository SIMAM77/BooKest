<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190110224301 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE biblio_rue');
        $this->addSql('DROP TABLE biblio_user');
        $this->addSql('DROP TABLE biblio_user_quantity');
        $this->addSql('DROP TABLE cercle');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE relation_emprunteur_preteur');
        $this->addSql('ALTER TABLE users ADD username_canonical VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD email_canonical VARCHAR(255) NOT NULL, ADD enabled TINYINT(1) NOT NULL, ADD salt VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD confirmation_token VARCHAR(255) DEFAULT NULL, DROP pass, CHANGE login username VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE biblio_rue (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, adress VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, photo VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, geolocalization DOUBLE PRECISION NOT NULL, score DOUBLE PRECISION DEFAULT NULL, comments VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE biblio_user (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, status VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, genre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE biblio_user_quantity (id INT AUTO_INCREMENT NOT NULL, id_biblio INT NOT NULL, id_user INT NOT NULL, id_livre INT NOT NULL, id_genre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cercle (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, genre VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, author VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, synopsis LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, score DOUBLE PRECISION DEFAULT NULL, comments LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, historique_emprunt INT DEFAULT NULL, status VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, genre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, isbn BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, id_emprunteur INT NOT NULL, id_preteur INT NOT NULL, id_livre INT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, status_emprunt VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE relation_emprunteur_preteur (id INT AUTO_INCREMENT NOT NULL, id_emprunteur INT NOT NULL, id_preteur INT NOT NULL, id_livre INT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, status_emprunt VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE users ADD login VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD pass TEXT NOT NULL COLLATE utf8mb4_unicode_ci, DROP username, DROP username_canonical, DROP email, DROP email_canonical, DROP enabled, DROP salt, DROP password, DROP confirmation_token');
    }
}
