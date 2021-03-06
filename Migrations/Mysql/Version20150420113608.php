<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20150420113608 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE eco_campaign25ji_domain_model_abstractcontent ADD image VARCHAR(40) DEFAULT NULL");
		$this->addSql("ALTER TABLE eco_campaign25ji_domain_model_abstractcontent ADD CONSTRAINT FK_D2F147DFC53D045F FOREIGN KEY (image) REFERENCES typo3_media_domain_model_image (persistence_object_identifier)");
		$this->addSql("CREATE INDEX IDX_D2F147DFC53D045F ON eco_campaign25ji_domain_model_abstractcontent (image)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE eco_campaign25ji_domain_model_abstractcontent DROP FOREIGN KEY FK_D2F147DFC53D045F");
		$this->addSql("DROP INDEX IDX_D2F147DFC53D045F ON eco_campaign25ji_domain_model_abstractcontent");
		$this->addSql("ALTER TABLE eco_campaign25ji_domain_model_abstractcontent DROP image");
	}
}