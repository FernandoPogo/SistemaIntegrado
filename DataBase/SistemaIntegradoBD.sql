/*==============================================================*/
/*            SISTEMA INTEGRADO DE APRENDIZAJE                  */
/* Descripcion:                                   */
/* Autores:                        */
/*==============================================================*/

USE test;
DROP SCHEMA IF EXISTS SistemaIntegrado;
CREATE SCHEMA SistemaIntegrado;
USE SistemaIntegrado;

/*==============================================================*/
/* Creación de Tablas                                           */
/*==============================================================*/

/*==============================================================*/
/* Facultad                                                     */
/*==============================================================*/

CREATE TABLE Facultad
(
  CodigoFacultad INT NOT NULL AUTO_INCREMENT,
  NombreFacultad VARCHAR(50) NOT NULL UNIQUE,
  CONSTRAINT Facultad_pk PRIMARY KEY (CodigoFacultad)
);

/*==============================================================*/
/* Seccion                                                      */
/*==============================================================*/

CREATE TABLE Seccion
(
  CodigoSeccion INT NOT NULL AUTO_INCREMENT,
  NombreSeccion VARCHAR(50) NOT NULL UNIQUE,
  TipoSeccion VARCHAR(50) NOT NULL,
  CodigoFacultad INT,
  CONSTRAINT Seccion_pk PRIMARY KEY (CodigoSeccion),
  CHECK (TipoSeccion IN ('Departamento','Carrera'))
);
CREATE INDEX Pertenece ON Seccion (CodigoFacultad);

/*==============================================================*/
/* Usuario                                                      */
/*==============================================================*/

CREATE TABLE Usuario
(
  CodigoUsuario INT NOT NULL AUTO_INCREMENT,
  CorreoElectronicoUsuario VARCHAR(50) UNIQUE,
  NombresUsuario VARCHAR(50),
  ApellidosUsuario VARCHAR(50),
  NombreUsuario VARCHAR(50) UNIQUE,
  PasswordUsuario VARCHAR(255),
  EstadoUsuario BOOL,
  TipoUsuario VARCHAR(20),
  ImagenUsuario BLOB,
  CodigoSeccion INT,
  CONSTRAINT Usuario_pk PRIMARY KEY (CodigoUsuario),
  CHECK (TipoUsuario IN ('Administrador','Profesor','Estudiante'))
);
CREATE INDEX EsParteDe ON Usuario (CodigoSeccion);

/*==============================================================*/
/* Objeto Aprendizaje                                           */
/*==============================================================*/

CREATE TABLE ObjetoAprendizaje
(
  CodigoObjetoAprendizaje INT NOT NULL AUTO_INCREMENT,
  NombreObjetoAprendizaje VARCHAR(50),
  DescripcionObjetoAprendizaje VARCHAR(200),
  ArchivoObjetoAprendizaje BLOB,
  FechaCreacionObjetoAprendizaje DATE,
  EstadoObjetoAprendizaje BOOL,
  CodigoUsuario INT,
  CodigoMateria INT,
  CONSTRAINT ObjetoAprendizaje_pk PRIMARY KEY (CodigoObjetoAprendizaje)
);
CREATE INDEX RealizadoPor ON ObjetoAprendizaje (CodigoUsuario);
CREATE INDEX ObjetoAprendizajeDE ON ObjetoAprendizaje (CodigoMateria);

/*==============================================================*/
/* Comentario                                                   */
/*==============================================================*/

CREATE TABLE Comentario
(
  CodigoComentario INT NOT NULL AUTO_INCREMENT,
  Comentario BLOB,
  FK_CodigoComentario INT,
  CodigoObjetoAprendizaje INT,
  CodigoUsuario INT,
  CONSTRAINT Comentario_pk PRIMARY KEY (CodigoComentario)
);
CREATE INDEX ReferenciaA ON Comentario (FK_CodigoComentario);
CREATE INDEX PerteneceA ON Comentario (CodigoObjetoAprendizaje);
CREATE INDEX EscritoPor ON Comentario (CodigoUsuario);

/*==============================================================*/
/* Calificación                                                 */
/*==============================================================*/

CREATE TABLE Calificacion
(
  CodigoCalificacion INT NOT NULL AUTO_INCREMENT,
  Calificacion INT,
  CodigoObjetoAprendizaje INT,
  CodigoUsuario INT,
  CONSTRAINT Calificacion_pk PRIMARY KEY (CodigoCalificacion),
  CHECK (Calificacion >=0),
  CHECK (Calificacion <=5)
);
CREATE INDEX Perteneciente ON Calificacion (CodigoObjetoAprendizaje);
CREATE INDEX CalificadoPro ON Calificacion (CodigoUsuario);

/*==============================================================*/
/* Foro                                                         */
/*==============================================================*/

CREATE TABLE Foro
(
  CodigoForo INT NOT NULL AUTO_INCREMENT,
  NombreForo VARCHAR(50),
  DescripcionForo VARCHAR(200),
  FechaCreacionForo DATE,
  CodigoUsuario INT,
  CodigoMateria INT,
  CONSTRAINT Foro_pk PRIMARY KEY (CodigoForo)
);
CREATE INDEX CreadoPor ON Foro (CodigoUsuario);
CREATE INDEX ForoDe ON Foro(CodigoMateria);

/*==============================================================*/
/* Opinion                                                      */
/*==============================================================*/

CREATE TABLE Opinion
(
  CodigoOpinion INT NOT NULL AUTO_INCREMENT,
  Opinion BLOB,
  FK_CodigoOpinion INT,
  CodigoForo INT,
  CodigoUsuario INT,
  CONSTRAINT Opinion_pk PRIMARY KEY (CodigoOpinion)
);
CREATE INDEX RespuestaA ON Opinion (FK_CodigoOpinion);
CREATE INDEX OpinionDe ON Opinion (CodigoForo);
CREATE INDEX CriterioDe ON Opinion (CodigoUsuario);

/*==============================================================*/
/* Materia                                                      */
/*==============================================================*/

CREATE TABLE Materia
(
  CodigoMateria INT NOT NULL AUTO_INCREMENT,
  NombreMateria VARCHAR(50) UNIQUE,
  CONSTRAINT Materia_pk PRIMARY KEY (CodigoMateria)
);

/*==============================================================*/
/* FKs                                                       */
/*==============================================================*/

ALTER TABLE Seccion ADD CONSTRAINT Pertenece FOREIGN KEY (CodigoFacultad) REFERENCES Facultad (CodigoFacultad) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Usuario ADD CONSTRAINT EsParteDe FOREIGN KEY (CodigoSeccion) REFERENCES Seccion (CodigoSeccion) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE ObjetoAprendizaje ADD CONSTRAINT RealizadoPor FOREIGN KEY (CodigoUsuario) REFERENCES Usuario (CodigoUsuario) ON DELETE NO ACTION ON UPDATE NO ACTION; 
ALTER TABLE Calificacion ADD CONSTRAINT Perteneciente FOREIGN KEY (CodigoObjetoAprendizaje) REFERENCES ObjetoAprendizaje (CodigoObjetoAprendizaje) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Calificacion ADD CONSTRAINT CalificadoPor FOREIGN KEY (CodigoUsuario) REFERENCES Usuario (CodigoUsuario) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Foro ADD CONSTRAINT CreadoPor FOREIGN KEY (CodigoUsuario) REFERENCES Usuario (CodigoUsuario) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Comentario ADD CONSTRAINT ReferenciaA FOREIGN KEY (FK_CodigoComentario) REFERENCES Comentario (CodigoComentario) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Comentario ADD CONSTRAINT PerteneceA FOREIGN KEY (CodigoObjetoAprendizaje) REFERENCES ObjetoAprendizaje (CodigoObjetoAprendizaje) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Comentario ADD CONSTRAINT EscritoPor FOREIGN KEY (CodigoUsuario) REFERENCES Usuario (CodigoUsuario) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Opinion ADD CONSTRAINT RespuestaA FOREIGN KEY (FK_CodigoOpinion) REFERENCES Opinion (CodigoOpinion) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Opinion ADD CONSTRAINT OpinionDe FOREIGN KEY (CodigoForo) REFERENCES Foro (CodigoForo) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Opinion ADD CONSTRAINT CriterioDe FOREIGN KEY (CodigoUsuario) REFERENCES Usuario (CodigoUsuario) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Foro ADD CONSTRAINT ForoDe FOREIGN KEY (CodigoMateria) REFERENCES Materia (CodigoMateria) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE ObjetoAprendizaje ADD CONSTRAINT ObjetoAprendizajeDe FOREIGN KEY (CodigoMateria) REFERENCES Materia (CodigoMateria) ON DELETE NO ACTION ON UPDATE NO ACTION;

