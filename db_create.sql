SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `org class`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `org class` ;

CREATE TABLE IF NOT EXISTS `org class` (
  `orgclass_id` INT NOT NULL AUTO_INCREMENT,
  `classname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`orgclass_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `producer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `producer` ;

CREATE TABLE IF NOT EXISTS `producer` (
  `id_producer` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NULL,
  `last_name` VARCHAR(255) NULL,
  `org_name` VARCHAR(255) NULL,
  `organization_url` VARCHAR(255) NULL,
  `email_address` VARCHAR(255) NULL,
  `user_name` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `description` BLOB NULL,
  `country` VARCHAR(255) NULL,
  `orgclass_id` INT NULL,
  PRIMARY KEY (`id_producer`),
  INDEX `orgclass_id_idx` (`orgclass_id` ASC),
  CONSTRAINT `orgclass_id`
    FOREIGN KEY (`orgclass_id`)
    REFERENCES `org class` (`orgclass_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `producer_account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `producer_account` ;

CREATE TABLE IF NOT EXISTS `producer_account` (
  `producer_id` INT NOT NULL,
  `campaign_id` INT NULL,
  `account_name` VARCHAR(45) NULL,
  PRIMARY KEY (`producer_id`),
  CONSTRAINT `fk_producer_account_id`
    FOREIGN KEY (`producer_id`)
    REFERENCES `producer` (`id_producer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `supporter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `supporter` ;

CREATE TABLE IF NOT EXISTS `supporter` (
  `id_supporter` INT NOT NULL AUTO_INCREMENT,
  `id_follower_count` INT NULL,
  `interests` VARCHAR(45) NULL,
  `email_address` VARCHAR(45) NULL,
  `approved` ENUM('Y','N') NULL,
  PRIMARY KEY (`id_supporter`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campaign`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campaign` ;

CREATE TABLE IF NOT EXISTS `campaign` (
  `campaign_id` INT NOT NULL AUTO_INCREMENT,
  `budget` FLOAT NULL,
  `billing_approved` ENUM('Y','N') NULL,
  `estimate` FLOAT NULL,
  `start_date` DATETIME NULL,
  `end_date` DATETIME NULL,
  `approved` ENUM('Y','N') NULL,
  `screen_shot` VARCHAR(45) NULL,
  PRIMARY KEY (`campaign_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `supporter_interest`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `supporter_interest` ;

CREATE TABLE IF NOT EXISTS `supporter_interest` (
  `supporter_interest_if` INT NOT NULL AUTO_INCREMENT,
  `supporter_id` INT NULL,
  `id_interest` INT NULL,
  PRIMARY KEY (`supporter_interest_if`),
  INDEX `fk_supporter_interest_1_idx` (`supporter_id` ASC),
  CONSTRAINT `fk_supporter_interest_1`
    FOREIGN KEY (`supporter_id`)
    REFERENCES `supporter` (`id_supporter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campaign_response`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campaign_response` ;

CREATE TABLE IF NOT EXISTS `campaign_response` (
  `campaign_response_id` INT NOT NULL AUTO_INCREMENT,
  `campaign_id` INT NOT NULL,
  `supporter_id` INT NULL,
  `campaign_response` VARCHAR(45) NULL,
  PRIMARY KEY (`campaign_response_id`),
  INDEX `fk_campaign_response_1_idx` (`campaign_id` ASC),
  CONSTRAINT `fk_campaign_response_1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`campaign_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `follower_count`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `follower_count` ;

CREATE TABLE IF NOT EXISTS `follower_count` (
  `follower_count_id` INT NOT NULL AUTO_INCREMENT,
  `source_id` INT NULL,
  `count` INT NULL,
  `supporter_id` INT NULL,
  PRIMARY KEY (`follower_count_id`),
  INDEX `fk_follower_count_1_idx` (`supporter_id` ASC),
  CONSTRAINT `fk_follower_count_1`
    FOREIGN KEY (`supporter_id`)
    REFERENCES `supporter` (`id_supporter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tags` ;

CREATE TABLE IF NOT EXISTS `tags` (
  `id_tag` INT NOT NULL,
  `tag_name` INT NULL,
  PRIMARY KEY (`id_tag`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escrow`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `escrow` ;

CREATE TABLE IF NOT EXISTS `escrow` (
  `escrow_id` INT NOT NULL AUTO_INCREMENT,
  `estimate` DOUBLE NULL,
  `actual` DOUBLE NULL,
  `campaign_id` INT NULL,
  PRIMARY KEY (`escrow_id`),
  INDEX `fk_escrow_1_idx` (`campaign_id` ASC),
  CONSTRAINT `fk_escrow_1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`campaign_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `screen_shots`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `screen_shots` ;

CREATE TABLE IF NOT EXISTS `screen_shots` (
  `screen_shots_id` INT NOT NULL AUTO_INCREMENT,
  `campaign_id` INT NULL,
  `image` VARCHAR(45) NULL,
  `approved` ENUM('Y','N') NULL,
  `id_supporter` INT NULL,
  PRIMARY KEY (`screen_shots_id`),
  INDEX `fk_screen_shots_1_idx` (`campaign_id` ASC),
  CONSTRAINT `fk_screen_shots_1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`campaign_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `targeting`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `targeting` ;

CREATE TABLE IF NOT EXISTS `targeting` (
  `tag_id` INT NOT NULL AUTO_INCREMENT,
  `campaign_id` INT NULL,
  PRIMARY KEY (`tag_id`),
  INDEX `fk_targeting_1_idx` (`campaign_id` ASC),
  CONSTRAINT `fk_targeting_1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`campaign_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `calculation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calculation` ;

CREATE TABLE IF NOT EXISTS `calculation` (
  `calculation_id` INT NOT NULL AUTO_INCREMENT,
  `tag_id` INT NULL,
  `cpm` INT NULL,
  `discount` DECIMAL NULL,
  `campaign_id` INT NULL,
  PRIMARY KEY (`calculation_id`),
  INDEX `fk_calculation_1_idx` (`campaign_id` ASC),
  CONSTRAINT `fk_calculation_1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`campaign_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `links`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `links` ;

CREATE TABLE IF NOT EXISTS `links` (
  `links_id` INT NOT NULL AUTO_INCREMENT,
  `campaign_id` INT NULL,
  `link` VARCHAR(45) NULL,
  PRIMARY KEY (`links_id`),
  INDEX `fk_links_1_idx` (`campaign_id` ASC),
  CONSTRAINT `fk_links_1`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`campaign_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `source`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `source` ;

CREATE TABLE IF NOT EXISTS `source` (
  `source_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`source_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `account` ;

CREATE TABLE IF NOT EXISTS `account` (
  `idaccount` INT NOT NULL AUTO_INCREMENT,
  `id_producer` INT NOT NULL,
  `account_name` VARCHAR(45) NULL,
  `campaign_id` INT NULL,
  PRIMARY KEY (`idaccount`),
  INDEX `fk_account_1_idx` (`id_producer` ASC),
  INDEX `fk_account_2_idx` (`campaign_id` ASC),
  CONSTRAINT `fk_account_1`
    FOREIGN KEY (`id_producer`)
    REFERENCES `producer` (`id_producer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_account_2`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`campaign_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reward`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reward` ;

CREATE TABLE IF NOT EXISTS `reward` (
  `reward_id` INT NOT NULL AUTO_INCREMENT,
  `image` VARCHAR(255) NULL,
  `details` VARCHAR(255) NULL,
  `expiration_date` DATETIME NULL,
  `quantity_remaining` INT NULL,
  `point_value` INT NULL,
  PRIMARY KEY (`reward_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reward`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reward` ;

CREATE TABLE IF NOT EXISTS `reward` (
  `reward_id` INT NOT NULL AUTO_INCREMENT,
  `image` VARCHAR(255) NULL,
  `details` VARCHAR(255) NULL,
  `expiration_date` DATETIME NULL,
  `quantity_remaining` INT NULL,
  `point_value` INT NULL,
  PRIMARY KEY (`reward_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `source`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `source` ;

CREATE TABLE IF NOT EXISTS `source` (
  `source_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`source_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `donation_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `donation_type` ;

CREATE TABLE IF NOT EXISTS `donation_type` (
  `donationtype_id` INT NOT NULL AUTO_INCREMENT,
  `donation_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`donationtype_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `donations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `donations` ;

CREATE TABLE IF NOT EXISTS `donations` (
  `donation_id` INT NOT NULL AUTO_INCREMENT,
  `campaign_id` INT NULL,
  `donationtype_id` INT NULL,
  INDEX `campaign_id_idx` (`campaign_id` ASC),
  PRIMARY KEY (`donation_id`),
  INDEX `fk_donationtype_id_idx` (`donationtype_id` ASC),
  CONSTRAINT `campaign_id`
    FOREIGN KEY (`campaign_id`)
    REFERENCES `campaign` (`campaign_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_donationtype_id`
    FOREIGN KEY (`donationtype_id`)
    REFERENCES `donation_type` (`donationtype_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reward_claimed`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reward_claimed` ;

CREATE TABLE IF NOT EXISTS `reward_claimed` (
  `id_supporter` INT NOT NULL,
  `reward_id` INT NOT NULL,
  `date_claimed` DATETIME NULL,
  PRIMARY KEY (`id_supporter`, `reward_id`),
  INDEX `fk_reward_claimed_reward1_idx` (`reward_id` ASC),
  CONSTRAINT `id_supporter`
    FOREIGN KEY (`id_supporter`)
    REFERENCES `supporter` (`id_supporter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `reward_id`
    FOREIGN KEY (`reward_id`)
    REFERENCES `reward` (`reward_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
