<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210227101120 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conciertos (id VARCHAR(255) NOT NULL, promotor_id VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:promotorId)\', recinto_id VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:recintoId)\', nombre VARCHAR(100) NOT NULL, numero_espectadores INT NOT NULL, fecha DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', rentabilidad INT NOT NULL, INDEX IDX_E231245B134AAD7 (promotor_id), INDEX IDX_E231245B83618404 (recinto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupos_conciertos (concierto_id VARCHAR(255) NOT NULL, grupo_id VARCHAR(255) NOT NULL COMMENT \'(DC2Type:grupoId)\', INDEX IDX_8D40A240EB225AAB (concierto_id), INDEX IDX_8D40A2409C833003 (grupo_id), PRIMARY KEY(concierto_id, grupo_id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medios_conciertos (concierto_id VARCHAR(255) NOT NULL, medio_id VARCHAR(255) NOT NULL COMMENT \'(DC2Type:medioPublicitarioId)\', INDEX IDX_91CF3C79EB225AAB (concierto_id), INDEX IDX_91CF3C79A40AA46 (medio_id), PRIMARY KEY(concierto_id, medio_id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupos (id VARCHAR(255) NOT NULL COMMENT \'(DC2Type:grupoId)\', nombre VARCHAR(100) NOT NULL, cache INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medios (id VARCHAR(255) NOT NULL COMMENT \'(DC2Type:medioPublicitarioId)\', nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotores (id VARCHAR(255) NOT NULL COMMENT \'(DC2Type:promotorId)\', nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recintos (id VARCHAR(255) NOT NULL COMMENT \'(DC2Type:recintoId)\', nombre VARCHAR(100) NOT NULL, coste_alquiler INT NOT NULL, precio_entrada INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conciertos ADD CONSTRAINT FK_E231245B134AAD7 FOREIGN KEY (promotor_id) REFERENCES promotores (id)');
        $this->addSql('ALTER TABLE conciertos ADD CONSTRAINT FK_E231245B83618404 FOREIGN KEY (recinto_id) REFERENCES recintos (id)');
        $this->addSql('ALTER TABLE grupos_conciertos ADD CONSTRAINT FK_8D40A240EB225AAB FOREIGN KEY (concierto_id) REFERENCES conciertos (id)');
        $this->addSql('ALTER TABLE grupos_conciertos ADD CONSTRAINT FK_8D40A2409C833003 FOREIGN KEY (grupo_id) REFERENCES grupos (id)');
        $this->addSql('ALTER TABLE medios_conciertos ADD CONSTRAINT FK_91CF3C79EB225AAB FOREIGN KEY (concierto_id) REFERENCES conciertos (id)');
        $this->addSql('ALTER TABLE medios_conciertos ADD CONSTRAINT FK_91CF3C79A40AA46 FOREIGN KEY (medio_id) REFERENCES medios (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grupos_conciertos DROP FOREIGN KEY FK_8D40A240EB225AAB');
        $this->addSql('ALTER TABLE medios_conciertos DROP FOREIGN KEY FK_91CF3C79EB225AAB');
        $this->addSql('ALTER TABLE grupos_conciertos DROP FOREIGN KEY FK_8D40A2409C833003');
        $this->addSql('ALTER TABLE medios_conciertos DROP FOREIGN KEY FK_91CF3C79A40AA46');
        $this->addSql('ALTER TABLE conciertos DROP FOREIGN KEY FK_E231245B134AAD7');
        $this->addSql('ALTER TABLE conciertos DROP FOREIGN KEY FK_E231245B83618404');
        $this->addSql('DROP TABLE conciertos');
        $this->addSql('DROP TABLE grupos_conciertos');
        $this->addSql('DROP TABLE medios_conciertos');
        $this->addSql('DROP TABLE grupos');
        $this->addSql('DROP TABLE medios');
        $this->addSql('DROP TABLE promotores');
        $this->addSql('DROP TABLE recintos');
    }
}
