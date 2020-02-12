<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200205180118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ponencia ADD categoriaponencia_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE ponencia ADD CONSTRAINT FK_C842908BD84F2289 FOREIGN KEY (categoriaponencia_id_id) REFERENCES categoriaponencia (id)');
        $this->addSql('CREATE INDEX IDX_C842908BD84F2289 ON ponencia (categoriaponencia_id_id)');
        $this->addSql('ALTER TABLE taller ADD categoriataller_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE taller ADD CONSTRAINT FK_139F45845AF7E186 FOREIGN KEY (categoriataller_id_id) REFERENCES categoriataller (id)');
        $this->addSql('CREATE INDEX IDX_139F45845AF7E186 ON taller (categoriataller_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ponencia DROP FOREIGN KEY FK_C842908BD84F2289');
        $this->addSql('DROP INDEX IDX_C842908BD84F2289 ON ponencia');
        $this->addSql('ALTER TABLE ponencia DROP categoriaponencia_id_id');
        $this->addSql('ALTER TABLE taller DROP FOREIGN KEY FK_139F45845AF7E186');
        $this->addSql('DROP INDEX IDX_139F45845AF7E186 ON taller');
        $this->addSql('ALTER TABLE taller DROP categoriataller_id_id');
    }
}
