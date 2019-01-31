<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181222142300 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE biblio_rue (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, geolocalization DOUBLE PRECISION NOT NULL, score DOUBLE PRECISION DEFAULT NULL, comments VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biblio_user (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, status VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biblio_user_quantity (id INT AUTO_INCREMENT NOT NULL, id_biblio INT NOT NULL, id_user INT NOT NULL, id_livre INT NOT NULL, id_genre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cercle (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, genre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) DEFAULT NULL, synopsis LONGTEXT DEFAULT NULL, score DOUBLE PRECISION DEFAULT NULL, comments LONGTEXT DEFAULT NULL, historique_emprunt INT DEFAULT NULL, status VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, id_emprunteur INT NOT NULL, id_preteur INT NOT NULL, id_livre INT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, status_emprunt VARCHAR(255) NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation_emprunteur_preteur (id INT AUTO_INCREMENT NOT NULL, id_emprunteur INT NOT NULL, id_preteur INT NOT NULL, id_livre INT NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, status_emprunt VARCHAR(255) NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, pass VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, facebook_id INT DEFAULT NULL, google_id INT DEFAULT NULL, id_cercle INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE biblio_rue');
        $this->addSql('DROP TABLE biblio_user');
        $this->addSql('DROP TABLE biblio_user_quantity');
        $this->addSql('DROP TABLE cercle');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE relation_emprunteur_preteur');
        $this->addSql('DROP TABLE user');
    }
}
