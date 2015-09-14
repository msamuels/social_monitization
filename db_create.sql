SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Table `producer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `producer` (
  `id_producer` INT NOT NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `org_name` VARCHAR(255) NULL,
  `organization_url` VARCHAR(255) NULL,
  `email_address` VARCHAR(255) NULL,
  `user_name` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  PRIMARY KEY (`id_producer`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `producer_account`
-- -----------------------------------------------------
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
CREATE TABLE IF NOT EXISTS `supporter` (
  `id_supporter` INT NOT NULL,
  `id_follower_count` INT NULL,
  `interests` VARCHAR(45) NULL,
  `email_address` VARCHAR(45) NULL,
  `approved` ENUM('Y','N') NULL,
  PRIMARY KEY (`id_supporter`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campaign`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `campaign` (
  `campaign_id` INT NOT NULL,
  `budget` FLOAT NULL,
  `billing_approved` ENUM('Y','N') NULL,
  `estimate` FLOAT NULL,
  `start_date` DATETIME NULL,
  `end_date` DATETIME NULL,
  `approved` ENUM('Y','N') NULL,
  `screen_shot` VARCHAR(45) NULL,
  `campaign_name` VARCHAR(255) NULL,
  PRIMARY KEY (`campaign_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `supporter_interest`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `supporter_interest` (
  `supporter_interest_if` INT NOT NULL,
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
CREATE TABLE IF NOT EXISTS `campaign_response` (
  `campaign_response_id` INT NOT NULL,
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
CREATE TABLE IF NOT EXISTS `follower_count` (
  `follower_count_id` INT NOT NULL,
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
CREATE TABLE IF NOT EXISTS `tags` (
  `id_tag` INT NOT NULL,
  `tag_name` INT NULL,
  PRIMARY KEY (`id_tag`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `escrow`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `escrow` (
  `escrow_id` INT NOT NULL,
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
CREATE TABLE IF NOT EXISTS `screen_shots` (
  `screen_shots_id` INT NOT NULL,
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
CREATE TABLE IF NOT EXISTS `targeting` (
  `tag_id` INT NOT NULL,
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
CREATE TABLE IF NOT EXISTS `calculation` (
  `calculation_id` INT NOT NULL,
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
CREATE TABLE IF NOT EXISTS `links` (
  `links_id` INT NOT NULL,
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
CREATE TABLE IF NOT EXISTS `source` (
  `id_source` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `url` VARCHAR(45) NULL,
  PRIMARY KEY (`id_source`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `account` (
  `idaccount` INT NOT NULL,
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
