#creacion de la base de datos para political_elections , trabajo final de Programacion Web

CREATE DATABASE political_elections; 


#Creacion de Tablas

CREATE TABLE `election` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100),
  `date` DATE,
  `status` BOOLEAN,
  PRIMARY KEY (`id`)
);

CREATE TABLE `citizen` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `identificationCard` VARCHAR(20),
  `firstname` VARCHAR(200),
  `lastname` VARCHAR(200),
  `email` VARCHAR(200),
  `status` BOOLEAN,
  PRIMARY KEY (`id`)
);

CREATE TABLE `result` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `candidate` INT,
  `election` INT,
  `citizen` INT,
  `electoralPosition` INT,
  PRIMARY KEY (`id`)
);

CREATE TABLE `politicalParty` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200),
  `description` VARCHAR(200),
  `logo` VARCHAR(200),
  `status` Boolean,
  PRIMARY KEY (`id`)
);

CREATE TABLE `electoralPosition` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200),
  `description` VARCHAR(200),
  `photo` VARCHAR(200),
  `status` BOOLEAN,
  PRIMARY KEY (`id`)
);

CREATE TABLE `candidate` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(200),
  `lastname` VARCHAR(200),
  `photo` VARCHAR(200),
  `status` BOOLEAN,
  `politicalParty` INT,
  `electoralPosition` INT,
  PRIMARY KEY (`id`)
);

CREATE TABLE `adminUser` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(200),
  `password` VARCHAR(200),
  `firstname` VARCHAR(200),
  `lastname` VARCHAR(200),
  `status` BOOLEAN,
  PRIMARY KEY (`id`)
);

# Relaciones (Foreign Keys)


ALTER TABLE `candidate` ADD CONSTRAINT `political_party` FOREIGN KEY (`politicalParty`) REFERENCES `politicalParty`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION; 
ALTER TABLE `candidate` ADD CONSTRAINT `electoral_position` FOREIGN KEY (`electoralPosition`) REFERENCES `electoralPosition`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION; 

ALTER TABLE `result` ADD CONSTRAINT `candidate_fk` FOREIGN KEY (`candidate`) REFERENCES `candidate`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION; 
ALTER TABLE `result` ADD CONSTRAINT `election_fk` FOREIGN KEY (`election`) REFERENCES `election`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION; 
ALTER TABLE `result` ADD CONSTRAINT `citizen_fk` FOREIGN KEY (`citizen`) REFERENCES `citizen`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION; 
ALTER TABLE `result` ADD CONSTRAINT `electoral_position_fk` FOREIGN KEY (`electoralPosition`) REFERENCES `electoralPosition`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


# Inserts

INSERT INTO `adminUser` (`id`, `username`, `password`, `firstname`, `lastname`, `status`) VALUES (NULL, 'admin', 'admin', 'Miguel Angel', 'Peña Santos', '1');

INSERT INTO `politicalParty` (`id`, `name`, `description`, `logo`, `status`) VALUES 
(1, 'PLD', 'Partido de la Liberacion Dominicana', 'pld.png', '1'), 
(2, 'PRM', 'Partido Revolucionario Moderno', 'prm.png', '1'), 
(3, 'FP', 'Fuerza del Pueblo', 'fp.png', '1');

INSERT INTO `citizen` (`id`, `identificationCard`, `firstname`, `lastname`, `email`, `status`) VALUES 
(1, '000-0000000-0', 'Jose Enriquez', 'Polanco', 'test1@email.com', '1'), 
(2, '111-1111111-1', 'Victor', 'Gomez', 'test2@email.com', '1'), 
(3, '333-3333333-3', 'Ernesto Mejia', 'Gonzales Gonzales', 'test3@email.com', '1');

INSERT INTO `electoralPosition` (`id`, `name`, `description`,`photo`, `status`) VALUES
(1, 'Presidente', 'El que posee la mayor autoridad en una nacion','1.jpg', '1'), 
(2, 'Alcalde', 'Se encuentra al frente de la administración política de una ciudad, municipio o pueblo.','2.jpg', '1'), 
(3, 'Senador', 'Es un miembro o integrante de la Cámara de Senadores o Senado.​','3.jpg', '1'), 
(4, 'Diputado', 'Es el nombre que recibe una persona nombrada por elección como representante en una Cámara de Diputados','4.jpeg', '1');

INSERT INTO `candidate` (`id`, `firstname`, `lastname`, `photo`, `status`, `politicalParty`, `electoralPosition`) VALUES 
('1', 'Luis Rodolfo', 'Abinader Corona', '1.jpg', '1', '2', '1'), 
('2', 'Gonzalo', 'Castillo Terrero', '2.jpeg', '1', '1', '1'), 
('3', 'Leonel Maria', 'Fernandez Reyna', '3.jpeg', '1', '3', '1');





