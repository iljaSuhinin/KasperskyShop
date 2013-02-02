<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130202185953 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("CREATE SEQUENCE sip_user_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sip_user_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE sip_user_group (id INT NOT NULL, name VARCHAR(255) NOT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_6D5740125E237E06 ON sip_user_group (name)");
        $this->addSql("COMMENT ON COLUMN sip_user_group.roles IS '(DC2Type:array)'");
        $this->addSql("CREATE TABLE sip_user_user (id INT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, locked BOOLEAN NOT NULL, expired BOOLEAN NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, credentials_expired BOOLEAN NOT NULL, credentials_expire_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_of_birth TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) DEFAULT NULL, website VARCHAR(64) DEFAULT NULL, biography VARCHAR(255) DEFAULT NULL, gender VARCHAR(1) DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, facebook_uid VARCHAR(255) DEFAULT NULL, facebook_name VARCHAR(255) DEFAULT NULL, facebook_data TEXT DEFAULT NULL, twitter_uid VARCHAR(255) DEFAULT NULL, twitter_name VARCHAR(255) DEFAULT NULL, twitter_data TEXT DEFAULT NULL, gplus_uid VARCHAR(255) DEFAULT NULL, gplus_name VARCHAR(255) DEFAULT NULL, gplus_data TEXT DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, two_step_code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_1A97014992FC23A8 ON sip_user_user (username_canonical)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_1A970149A0D96FBF ON sip_user_user (email_canonical)");
        $this->addSql("COMMENT ON COLUMN sip_user_user.roles IS '(DC2Type:array)'");
        $this->addSql("COMMENT ON COLUMN sip_user_user.facebook_data IS '(DC2Type:json)'");
        $this->addSql("COMMENT ON COLUMN sip_user_user.twitter_data IS '(DC2Type:json)'");
        $this->addSql("COMMENT ON COLUMN sip_user_user.gplus_data IS '(DC2Type:json)'");
        $this->addSql("CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(user_id, group_id))");
        $this->addSql("CREATE INDEX IDX_B3C77447A76ED395 ON fos_user_user_group (user_id)");
        $this->addSql("CREATE INDEX IDX_B3C77447FE54D947 ON fos_user_user_group (group_id)");
        $this->addSql("CREATE TABLE content_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(32) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX log_class_lookup_idx ON content_log_entries (object_class)");
        $this->addSql("CREATE INDEX log_date_lookup_idx ON content_log_entries (logged_at)");
        $this->addSql("CREATE INDEX log_user_lookup_idx ON content_log_entries (username)");
        $this->addSql("COMMENT ON COLUMN content_log_entries.data IS '(DC2Type:array)'");
        $this->addSql("CREATE TABLE acl_classes (id SERIAL NOT NULL, class_type VARCHAR(200) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_69DD750638A36066 ON acl_classes (class_type)");
        $this->addSql("CREATE TABLE acl_security_identities (id SERIAL NOT NULL, identifier VARCHAR(200) NOT NULL, username BOOLEAN NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_8835EE78772E836AF85E0677 ON acl_security_identities (identifier, username)");
        $this->addSql("CREATE TABLE acl_object_identities (id SERIAL NOT NULL, parent_object_identity_id INT DEFAULT NULL, class_id INT NOT NULL, object_identifier VARCHAR(100) NOT NULL, entries_inheriting BOOLEAN NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 ON acl_object_identities (object_identifier, class_id)");
        $this->addSql("CREATE INDEX IDX_9407E54977FA751A ON acl_object_identities (parent_object_identity_id)");
        $this->addSql("CREATE TABLE acl_object_identity_ancestors (object_identity_id INT NOT NULL, ancestor_id INT NOT NULL, PRIMARY KEY(object_identity_id, ancestor_id))");
        $this->addSql("CREATE INDEX IDX_825DE2993D9AB4A6 ON acl_object_identity_ancestors (object_identity_id)");
        $this->addSql("CREATE INDEX IDX_825DE299C671CEA1 ON acl_object_identity_ancestors (ancestor_id)");
        $this->addSql("CREATE TABLE acl_entries (id SERIAL NOT NULL, class_id INT NOT NULL, object_identity_id INT DEFAULT NULL, security_identity_id INT NOT NULL, field_name VARCHAR(50) DEFAULT NULL, ace_order SMALLINT NOT NULL, mask INT NOT NULL, granting BOOLEAN NOT NULL, granting_strategy VARCHAR(30) NOT NULL, audit_success BOOLEAN NOT NULL, audit_failure BOOLEAN NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 ON acl_entries (class_id, object_identity_id, field_name, ace_order)");
        $this->addSql("CREATE INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 ON acl_entries (class_id, object_identity_id, security_identity_id)");
        $this->addSql("CREATE INDEX IDX_46C8B806EA000B10 ON acl_entries (class_id)");
        $this->addSql("CREATE INDEX IDX_46C8B8063D9AB4A6 ON acl_entries (object_identity_id)");
        $this->addSql("CREATE INDEX IDX_46C8B806DF9183C9 ON acl_entries (security_identity_id)");
        $this->addSql("ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES sip_user_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES sip_user_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE acl_object_identities ADD CONSTRAINT FK_9407E54977FA751A FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806EA000B10 FOREIGN KEY (class_id) REFERENCES acl_classes (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B8063D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("ALTER TABLE fos_user_user_group DROP CONSTRAINT FK_B3C77447FE54D947");
        $this->addSql("ALTER TABLE fos_user_user_group DROP CONSTRAINT FK_B3C77447A76ED395");
        $this->addSql("ALTER TABLE acl_entries DROP CONSTRAINT FK_46C8B806EA000B10");
        $this->addSql("ALTER TABLE acl_entries DROP CONSTRAINT FK_46C8B806DF9183C9");
        $this->addSql("ALTER TABLE acl_object_identities DROP CONSTRAINT FK_9407E54977FA751A");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors DROP CONSTRAINT FK_825DE2993D9AB4A6");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors DROP CONSTRAINT FK_825DE299C671CEA1");
        $this->addSql("ALTER TABLE acl_entries DROP CONSTRAINT FK_46C8B8063D9AB4A6");
        $this->addSql("DROP SEQUENCE sip_user_group_id_seq");
        $this->addSql("DROP SEQUENCE sip_user_user_id_seq");
        $this->addSql("DROP SEQUENCE content_log_entries_id_seq");
        $this->addSql("DROP TABLE sip_user_group");
        $this->addSql("DROP TABLE sip_user_user");
        $this->addSql("DROP TABLE fos_user_user_group");
        $this->addSql("DROP TABLE content_log_entries");
        $this->addSql("DROP TABLE acl_classes");
        $this->addSql("DROP TABLE acl_security_identities");
        $this->addSql("DROP TABLE acl_object_identities");
        $this->addSql("DROP TABLE acl_object_identity_ancestors");
        $this->addSql("DROP TABLE acl_entries");
    }
}
