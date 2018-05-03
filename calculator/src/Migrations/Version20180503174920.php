<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180503174920 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\DBAL\Migrations\AbortMigrationException
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE calculation (id INT AUTO_INCREMENT NOT NULL, type_payment SMALLINT NOT NULL, months INT NOT NULL, rate DOUBLE PRECISION NOT NULL, first_payment_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repayment_schedule (id INT AUTO_INCREMENT NOT NULL, id_calculation_id INT NOT NULL, repayment_index INT NOT NULL, repayment_date DATE NOT NULL, principal_debt DOUBLE PRECISION NOT NULL, percent DOUBLE PRECISION NOT NULL, general_sum DOUBLE PRECISION NOT NULL, куьremaining_debt DOUBLE PRECISION NOT NULL, INDEX IDX_DAA993C2F35BF635 (id_calculation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE repayment_schedule ADD CONSTRAINT FK_DAA993C2F35BF635 FOREIGN KEY (id_calculation_id) REFERENCES calculation (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE repayment_schedule DROP FOREIGN KEY FK_DAA993C2F35BF635');
        $this->addSql('DROP TABLE calculation');
        $this->addSql('DROP TABLE repayment_schedule');
    }
}
