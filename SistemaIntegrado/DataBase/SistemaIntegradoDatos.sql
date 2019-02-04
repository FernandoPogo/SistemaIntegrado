/*==============================================================*/
/*            SISTEMA INTEGRADO DE APRENDIZAJE                  */
/* Descripcion:                                   */
/* Autores:                        */
/*==============================================================*/

USE SistemaIntegrado;

/*==============================================================*/
/* Procedimientos Almacenados                                                          */
/*==============================================================*/


/*==============================================================*/
/* Facultades                                                   */
/*==============================================================*/

INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('1', 'Facultad de Ciencias');
INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('2', 'Facultad de Ciencias Administrativas');
INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('3', 'Facultad de Ing. Civil y Ambiental');
INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('4', 'Facultad de Ing. Electrica y Electronica');
INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('5', 'Facultad de Geologia y Petroleos');
INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('6', 'Facultad de Ing. Mecanica');
INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('7', 'Facultad Ing. Quimica y Agroindustria');
INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('8', 'Facultad de Ing. de Sistemas');
INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('9', 'Escuela de Formacion de Tecnologos');
INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('10', 'Otros');

/*==============================================================*/
/* Secciones                                                    */
/*==============================================================*/


INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('1', 'Fisica', 'Carrera', '1');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('2', 'Matematicas', 'Carrera', '1');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('3', 'Ingenieria Matematica', 'Carrera', '1');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('4', 'Ingenieria en Ciencias Economicas y Financieras', 'Carrera', '1');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('5', 'Maestria en Fisica', 'Carrera', '1');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('6', 'Ingenieria Empresarial', 'Carrera', '2');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('7', 'Ingenieria de la Produccion', 'Carrera', '2');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('8', 'Maestria en Sistemas de Gestion Integrados', 'Carrera', '2');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('9', 'Maestria en Gestion de Talento Humano', 'Carrera', '2');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('10', 'Ingenieria Civil', 'Carrera', '3');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('11', 'Ingenieria Ambiental', 'Carrera', '3');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('12', 'Ingenieria Electrica', 'Carrera', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('13', 'Ingenieria en Electronica y Control', 'Carrera', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('14', 'Ingenieria en Electronica y Redes de Informacion', 'Carrera', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('15', 'Ingenieria en Electronica y Telecomunicaciones', 'Carrera', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('16', 'Maestria en Ciencias de Ingenieria Electrica', 'Carrera', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('17', 'Maestria en Conectividad y Redes de Telecomunicaciones', 'Carrera', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('18', 'Maestria en Automatizacion y Control Electronico Industrial', 'Carrera', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('19', 'Maestria en Administracion de Negocios Electricos', 'Carrera', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('20', 'Maestria en Ingenieria Electrica en Distribucion', 'Carrera', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('21', 'Maestria en Redes Electricas Inteligentes', 'Carrera', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('22', 'Ingenieria en Geologia', 'Carrera', '5');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('23', 'Ingenieria en Petroleos', 'Carrera', '5');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('24', 'Ingenieria Mecanica', 'Carrera', '6');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('25', 'Maestria en Mecatronica y Robotica', 'Carrera', '6');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('26', 'Maestria en Sistemas Automotrices', 'Carrera', '6');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('27', 'Maestria en Disenio y Simulacion', 'Carrera', '6');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('28', 'Programa Doctoral en Ciencias de la Mecanica', 'Carrera', '6');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('29', 'Ingenieria Agroindustrial', 'Carrera', '7');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('30', 'Ingenieria Quimica', 'Carrera', '7');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('31', 'Ingenieria en Software', 'Carrera', '8');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('32', 'Ingenieria en Computacion', 'Carrera', '8');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('33', 'Ingenieria en sistemas informaticos y de computacion', 'Carrera', '8');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('34', 'Maestria y Especialista en Gestion de las Comunicaciones y Tecnologias de la Informacioón', 'Carrera', '8');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('35', 'Maestria en Ciencias de la Computacion', 'Carrera', '8');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('36', 'Maestria en Sistemas de Informacion', 'Carrera', '8');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('37', 'Doctorado en Informatica', 'Carrera', '8');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('38', 'Tecnologia en ELectronica y Telecomunicaciones', 'Carrera', '9');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('39', 'Tecnologia en Analisis de Sistemas', 'Carrera', '9');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('40', 'Tecnologia en Electromecanica', 'Carrera', '9');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('41', 'Tecnologia en Agua y Saneamiento', 'Carrera', '9');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('42', 'Departamento de Fisica (DF)', 'Departamento', '1');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('43', 'Departamento de Matematica (DM)', 'Departamento', '1');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('44', 'Departamento de Ciencias Administrativas (DEPCA)', 'Departamento', '2');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('45', 'Departamento de Estudios Organizacionales Desarrollo Humano (DESODEH)', 'Departamento', '2');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('46', 'Departamento de Ingenieria Civil y Ambiental (DICA)', 'Departamento', '3');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('47', 'Departamento de Automatizacion y Control Industrial (DACI)', 'Departamento', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('48', 'Departamento de Energia Electrica (DEE)', 'Departamento', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('49', 'Departamento de Electronica, Telecomunicaciones y Redes de Informacion (DETRI)', 'Departamento', '4');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('50', 'Departamento de Geologia (DG)', 'Departamento', '5');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('51', 'Departamento de Petroleos (DP)', 'Departamento', '5');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('52', 'Departamento de Ingenieria Mecanica (DIM)', 'Departamento', '6');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('53', 'Departamento de Materiales (DMT)', 'Departamento', '6');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('54', 'Departamento de Ingenieria Quimica (DIQ)', 'Departamento', '7');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('55', 'Departamento de Ciencias de Alimentos y Biotecnologia (DECAB)', 'Departamento', '7');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('56', 'Departamento de Ciencias Nucleares (DCN)', 'Departamento', '7');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('57', 'Departamento de Metalurgia Extractiva (DEMEX)', 'Departamento', '7');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('58', 'Departamento de Informatica y Ciencias de la Computacion (DICC)', 'Departamento', '8');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('59', 'Departamento de Formacion Basica (DFB)', 'Departamento', '10');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('60', 'Instituto Geofisico', 'Departamento', '10');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('61', 'Departamento de Ciencias Sociales', 'Departamento', '10');

/*==============================================================*/
/* Materias                                                     */
/*==============================================================*/

INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('1', 'Fisica');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('2', 'Algebra Lineal');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('3', 'Calculo');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('4', 'Probabilidad');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('5', 'Matematica');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('6', 'Quimica');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('7', 'Ecuaciones Diferenciales');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('8', 'Programacion');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('9', 'Sismologia');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('10', 'Metalurgia');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('11', 'Ecologia y Medio Ambiente');
INSERT INTO Materia (CodigoMateria, NombreMateria) VALUES ('12', 'Minerologia');

