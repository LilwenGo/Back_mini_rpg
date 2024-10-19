/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�atiON :  19/10/2024 12:53:59                      */
/*==============================================================*/


DROP TABLE IF EXISTS `inventory`;

DROP TABLE IF EXISTS `entity`;

DROP TABLE IF EXISTS `player`;

DROP TABLE IF EXISTS `type`;

/*==============================================================*/
/* TABLE : player                                               */
/*==============================================================*/
CREATE TABLE `player`
(
   id                   VARCHAR(13) NOT NULL,
   username             VARCHAR(50) UNIQUE NOT NULL,
   password             VARCHAR(255) NOT NULL,
   PRIMARY KEY (id)
)ENGINE = InnoDB;

/*==============================================================*/
/* TABLE : type                                                 */
/*==============================================================*/
CREATE TABLE `type`
(
   id                   INT NOT NULL AUTO_INCREMENT,
   name                 VARCHAR(50) NOT NULL,
   PRIMARY KEY (id)
)ENGINE = InnoDB;

/*==============================================================*/
/* TABLE : entity                                               */
/*==============================================================*/
CREATE TABLE `entity`
(
   id                   INT NOT NULL AUTO_INCREMENT,
   id_player            VARCHAR(13) NOT NULL,
   id_type              INT NOT NULL,
   name                 VARCHAR(50) NOT NULL,
   data                 JSON NOT NULL,
   PRIMARY KEY (id)
)ENGINE = InnoDB;

/*==============================================================*/
/* TABLE : inventory                                            */
/*==============================================================*/
CREATE TABLE `inventory`
(
   id_entity            INT NOT NULL,
   id_player            VARCHAR(13) NOT NULL,
   count                INT NOT NULL,
   PRIMARY KEY (id_entity, id_player)
)ENGINE = InnoDB;

ALTER TABLE `entity` ADD CONSTRAINT Fk_create FOREIGN KEY (id_player)
      REFERENCES `player` (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `entity` ADD CONSTRAINT Fk_define FOREIGN KEY (id_type)
      REFERENCES `type` (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `inventory` ADD CONSTRAINT Fk_inventory FOREIGN KEY (id_player)
      REFERENCES `player` (id) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `inventory` ADD CONSTRAINT Fk_inventory2 FOREIGN KEY (id_entity)
      REFERENCES `entity` (id) ON DELETE CASCADE ON UPDATE RESTRICT;