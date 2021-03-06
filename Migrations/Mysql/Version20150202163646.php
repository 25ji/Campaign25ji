<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20150202163646 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("CREATE TABLE eco_campaign25ji_domain_model_abstractcontent (persistence_object_identifier VARCHAR(40) NOT NULL, internaluser VARCHAR(40) DEFAULT NULL, postdate DATETIME NOT NULL, state INT NOT NULL, rawcontent LONGTEXT NOT NULL, url VARCHAR(255) NOT NULL, dtype VARCHAR(255) NOT NULL, headline VARCHAR(255) DEFAULT NULL, subheadline VARCHAR(255) DEFAULT NULL, INDEX IDX_D2F147DF239B2272 (internaluser), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("ALTER TABLE eco_campaign25ji_domain_model_abstractcontent ADD CONSTRAINT FK_D2F147DF239B2272 FOREIGN KEY (internaluser) REFERENCES typo3_party_domain_model_abstractparty (persistence_object_identifier)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("DROP TABLE eco_campaign25ji_domain_model_abstractcontent");
	}
}