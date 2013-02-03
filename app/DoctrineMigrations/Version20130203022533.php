<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130203022533 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("CREATE SEQUENCE content_text_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE content_text (id INT NOT NULL, title VARCHAR(255) NOT NULL, body TEXT NOT NULL, slug VARCHAR(255) NOT NULL, disabled BOOLEAN DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia ADD gallery_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia ADD media_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia ADD CONSTRAINT FK_B00022F94E7AF8F FOREIGN KEY (gallery_id) REFERENCES content_media_gallery (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia ADD CONSTRAINT FK_B00022F9EA9FDD75 FOREIGN KEY (media_id) REFERENCES content_media_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX IDX_B00022F94E7AF8F ON content_media_galleryhasmedia (gallery_id)");
        $this->addSql("CREATE INDEX IDX_B00022F9EA9FDD75 ON content_media_galleryhasmedia (media_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("DROP SEQUENCE content_text_id_seq");
        $this->addSql("CREATE SEQUENCE acl_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE acl_classes_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE acl_security_identities_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE acl_object_identities_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("DROP TABLE content_text");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia DROP gallery_id");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia DROP media_id");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia DROP CONSTRAINT FK_B00022F94E7AF8F");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia DROP CONSTRAINT FK_B00022F9EA9FDD75");
        $this->addSql("DROP INDEX IDX_B00022F94E7AF8F");
        $this->addSql("DROP INDEX IDX_B00022F9EA9FDD75");
    }
}
