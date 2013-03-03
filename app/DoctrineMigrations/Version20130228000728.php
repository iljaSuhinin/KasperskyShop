<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130228000728 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE sylius_cart (id INT AUTO_INCREMENT NOT NULL, locked TINYINT(1) NOT NULL, total_items INT NOT NULL, total NUMERIC(10, 2) NOT NULL, expires_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sylius_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sylius_product_property (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, property_id INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_8109D8F34584665A (product_id), INDEX IDX_8109D8F3549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sylius_option_value (id INT AUTO_INCREMENT NOT NULL, option_id INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_E05AED9DA7C41D6F (option_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sylius_prototype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sylius_prototype_option (prototype_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_B458391B25998077 (prototype_id), INDEX IDX_B458391BA7C41D6F (option_id), PRIMARY KEY(prototype_id, option_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sylius_prototype_property (prototype_id INT NOT NULL, property_id INT NOT NULL, INDEX IDX_99041F2A25998077 (prototype_id), INDEX IDX_99041F2A549213EC (property_id), PRIMARY KEY(prototype_id, property_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sylius_property (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sip_user_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', UNIQUE INDEX UNIQ_6D5740125E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sip_user_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) DEFAULT NULL, website VARCHAR(64) DEFAULT NULL, biography VARCHAR(255) DEFAULT NULL, gender VARCHAR(1) DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, facebook_uid VARCHAR(255) DEFAULT NULL, facebook_name VARCHAR(255) DEFAULT NULL, facebook_data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json)', twitter_uid VARCHAR(255) DEFAULT NULL, twitter_name VARCHAR(255) DEFAULT NULL, twitter_data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json)', gplus_uid VARCHAR(255) DEFAULT NULL, gplus_name VARCHAR(255) DEFAULT NULL, gplus_data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json)', token VARCHAR(255) DEFAULT NULL, two_step_code VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1A97014992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1A970149A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B3C77447A76ED395 (user_id), INDEX IDX_B3C77447FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_news (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, image_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, date DATETIME DEFAULT NULL, slug VARCHAR(255) NOT NULL, brief LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, onMain TINYINT(1) DEFAULT NULL, INDEX IDX_D0B1749512469DE2 (category_id), INDEX IDX_D0B174953DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_media_galleryhasmedia (id INT AUTO_INCREMENT NOT NULL, gallery_id INT DEFAULT NULL, media_id INT DEFAULT NULL, position INT NOT NULL, enabled TINYINT(1) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B00022F94E7AF8F (gallery_id), INDEX IDX_B00022F9EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_media_gallery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, context VARCHAR(255) NOT NULL, default_format VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_media_media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, provider_name VARCHAR(255) NOT NULL, provider_status INT NOT NULL, provider_reference VARCHAR(255) NOT NULL, provider_metadata LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json)', width INT DEFAULT NULL, height INT DEFAULT NULL, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(64) DEFAULT NULL, content_size INT DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, author_name VARCHAR(255) DEFAULT NULL, context VARCHAR(16) DEFAULT NULL, cdn_is_flushable TINYINT(1) DEFAULT NULL, cdn_flush_at DATETIME DEFAULT NULL, cdn_status INT DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_text (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, disabled TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(32) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:array)', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, disabled TINYINT(1) DEFAULT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_product (id INT AUTO_INCREMENT NOT NULL, preview_id INT DEFAULT NULL, fullview_id INT DEFAULT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, brief LONGTEXT NOT NULL, links LONGTEXT NOT NULL, information LONGTEXT NOT NULL, disabled TINYINT(1) DEFAULT NULL, onMain TINYINT(1) DEFAULT NULL, sku INT NOT NULL, view INT NOT NULL, variant_picking_mode INT NOT NULL, UNIQUE INDEX UNIQ_C42DD1E989D9B62 (slug), INDEX IDX_C42DD1ECDE46FDB (preview_id), INDEX IDX_C42DD1E60ECA3B6 (fullview_id), INDEX IDX_C42DD1E12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sylius_product_option (product_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_E4C0EBEF4584665A (product_id), INDEX IDX_E4C0EBEFA7C41D6F (option_id), PRIMARY KEY(product_id, option_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_property (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE content_variant (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, is_master TINYINT(1) NOT NULL, presentation VARCHAR(255) DEFAULT NULL, available_on DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_2E4B661E4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sylius_variant_option_value (variant_id INT NOT NULL, option_value_id INT NOT NULL, INDEX IDX_C2666DC93B69A9AF (variant_id), INDEX IDX_C2666DC9D957CA06 (option_value_id), PRIMARY KEY(variant_id, option_value_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sip_content_cart_item (id INT AUTO_INCREMENT NOT NULL, cart_id INT NOT NULL, variant_id INT NOT NULL, quantity INT NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, total NUMERIC(10, 2) NOT NULL, INDEX IDX_D60695FB1AD5CDBF (cart_id), INDEX IDX_D60695FB3B69A9AF (variant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sip_content_cart (id INT AUTO_INCREMENT NOT NULL, locked TINYINT(1) NOT NULL, total_items INT NOT NULL, total NUMERIC(10, 2) NOT NULL, expires_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE acl_classes (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_type VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_69DD750638A36066 (class_type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE acl_security_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, identifier VARCHAR(200) NOT NULL, username TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8835EE78772E836AF85E0677 (identifier, username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE acl_object_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent_object_identity_id INT UNSIGNED DEFAULT NULL, class_id INT UNSIGNED NOT NULL, object_identifier VARCHAR(100) NOT NULL, entries_inheriting TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 (object_identifier, class_id), INDEX IDX_9407E54977FA751A (parent_object_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE acl_object_identity_ancestors (object_identity_id INT UNSIGNED NOT NULL, ancestor_id INT UNSIGNED NOT NULL, INDEX IDX_825DE2993D9AB4A6 (object_identity_id), INDEX IDX_825DE299C671CEA1 (ancestor_id), PRIMARY KEY(object_identity_id, ancestor_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE acl_entries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_id INT UNSIGNED NOT NULL, object_identity_id INT UNSIGNED DEFAULT NULL, security_identity_id INT UNSIGNED NOT NULL, field_name VARCHAR(50) DEFAULT NULL, ace_order SMALLINT UNSIGNED NOT NULL, mask INT NOT NULL, granting TINYINT(1) NOT NULL, granting_strategy VARCHAR(30) NOT NULL, audit_success TINYINT(1) NOT NULL, audit_failure TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 (class_id, object_identity_id, field_name, ace_order), INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 (class_id, object_identity_id, security_identity_id), INDEX IDX_46C8B806EA000B10 (class_id), INDEX IDX_46C8B8063D9AB4A6 (object_identity_id), INDEX IDX_46C8B806DF9183C9 (security_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE sylius_product_property ADD CONSTRAINT FK_8109D8F34584665A FOREIGN KEY (product_id) REFERENCES content_product (id)");
        $this->addSql("ALTER TABLE sylius_product_property ADD CONSTRAINT FK_8109D8F3549213EC FOREIGN KEY (property_id) REFERENCES content_property (id)");
        $this->addSql("ALTER TABLE sylius_option_value ADD CONSTRAINT FK_E05AED9DA7C41D6F FOREIGN KEY (option_id) REFERENCES content_option (id)");
        $this->addSql("ALTER TABLE sylius_prototype_option ADD CONSTRAINT FK_B458391B25998077 FOREIGN KEY (prototype_id) REFERENCES sylius_prototype (id)");
        $this->addSql("ALTER TABLE sylius_prototype_option ADD CONSTRAINT FK_B458391BA7C41D6F FOREIGN KEY (option_id) REFERENCES content_option (id)");
        $this->addSql("ALTER TABLE sylius_prototype_property ADD CONSTRAINT FK_99041F2A25998077 FOREIGN KEY (prototype_id) REFERENCES sylius_prototype (id)");
        $this->addSql("ALTER TABLE sylius_prototype_property ADD CONSTRAINT FK_99041F2A549213EC FOREIGN KEY (property_id) REFERENCES content_property (id)");
        $this->addSql("ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES sip_user_user (id)");
        $this->addSql("ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES sip_user_group (id)");
        $this->addSql("ALTER TABLE content_news ADD CONSTRAINT FK_D0B1749512469DE2 FOREIGN KEY (category_id) REFERENCES content_category (id)");
        $this->addSql("ALTER TABLE content_news ADD CONSTRAINT FK_D0B174953DA5256D FOREIGN KEY (image_id) REFERENCES content_media_media (id)");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia ADD CONSTRAINT FK_B00022F94E7AF8F FOREIGN KEY (gallery_id) REFERENCES content_media_gallery (id)");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia ADD CONSTRAINT FK_B00022F9EA9FDD75 FOREIGN KEY (media_id) REFERENCES content_media_media (id)");
        $this->addSql("ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1ECDE46FDB FOREIGN KEY (preview_id) REFERENCES content_media_media (id)");
        $this->addSql("ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E60ECA3B6 FOREIGN KEY (fullview_id) REFERENCES content_media_media (id)");
        $this->addSql("ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E12469DE2 FOREIGN KEY (category_id) REFERENCES content_category (id)");
        $this->addSql("ALTER TABLE sylius_product_option ADD CONSTRAINT FK_E4C0EBEF4584665A FOREIGN KEY (product_id) REFERENCES content_product (id)");
        $this->addSql("ALTER TABLE sylius_product_option ADD CONSTRAINT FK_E4C0EBEFA7C41D6F FOREIGN KEY (option_id) REFERENCES content_option (id)");
        $this->addSql("ALTER TABLE content_variant ADD CONSTRAINT FK_2E4B661E4584665A FOREIGN KEY (product_id) REFERENCES content_product (id)");
        $this->addSql("ALTER TABLE sylius_variant_option_value ADD CONSTRAINT FK_C2666DC93B69A9AF FOREIGN KEY (variant_id) REFERENCES content_variant (id)");
        $this->addSql("ALTER TABLE sylius_variant_option_value ADD CONSTRAINT FK_C2666DC9D957CA06 FOREIGN KEY (option_value_id) REFERENCES sylius_option_value (id)");
        $this->addSql("ALTER TABLE sip_content_cart_item ADD CONSTRAINT FK_D60695FB1AD5CDBF FOREIGN KEY (cart_id) REFERENCES sip_content_cart (id)");
        $this->addSql("ALTER TABLE sip_content_cart_item ADD CONSTRAINT FK_D60695FB3B69A9AF FOREIGN KEY (variant_id) REFERENCES content_variant (id)");
        $this->addSql("ALTER TABLE acl_object_identities ADD CONSTRAINT FK_9407E54977FA751A FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities (id)");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806EA000B10 FOREIGN KEY (class_id) REFERENCES acl_classes (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B8063D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON UPDATE CASCADE ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE sylius_variant_option_value DROP FOREIGN KEY FK_C2666DC9D957CA06");
        $this->addSql("ALTER TABLE sylius_prototype_option DROP FOREIGN KEY FK_B458391B25998077");
        $this->addSql("ALTER TABLE sylius_prototype_property DROP FOREIGN KEY FK_99041F2A25998077");
        $this->addSql("ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447FE54D947");
        $this->addSql("ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447A76ED395");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia DROP FOREIGN KEY FK_B00022F94E7AF8F");
        $this->addSql("ALTER TABLE content_news DROP FOREIGN KEY FK_D0B174953DA5256D");
        $this->addSql("ALTER TABLE content_media_galleryhasmedia DROP FOREIGN KEY FK_B00022F9EA9FDD75");
        $this->addSql("ALTER TABLE content_product DROP FOREIGN KEY FK_C42DD1ECDE46FDB");
        $this->addSql("ALTER TABLE content_product DROP FOREIGN KEY FK_C42DD1E60ECA3B6");
        $this->addSql("ALTER TABLE content_news DROP FOREIGN KEY FK_D0B1749512469DE2");
        $this->addSql("ALTER TABLE content_product DROP FOREIGN KEY FK_C42DD1E12469DE2");
        $this->addSql("ALTER TABLE sylius_option_value DROP FOREIGN KEY FK_E05AED9DA7C41D6F");
        $this->addSql("ALTER TABLE sylius_prototype_option DROP FOREIGN KEY FK_B458391BA7C41D6F");
        $this->addSql("ALTER TABLE sylius_product_option DROP FOREIGN KEY FK_E4C0EBEFA7C41D6F");
        $this->addSql("ALTER TABLE sylius_product_property DROP FOREIGN KEY FK_8109D8F34584665A");
        $this->addSql("ALTER TABLE sylius_product_option DROP FOREIGN KEY FK_E4C0EBEF4584665A");
        $this->addSql("ALTER TABLE content_variant DROP FOREIGN KEY FK_2E4B661E4584665A");
        $this->addSql("ALTER TABLE sylius_product_property DROP FOREIGN KEY FK_8109D8F3549213EC");
        $this->addSql("ALTER TABLE sylius_prototype_property DROP FOREIGN KEY FK_99041F2A549213EC");
        $this->addSql("ALTER TABLE sylius_variant_option_value DROP FOREIGN KEY FK_C2666DC93B69A9AF");
        $this->addSql("ALTER TABLE sip_content_cart_item DROP FOREIGN KEY FK_D60695FB3B69A9AF");
        $this->addSql("ALTER TABLE sip_content_cart_item DROP FOREIGN KEY FK_D60695FB1AD5CDBF");
        $this->addSql("ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806EA000B10");
        $this->addSql("ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806DF9183C9");
        $this->addSql("ALTER TABLE acl_object_identities DROP FOREIGN KEY FK_9407E54977FA751A");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE2993D9AB4A6");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE299C671CEA1");
        $this->addSql("ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B8063D9AB4A6");
        $this->addSql("DROP TABLE sylius_cart");
        $this->addSql("DROP TABLE sylius_option");
        $this->addSql("DROP TABLE sylius_product_property");
        $this->addSql("DROP TABLE sylius_option_value");
        $this->addSql("DROP TABLE sylius_prototype");
        $this->addSql("DROP TABLE sylius_prototype_option");
        $this->addSql("DROP TABLE sylius_prototype_property");
        $this->addSql("DROP TABLE sylius_property");
        $this->addSql("DROP TABLE sip_user_group");
        $this->addSql("DROP TABLE sip_user_user");
        $this->addSql("DROP TABLE fos_user_user_group");
        $this->addSql("DROP TABLE content_news");
        $this->addSql("DROP TABLE content_media_galleryhasmedia");
        $this->addSql("DROP TABLE content_media_gallery");
        $this->addSql("DROP TABLE content_media_media");
        $this->addSql("DROP TABLE content_text");
        $this->addSql("DROP TABLE content_log_entries");
        $this->addSql("DROP TABLE content_category");
        $this->addSql("DROP TABLE content_option");
        $this->addSql("DROP TABLE content_product");
        $this->addSql("DROP TABLE sylius_product_option");
        $this->addSql("DROP TABLE content_property");
        $this->addSql("DROP TABLE content_variant");
        $this->addSql("DROP TABLE sylius_variant_option_value");
        $this->addSql("DROP TABLE sip_content_cart_item");
        $this->addSql("DROP TABLE sip_content_cart");
        $this->addSql("DROP TABLE acl_classes");
        $this->addSql("DROP TABLE acl_security_identities");
        $this->addSql("DROP TABLE acl_object_identities");
        $this->addSql("DROP TABLE acl_object_identity_ancestors");
        $this->addSql("DROP TABLE acl_entries");
    }
}
