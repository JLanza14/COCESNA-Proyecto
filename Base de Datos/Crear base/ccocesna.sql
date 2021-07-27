-- MySQL Script generated by MySQL Workbench
-- Mon Sep 30 00:04:36 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ccocesna
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `ccocesna` ;

-- -----------------------------------------------------
-- Schema ccocesna
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ccocesna` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `ccocesna` ;

-- -----------------------------------------------------
-- Table `ccocesna`.`personal1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`personal1` (
  `id_personal` INT(3) NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `apellidos` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `fecha_ingreso` DATE NOT NULL,
  `sexo` ENUM('M', 'F', '') CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `no_empleado` VARCHAR(10) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_personal`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`posicion1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`posicion1` (
  `id_posicion` INT(3) NOT NULL AUTO_INCREMENT,
  `posicion` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`id_posicion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`turnos1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`turnos1` (
  `id_turno` INT(3) NOT NULL AUTO_INCREMENT,
  `turno` VARCHAR(25) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_fin` TIME NOT NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_turno`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`user1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`user1` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `posicion_id_posicion` INT(3) NOT NULL,
  `personal_id_personal` INT(3) NOT NULL,
  `username` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `auth_key` VARCHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `password_hash` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `password_reset_token` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `status` SMALLINT(6) NOT NULL DEFAULT 10,
  `created_at` INT(11) NOT NULL,
  `updated_at` INT(11) NOT NULL,
  `verification_token` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_posicion1_idx` (`posicion_id_posicion` ASC) VISIBLE,
  INDEX `fk_user_personal1_idx` (`personal_id_personal` ASC) VISIBLE,
  CONSTRAINT `fk_user_posicion1`
    FOREIGN KEY (`posicion_id_posicion`)
    REFERENCES `ccocesna`.`posicion1` (`id_posicion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_personal1`
    FOREIGN KEY (`personal_id_personal`)
    REFERENCES `ccocesna`.`personal1` (`id_personal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`categoria_pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`categoria_pregunta` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nombre_cat` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `descripcion` VARCHAR(255) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`tipo_respuesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`tipo_respuesta` (
  `idTipoR` INT NOT NULL AUTO_INCREMENT,
  `respuesta` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NULL,
  `detalle_respuesta` VARCHAR(150) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NULL,
  PRIMARY KEY (`idTipoR`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`pregunta` (
  `id_pregunta` INT NOT NULL AUTO_INCREMENT,
  `pregunta` VARCHAR(200) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `tipo_respuesta_idTipoR` INT NOT NULL,
  `categorias_id_categoria` INT NOT NULL,
  PRIMARY KEY (`id_pregunta`, `tipo_respuesta_idTipoR`),
  INDEX `fk_preguntas_tipo_respuesta1_idx` (`tipo_respuesta_idTipoR` ASC) VISIBLE,
  INDEX `fk_preguntas_categorias_preguntas1_idx` (`categorias_id_categoria` ASC) VISIBLE,
  CONSTRAINT `fk_preguntas_tipo_respuesta1`
    FOREIGN KEY (`tipo_respuesta_idTipoR`)
    REFERENCES `ccocesna`.`tipo_respuesta` (`idTipoR`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_preguntas_categorias_preguntas1`
    FOREIGN KEY (`categorias_id_categoria`)
    REFERENCES `ccocesna`.`categoria_pregunta` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`tipo_accion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`tipo_accion` (
  `id_accion` INT NOT NULL AUTO_INCREMENT,
  `Accion` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`id_accion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`log_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`log_usuarios` (
  `id_logUsuarios` INT NOT NULL AUTO_INCREMENT,
  `tipo_accion_id_accion` INT NOT NULL,
  `user_id` INT(11) NOT NULL,
  `fecha_accion` DATE NULL,
  `detalle_anterior` VARCHAR(400) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NULL,
  `detalle_Nuevo` VARCHAR(400) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  PRIMARY KEY (`id_logUsuarios`, `tipo_accion_id_accion`),
  INDEX `fk_log_usuarios_user1_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_log_usuarios_tipo_accion1_idx` (`tipo_accion_id_accion` ASC) VISIBLE,
  CONSTRAINT `fk_log_usuarios_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `ccocesna`.`user1` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_usuarios_tipo_accion1`
    FOREIGN KEY (`tipo_accion_id_accion`)
    REFERENCES `ccocesna`.`tipo_accion` (`id_accion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`user_x_turnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`user_x_turnos` (
  `user_id` INT(11) NOT NULL,
  `turnos_id_turno` INT(3) NOT NULL,
  PRIMARY KEY (`user_id`, `turnos_id_turno`),
  INDEX `fk_user_has_turnos_turnos1_idx` (`turnos_id_turno` ASC) VISIBLE,
  INDEX `fk_user_has_turnos_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_has_turnos_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `ccocesna`.`user1` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_turnos_turnos1`
    FOREIGN KEY (`turnos_id_turno`)
    REFERENCES `ccocesna`.`turnos1` (`id_turno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`enviar_notificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`enviar_notificacion` (
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_enviar_notificacion_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `ccocesna`.`user1` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`pregunta_filtro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`pregunta_filtro` (
  `idFiltro` INT NOT NULL AUTO_INCREMENT,
  `pregunta_filtro` VARCHAR(150) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `tipo_respuesta_idTipoR` INT NULL,
  PRIMARY KEY (`idFiltro`),
  INDEX `fk_pregunta_filtro_tipo_respuesta1_idx` (`tipo_respuesta_idTipoR` ASC) VISIBLE,
  CONSTRAINT `fk_pregunta_filtro_tipo_respuesta1`
    FOREIGN KEY (`tipo_respuesta_idTipoR`)
    REFERENCES `ccocesna`.`tipo_respuesta` (`idTipoR`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`log_pregunta_filtro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`log_pregunta_filtro` (
  `user_id` INT(11) NOT NULL,
  `pregunta_filtro_idFiltro` INT NOT NULL,
  `respuesta` VARCHAR(45) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `fecha` DATETIME NOT NULL,
  PRIMARY KEY (`user_id`, `pregunta_filtro_idFiltro`),
  INDEX `fk_user_has_pregunta_filtro_pregunta_filtro1_idx` (`pregunta_filtro_idFiltro` ASC) VISIBLE,
  INDEX `fk_user_has_pregunta_filtro_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_has_pregunta_filtro_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `ccocesna`.`user1` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_pregunta_filtro_pregunta_filtro1`
    FOREIGN KEY (`pregunta_filtro_idFiltro`)
    REFERENCES `ccocesna`.`pregunta_filtro` (`idFiltro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`encuesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`encuesta` (
  `id_encuesta` INT NOT NULL AUTO_INCREMENT,
  `fecha_encuesta` DATE NULL,
  PRIMARY KEY (`id_encuesta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`log_encuestas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`log_encuestas` (
  `encuesta_id_encuesta` INT NOT NULL,
  `preguntas_id_pregunta` INT NOT NULL,
  `preguntas_tipo_respuesta_idTipoR` INT NOT NULL,
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`encuesta_id_encuesta`, `preguntas_id_pregunta`, `preguntas_tipo_respuesta_idTipoR`),
  INDEX `fk_encuesta_has_preguntas_preguntas1_idx` (`preguntas_id_pregunta` ASC, `preguntas_tipo_respuesta_idTipoR` ASC) VISIBLE,
  INDEX `fk_encuesta_has_preguntas_encuesta1_idx` (`encuesta_id_encuesta` ASC) VISIBLE,
  INDEX `fk_log_encuestas_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_encuesta_has_preguntas_encuesta1`
    FOREIGN KEY (`encuesta_id_encuesta`)
    REFERENCES `ccocesna`.`encuesta` (`id_encuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_encuesta_has_preguntas_preguntas1`
    FOREIGN KEY (`preguntas_id_pregunta` , `preguntas_tipo_respuesta_idTipoR`)
    REFERENCES `ccocesna`.`pregunta` (`id_pregunta` , `tipo_respuesta_idTipoR`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_encuestas_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `ccocesna`.`user1` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`personal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`personal` (
  `id_personal` INT(3) NOT NULL,
  `nombres` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `apellidos` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `fecha_ingreso` DATE NOT NULL,
  `sexo` ENUM('M', 'F', '') CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `no_empleado` VARCHAR(10) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 1)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`posicion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`posicion` (
  `id_posicion` INT(3) NOT NULL,
  `posicion` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`turnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`turnos` (
  `id_turno` INT(3) NOT NULL,
  `turno` VARCHAR(25) CHARACTER SET 'latin1' COLLATE 'latin1_spanish_ci' NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_fin` TIME NOT NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 1)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`user` (
  `id` INT(11) NOT NULL,
  `username` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `auth_key` VARCHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `password_hash` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `password_reset_token` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `status` SMALLINT(6) NOT NULL DEFAULT 10,
  `created_at` INT(11) NOT NULL,
  `updated_at` INT(11) NOT NULL,
  `verification_token` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccocesna`.`seglog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ccocesna`.`seglog` (
  `segLogKey` INT(11) NOT NULL AUTO_INCREMENT,
  `SegLogFecha` DATE NULL DEFAULT NULL,
  `SegLogHora` TIME NULL DEFAULT NULL,
  `SegUsrUsuario` VARCHAR(20) NULL DEFAULT NULL,
  `SegLogDetalle` MEDIUMTEXT NULL,
  `SegLogLlave` INT(11) NULL DEFAULT NULL,
  `SegLogTabla` VARCHAR(60) NULL DEFAULT NULL,
  `SegLogAccion` MEDIUMTEXT NULL,
  `SegLogComando` MEDIUMTEXT NULL,
  `SegLogIp` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`segLogKey`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;