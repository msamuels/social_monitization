USE social_monitization;

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `idaccount` int(11) NOT NULL AUTO_INCREMENT,
  `id_producer` int(11) NOT NULL,
  `account_name` varchar(45) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idaccount`),
  KEY `fk_account_1_idx` (`id_producer`),
  KEY `fk_account_2_idx` (`campaign_id`),
  CONSTRAINT `fk_account_1` FOREIGN KEY (`id_producer`) REFERENCES `producers` (`id_producer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_account_2` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) AUTO_INCREMENT=21 DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `calculation`
--

DROP TABLE IF EXISTS `calculation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calculation` (
  `calculation_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) DEFAULT NULL,
  `cpm` int(11) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`calculation_id`),
  KEY `fk_calculation_1_idx` (`campaign_id`),
  CONSTRAINT `fk_calculation_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `campaign_responses`
--

DROP TABLE IF EXISTS `campaign_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_responses` (
  `campaign_response_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `supporter_id` int(11) DEFAULT NULL,
  `campaign_response` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`campaign_response_id`),
  KEY `fk_campaign_response_1_idx` (`campaign_id`),
  CONSTRAINT `fk_campaign_response_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaigns` (
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_name` varchar(255) DEFAULT NULL,
  `budget` float DEFAULT NULL,
  `billing_approved` enum('Y','N') DEFAULT NULL,
  `estimate` float DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT NULL,
  `screen_shot` varchar(45) DEFAULT NULL,
  `copy` varchar(45) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`campaign_id`)
) AUTO_INCREMENT=23 DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `donation_type`
--

DROP TABLE IF EXISTS `donation_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donation_type` (
  `donationtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `donation_name` varchar(45) NOT NULL,
  PRIMARY KEY (`donationtype_id`)
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `donationtype_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`donation_id`),
  KEY `campaign_id_idx` (`campaign_id`),
  KEY `fk_donationtype_id_idx` (`donationtype_id`),
  CONSTRAINT `campaign_id` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_donationtype_id` FOREIGN KEY (`donationtype_id`) REFERENCES `donation_type` (`donationtype_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `escrow`
--

DROP TABLE IF EXISTS `escrow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `escrow` (
  `escrow_id` int(11) NOT NULL AUTO_INCREMENT,
  `estimate` double DEFAULT NULL,
  `actual` double DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`escrow_id`),
  KEY `fk_escrow_1_idx` (`campaign_id`),
  CONSTRAINT `fk_escrow_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `follower_count`
--

DROP TABLE IF EXISTS `follower_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follower_count` (
  `follower_count_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `supporter_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`follower_count_id`),
  KEY `fk_follower_count_1_idx` (`supporter_id`),
  CONSTRAINT `fk_follower_count_1` FOREIGN KEY (`supporter_id`) REFERENCES `supporters` (`id_supporter`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `links_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`links_id`),
  KEY `fk_links_1_idx` (`campaign_id`),
  CONSTRAINT `fk_links_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `org class`
--

DROP TABLE IF EXISTS `org class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org class` (
  `orgclass_id` int(11) NOT NULL AUTO_INCREMENT,
  `classname` varchar(45) NOT NULL,
  PRIMARY KEY (`orgclass_id`)
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `producer_account`
--

DROP TABLE IF EXISTS `producer_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producer_account` (
  `producer_id` int(11) NOT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `account_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`producer_id`),
  CONSTRAINT `fk_producer_account_id` FOREIGN KEY (`producer_id`) REFERENCES `producers` (`id_producer`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `producers`
--

DROP TABLE IF EXISTS `producers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producers` (
  `id_producer` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `organization_url` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `description` blob,
  `country` varchar(255) DEFAULT NULL,
  `orgclass_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producer`),
  KEY `orgclass_id_idx` (`orgclass_id`),
  CONSTRAINT `orgclass_id` FOREIGN KEY (`orgclass_id`) REFERENCES `org class` (`orgclass_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) AUTO_INCREMENT=4 DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reward_claimed`
--

DROP TABLE IF EXISTS `reward_claimed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reward_claimed` (
  `id_supporter` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `date_claimed` datetime DEFAULT NULL,
  PRIMARY KEY (`id_supporter`,`reward_id`),
  KEY `fk_reward_claimed_reward1_idx` (`reward_id`),
  CONSTRAINT `id_supporter` FOREIGN KEY (`id_supporter`) REFERENCES `supporters` (`id_supporter`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reward_id` FOREIGN KEY (`reward_id`) REFERENCES `rewards` (`reward_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rewards`
--

DROP TABLE IF EXISTS `rewards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rewards` (
  `reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `reward_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `quantity_remaining` int(11) DEFAULT NULL,
  `point_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`reward_id`)
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `screen_shots`
--

DROP TABLE IF EXISTS `screen_shots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `screen_shots` (
  `screen_shots_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT NULL,
  `id_supporter` int(11) DEFAULT NULL,
  PRIMARY KEY (`screen_shots_id`),
  KEY `fk_screen_shots_1_idx` (`campaign_id`),
  CONSTRAINT `fk_screen_shots_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `source`
--

DROP TABLE IF EXISTS `source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `source` (
  `source_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`source_id`)
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `supporter_interest`
--

DROP TABLE IF EXISTS `supporter_interest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supporter_interest` (
  `supporter_interest_if` int(11) NOT NULL AUTO_INCREMENT,
  `supporter_id` int(11) DEFAULT NULL,
  `id_interest` int(11) DEFAULT NULL,
  PRIMARY KEY (`supporter_interest_if`),
  KEY `fk_supporter_interest_1_idx` (`supporter_id`),
  CONSTRAINT `fk_supporter_interest_1` FOREIGN KEY (`supporter_id`) REFERENCES `supporters` (`id_supporter`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `supporters`
--

DROP TABLE IF EXISTS `supporters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supporters` (
  `id_supporter` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_follower_count` int(11) DEFAULT NULL,
  `interests` varchar(45) DEFAULT NULL,
  `email_address` varchar(45) DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_supporter`)
) AUTO_INCREMENT=2 DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id_tag` int(11) NOT NULL,
  `tag_name` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tag`)
) DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `targeting`
--

DROP TABLE IF EXISTS `targeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `targeting` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `fk_targeting_1_idx` (`campaign_id`),
  CONSTRAINT `fk_targeting_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) DEFAULT CHARSET=big5;

