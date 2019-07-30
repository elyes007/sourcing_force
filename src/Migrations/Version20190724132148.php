<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190724132148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE account (uid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, account_source VARCHAR(255) NOT NULL, annual_revenue DOUBLE PRECISION NOT NULL, billing_city VARCHAR(255) NOT NULL, billing_country VARCHAR(255) NOT NULL, billing_geocode_accuracy VARCHAR(255) NOT NULL, billing_latitude DOUBLE PRECISION NOT NULL, billing_longitude DOUBLE PRECISION NOT NULL, billing_postal_code VARCHAR(255) NOT NULL, billing_state VARCHAR(255) NOT NULL, billing_street VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, fax VARCHAR(255) NOT NULL, industry VARCHAR(255) NOT NULL, jigsaw VARCHAR(255) NOT NULL, number_of_employees INT NOT NULL, owner_id VARCHAR(255) NOT NULL, parent_id VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, shipping_city VARCHAR(255) NOT NULL, shipping_country VARCHAR(255) NOT NULL, shipping_geocode_accuracy VARCHAR(255) NOT NULL, shipping_latitude DOUBLE PRECISION NOT NULL, shipping_longitude DOUBLE PRECISION NOT NULL, shipping_postal_code VARCHAR(255) NOT NULL, shipping_state VARCHAR(255) NOT NULL, shipping_street VARCHAR(255) NOT NULL, sic_desc VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, PRIMARY KEY(uid)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (uid VARCHAR(255) NOT NULL, account_id VARCHAR(255) NOT NULL, activated_by_id VARCHAR(255) NOT NULL, activated_date VARCHAR(255) NOT NULL, billing_city VARCHAR(255) NOT NULL, billing_country VARCHAR(255) NOT NULL, billing_geocode_accuracy VARCHAR(255) NOT NULL, billing_latitude DOUBLE PRECISION NOT NULL, billing_longitude DOUBLE PRECISION NOT NULL, billing_postal_code VARCHAR(255) NOT NULL, billing_state VARCHAR(255) NOT NULL, billing_street VARCHAR(255) NOT NULL, company_signed_date VARCHAR(255) NOT NULL, company_signed_id VARCHAR(255) NOT NULL, contract_term INT NOT NULL, customer_signed_date VARCHAR(255) NOT NULL, customer_signed_id VARCHAR(255) NOT NULL, customer_signed_title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, owner_expiration_notice VARCHAR(255) NOT NULL, owner_id VARCHAR(255) NOT NULL, shipping_city VARCHAR(255) NOT NULL, shipping_country VARCHAR(255) NOT NULL, shipping_geocode_accuracy VARCHAR(255) NOT NULL, shipping_latitude DOUBLE PRECISION NOT NULL, shipping_longitude DOUBLE PRECISION NOT NULL, shipping_postal_code VARCHAR(255) NOT NULL, shipping_state VARCHAR(255) NOT NULL, shipping_street VARCHAR(255) NOT NULL, special_terms VARCHAR(255) NOT NULL, start_date VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(uid)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (uid VARCHAR(255) NOT NULL, account_id VARCHAR(255) NOT NULL, owner_id VARCHAR(255) NOT NULL, pricebook2id VARCHAR(255) NOT NULL, activated_by_id VARCHAR(255) NOT NULL, activated_date VARCHAR(255) NOT NULL, billing_city VARCHAR(255) NOT NULL, billing_country VARCHAR(255) NOT NULL, billing_geocode_accuracy VARCHAR(255) NOT NULL, billing_latitude DOUBLE PRECISION NOT NULL, billing_longitude DOUBLE PRECISION NOT NULL, billing_postal_code VARCHAR(255) NOT NULL, billing_state VARCHAR(255) NOT NULL, billing_street VARCHAR(255) NOT NULL, company_authorized_by_id VARCHAR(255) NOT NULL, contract_id VARCHAR(255) NOT NULL, customer_authorized_by_id VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, effective_date VARCHAR(255) NOT NULL, end_date VARCHAR(255) NOT NULL, shipping_city VARCHAR(255) NOT NULL, shipping_country VARCHAR(255) NOT NULL, shipping_geocode_accuracy VARCHAR(255) NOT NULL, shipping_latitude DOUBLE PRECISION NOT NULL, shipping_longitude DOUBLE PRECISION NOT NULL, shipping_postal_code VARCHAR(255) NOT NULL, shipping_state VARCHAR(255) NOT NULL, shipping_street VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, status_code VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(uid)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE `order`');
    }
}
