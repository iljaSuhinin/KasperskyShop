<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130207001744 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("CREATE SEQUENCE sylius_cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sylius_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sylius_option_value_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sylius_product_property_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sylius_property_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sylius_prototype_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sip_user_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sip_user_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_product_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_variant_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sip_content_cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE sip_content_cart_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_media_gallery_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_media_galleryhasmedia_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_media_media_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE content_text_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE sylius_cart (id INT NOT NULL, locked BOOLEAN NOT NULL, total_items INT NOT NULL, total NUMERIC(10, 2) NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE sylius_option (id INT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE sylius_option_value (id INT NOT NULL, option_id INT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_E05AED9DA7C41D6F ON sylius_option_value (option_id)");
        $this->addSql("CREATE TABLE sylius_product_property (id INT NOT NULL, product_id INT NOT NULL, property_id INT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_8109D8F34584665A ON sylius_product_property (product_id)");
        $this->addSql("CREATE INDEX IDX_8109D8F3549213EC ON sylius_product_property (property_id)");
        $this->addSql("CREATE TABLE sylius_property (id INT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE sylius_prototype (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE sylius_prototype_option (prototype_id INT NOT NULL, option_id INT NOT NULL, PRIMARY KEY(prototype_id, option_id))");
        $this->addSql("CREATE INDEX IDX_B458391B25998077 ON sylius_prototype_option (prototype_id)");
        $this->addSql("CREATE INDEX IDX_B458391BA7C41D6F ON sylius_prototype_option (option_id)");
        $this->addSql("CREATE TABLE sylius_prototype_property (prototype_id INT NOT NULL, property_id INT NOT NULL, PRIMARY KEY(prototype_id, property_id))");
        $this->addSql("CREATE INDEX IDX_99041F2A25998077 ON sylius_prototype_property (prototype_id)");
        $this->addSql("CREATE INDEX IDX_99041F2A549213EC ON sylius_prototype_property (property_id)");
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
        $this->addSql("CREATE TABLE content_option (id INT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE content_product (id INT NOT NULL, image_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_C42DD1E989D9B62 ON content_product (slug)");
        $this->addSql("CREATE INDEX IDX_C42DD1E3DA5256D ON content_product (image_id)");
        $this->addSql("CREATE TABLE sylius_product_option (product_id INT NOT NULL, option_id INT NOT NULL, PRIMARY KEY(product_id, option_id))");
        $this->addSql("CREATE INDEX IDX_E4C0EBEF4584665A ON sylius_product_option (product_id)");
        $this->addSql("CREATE INDEX IDX_E4C0EBEFA7C41D6F ON sylius_product_option (option_id)");
        $this->addSql("CREATE TABLE content_variant (id INT NOT NULL, product_id INT NOT NULL, is_master BOOLEAN NOT NULL, presentation VARCHAR(255) DEFAULT NULL, available_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_2E4B661E4584665A ON content_variant (product_id)");
        $this->addSql("CREATE TABLE sylius_variant_option_value (variant_id INT NOT NULL, option_value_id INT NOT NULL, PRIMARY KEY(variant_id, option_value_id))");
        $this->addSql("CREATE INDEX IDX_C2666DC93B69A9AF ON sylius_variant_option_value (variant_id)");
        $this->addSql("CREATE INDEX IDX_C2666DC9D957CA06 ON sylius_variant_option_value (option_value_id)");
        $this->addSql("CREATE TABLE sip_content_cart (id INT NOT NULL, locked BOOLEAN NOT NULL, total_items INT NOT NULL, total NUMERIC(10, 2) NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE sip_content_cart_item (id INT NOT NULL, cart_id INT NOT NULL, variant_id INT NOT NULL, quantity INT NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, total NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_D60695FB1AD5CDBF ON sip_content_cart_item (cart_id)");
        $this->addSql("CREATE INDEX IDX_D60695FB3B69A9AF ON sip_content_cart_item (variant_id)");
        $this->addSql("CREATE TABLE content_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(32) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX log_class_lookup_idx ON content_log_entries (object_class)");
        $this->addSql("CREATE INDEX log_date_lookup_idx ON content_log_entries (logged_at)");
        $this->addSql("CREATE INDEX log_user_lookup_idx ON content_log_entries (username)");
        $this->addSql("COMMENT ON COLUMN content_log_entries.data IS '(DC2Type:array)'");
        $this->addSql("CREATE TABLE content_media_gallery (id INT NOT NULL, name VARCHAR(255) NOT NULL, context VARCHAR(255) NOT NULL, default_format VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE content_media_galleryhasmedia (id INT NOT NULL, gallery_id INT DEFAULT NULL, media_id INT DEFAULT NULL, position INT NOT NULL, enabled BOOLEAN NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_B00022F94E7AF8F ON content_media_galleryhasmedia (gallery_id)");
        $this->addSql("CREATE INDEX IDX_B00022F9EA9FDD75 ON content_media_galleryhasmedia (media_id)");
        $this->addSql("CREATE TABLE content_media_media (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, enabled BOOLEAN NOT NULL, provider_name VARCHAR(255) NOT NULL, provider_status INT NOT NULL, provider_reference VARCHAR(255) NOT NULL, provider_metadata TEXT DEFAULT NULL, width INT DEFAULT NULL, height INT DEFAULT NULL, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(64) DEFAULT NULL, content_size INT DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, author_name VARCHAR(255) DEFAULT NULL, context VARCHAR(16) DEFAULT NULL, cdn_is_flushable BOOLEAN DEFAULT NULL, cdn_flush_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, cdn_status INT DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("COMMENT ON COLUMN content_media_media.provider_metadata IS '(DC2Type:json)'");
        $this->addSql("CREATE TABLE content_text (id INT NOT NULL, title VARCHAR(255) NOT NULL, body TEXT NOT NULL, slug VARCHAR(255) NOT NULL, disabled BOOLEAN DEFAULT NULL, PRIMARY KEY(id))");
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
        $this->addSql("ALTER TABLE sylius_option_value ADD CONSTRAINT FK_E05AED9DA7C41D6F FOREIGN KEY (option_id) REFERENCES content_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_product_property ADD CONSTRAINT FK_8109D8F34584665A FOREIGN KEY (product_id) REFERENCES content_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_product_property ADD CONSTRAINT FK_8109D8F3549213EC FOREIGN KEY (property_id) REFERENCES sylius_property (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_prototype_option ADD CONSTRAINT FK_B458391B25998077 FOREIGN KEY (prototype_id) REFERENCES sylius_prototype (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_prototype_option ADD CONSTRAINT FK_B458391BA7C41D6F FOREIGN KEY (option_id) REFERENCES content_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_prototype_property ADD CONSTRAINT FK_99041F2A25998077 FOREIGN KEY (prototype_id) REFERENCES sylius_prototype (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_prototype_property ADD CONSTRAINT FK_99041F2A549213EC FOREIGN KEY (property_id) REFERENCES sylius_property (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES sip_user_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES sip_user_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E3DA5256D FOREIGN KEY (image_id) REFERENCES content_media_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_product_option ADD CONSTRAINT FK_E4C0EBEF4584665A FOREIGN KEY (product_id) REFERENCES content_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_product_option ADD CONSTRAINT FK_E4C0EBEFA7C41D6F FOREIGN KEY (option_id) REFERENCES content_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE content_variant ADD CONSTRAINT FK_2E4B661E4584665A FOREIGN KEY (product_id) REFERENCES content_product (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_variant_option_value ADD CONSTRAINT FK_C2666DC93B69A9AF FOREIGN KEY (variant_id) REFERENCES content_variant (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sylius_variant_option_value ADD CONSTRAINT FK_C2666DC9D957CA06 FOREIGN KEY (option_value_id) REFERENCES sylius_option_value (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sip_content_cart_item ADD CONSTRAINT FK_D60695FB1AD5CDBF FOREIGN KEY (cart_id) REFERENCES sip_content_cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE sip_content_cart_item ADD CONSTRAINT FK_D60695FB3B69A9AF FOREIGN KEY (variant_id) REFERENCES content_variant (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia ADD CONSTRAINT FK_B00022F94E7AF8F FOREIGN KEY (gallery_id) REFERENCES content_media_gallery (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia ADD CONSTRAINT FK_B00022F9EA9FDD75 FOREIGN KEY (media_id) REFERENCES content_media_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
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
        
        $this->addSql("ALTER TABLE sylius_variant_option_value DROP CONSTRAINT FK_C2666DC9D957CA06");
        $this->addSql("ALTER TABLE sylius_product_property DROP CONSTRAINT FK_8109D8F3549213EC");
        $this->addSql("ALTER TABLE sylius_prototype_property DROP CONSTRAINT FK_99041F2A549213EC");
        $this->addSql("ALTER TABLE sylius_prototype_option DROP CONSTRAINT FK_B458391B25998077");
        $this->addSql("ALTER TABLE sylius_prototype_property DROP CONSTRAINT FK_99041F2A25998077");
        $this->addSql("ALTER TABLE fos_user_user_group DROP CONSTRAINT FK_B3C77447FE54D947");
        $this->addSql("ALTER TABLE fos_user_user_group DROP CONSTRAINT FK_B3C77447A76ED395");
        $this->addSql("ALTER TABLE sylius_option_value DROP CONSTRAINT FK_E05AED9DA7C41D6F");
        $this->addSql("ALTER TABLE sylius_prototype_option DROP CONSTRAINT FK_B458391BA7C41D6F");
        $this->addSql("ALTER TABLE sylius_product_option DROP CONSTRAINT FK_E4C0EBEFA7C41D6F");
        $this->addSql("ALTER TABLE sylius_product_property DROP CONSTRAINT FK_8109D8F34584665A");
        $this->addSql("ALTER TABLE sylius_product_option DROP CONSTRAINT FK_E4C0EBEF4584665A");
        $this->addSql("ALTER TABLE content_variant DROP CONSTRAINT FK_2E4B661E4584665A");
        $this->addSql("ALTER TABLE sylius_variant_option_value DROP CONSTRAINT FK_C2666DC93B69A9AF");
        $this->addSql("ALTER TABLE sip_content_cart_item DROP CONSTRAINT FK_D60695FB3B69A9AF");
        $this->addSql("ALTER TABLE sip_content_cart_item DROP CONSTRAINT FK_D60695FB1AD5CDBF");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia DROP CONSTRAINT FK_B00022F94E7AF8F");
        $this->addSql("ALTER TABLE content_product DROP CONSTRAINT FK_C42DD1E3DA5256D");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia DROP CONSTRAINT FK_B00022F9EA9FDD75");
        $this->addSql("ALTER TABLE acl_entries DROP CONSTRAINT FK_46C8B806EA000B10");
        $this->addSql("ALTER TABLE acl_entries DROP CONSTRAINT FK_46C8B806DF9183C9");
        $this->addSql("ALTER TABLE acl_object_identities DROP CONSTRAINT FK_9407E54977FA751A");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors DROP CONSTRAINT FK_825DE2993D9AB4A6");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors DROP CONSTRAINT FK_825DE299C671CEA1");
        $this->addSql("ALTER TABLE acl_entries DROP CONSTRAINT FK_46C8B8063D9AB4A6");
        $this->addSql("DROP SEQUENCE sylius_cart_id_seq");
        $this->addSql("DROP SEQUENCE sylius_option_id_seq");
        $this->addSql("DROP SEQUENCE sylius_option_value_id_seq");
        $this->addSql("DROP SEQUENCE sylius_product_property_id_seq");
        $this->addSql("DROP SEQUENCE sylius_property_id_seq");
        $this->addSql("DROP SEQUENCE sylius_prototype_id_seq");
        $this->addSql("DROP SEQUENCE sip_user_group_id_seq");
        $this->addSql("DROP SEQUENCE sip_user_user_id_seq");
        $this->addSql("DROP SEQUENCE content_option_id_seq");
        $this->addSql("DROP SEQUENCE content_product_id_seq");
        $this->addSql("DROP SEQUENCE content_variant_id_seq");
        $this->addSql("DROP SEQUENCE sip_content_cart_id_seq");
        $this->addSql("DROP SEQUENCE sip_content_cart_item_id_seq");
        $this->addSql("DROP SEQUENCE content_log_entries_id_seq");
        $this->addSql("DROP SEQUENCE content_media_gallery_id_seq");
        $this->addSql("DROP SEQUENCE content_media_galleryhasmedia_id_seq");
        $this->addSql("DROP SEQUENCE content_media_media_id_seq");
        $this->addSql("DROP SEQUENCE content_text_id_seq");
        $this->addSql("DROP TABLE sylius_cart");
        $this->addSql("DROP TABLE sylius_option");
        $this->addSql("DROP TABLE sylius_option_value");
        $this->addSql("DROP TABLE sylius_product_property");
        $this->addSql("DROP TABLE sylius_property");
        $this->addSql("DROP TABLE sylius_prototype");
        $this->addSql("DROP TABLE sylius_prototype_option");
        $this->addSql("DROP TABLE sylius_prototype_property");
        $this->addSql("DROP TABLE sip_user_group");
        $this->addSql("DROP TABLE sip_user_user");
        $this->addSql("DROP TABLE fos_user_user_group");
        $this->addSql("DROP TABLE content_option");
        $this->addSql("DROP TABLE content_product");
        $this->addSql("DROP TABLE sylius_product_option");
        $this->addSql("DROP TABLE content_variant");
        $this->addSql("DROP TABLE sylius_variant_option_value");
        $this->addSql("DROP TABLE sip_content_cart");
        $this->addSql("DROP TABLE sip_content_cart_item");
        $this->addSql("DROP TABLE content_log_entries");
        $this->addSql("DROP TABLE content_media_gallery");
        $this->addSql("DROP TABLE content_media_galleryhasmedia");
        $this->addSql("DROP TABLE content_media_media");
        $this->addSql("DROP TABLE content_text");
        $this->addSql("DROP TABLE acl_classes");
        $this->addSql("DROP TABLE acl_security_identities");
        $this->addSql("DROP TABLE acl_object_identities");
        $this->addSql("DROP TABLE acl_object_identity_ancestors");
        $this->addSql("DROP TABLE acl_entries");
    }
}
