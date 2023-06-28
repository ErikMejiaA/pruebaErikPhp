CREATE DATABASE campuslands;
USE campuslands;

CREATE TABLE pais (
	idPais INT NOT NULL UNIQUE AUTO_INCREMENT,
	nombrePais VARCHAR(50),
	CONSTRAINT PK_IdPais PRIMARY KEY (idPais)
);

CREATE TABLE departamento (
	idDep INT NOT NULL UNIQUE AUTO_INCREMENT,
	nombreDep VARCHAR(50),
	idPais INT(11),
	CONSTRAINT PK_IdDep PRIMARY KEY (idDep),
	CONSTRAINT FK_PaisDepartamento FOREIGN KEY (idPais) REFERENCES pais(idPais)
);

CREATE TABLE region (
	idReg INT NOT NULL UNIQUE AUTO_INCREMENT,
	nombreReg VARCHAR(50),
	idDep INT(11),
	CONSTRAINT PK_IdReg PRIMARY KEY (idReg),
	CONSTRAINT FK_DepartamentoRegion FOREIGN KEY (idDep) REFERENCES departamento(idDep)
);

CREATE TABLE campers (
	idCamper VARCHAR(20) NOT NULL UNIQUE,
	nombreCamper VARCHAR(50) NOT NULL,
	apellidoCamper VARCHAR(50) NOT NULL,
	fechaNac DATE NOT NULL,
	idReg INT(11),
	CONSTRAINT PK_IdCamper PRIMARY KEY (idCamper),
	CONSTRAINT FK_RegionCamper FOREIGN KEY (idReg) REFERENCES region(idReg)
);

INSERT INTO pais(nombrePais) VALUES('Colombia');
INSERT INTO pais(nombrePais) VALUES('Ecuador');
INSERT INTO pais(nombrePais) VALUES('Venezuela');
INSERT INTO pais(nombrePais) VALUES('Chile');
INSERT INTO pais(nombrePais) VALUES('Panama');

INSERT INTO departamento(nombreDep, idPais) VALUES('Santander', 1);
INSERT INTO departamento(nombreDep, idPais) VALUES('Norte Santander', 1);
INSERT INTO departamento(nombreDep, idPais) VALUES('Amazonas', 1);
INSERT INTO departamento(nombreDep, idPais) VALUES('Cauca', 1);
INSERT INTO departamento(nombreDep, idPais) VALUES('Nariño', 1);
INSERT INTO departamento(nombreDep, idPais) VALUES('Boyaca', 1);

INSERT INTO region(nombreReg, idDep) VALUES('Bucaramanga', 1);
INSERT INTO region(nombreReg, idDep) VALUES('Florida Blanca', 1);
INSERT INTO region(nombreReg, idDep) VALUES('Piedecuesta', 1);
INSERT INTO region(nombreReg, idDep) VALUES('leticia', 3);
INSERT INTO region(nombreReg, idDep) VALUES('Tunja', 6);
