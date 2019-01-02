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
/* RegistrarUsuario                                  */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_RegistrarUsuario;
DELIMITER //
CREATE PROCEDURE sp_RegistrarUsuario (IN	vi_CorreoElectronicoUsuario VARCHAR(50),
									  IN	vi_NombresUsuario VARCHAR(50), 
									  IN	vi_ApellidosUsuario VARCHAR(50),
									  IN	vi_NombreUsuario VARCHAR(50),
                                      IN	vi_PasswordUsuario VARCHAR(50),
                                      IN	vi_TipoUsuario VARCHAR(50),
                                      IN	vi_SeccionUsuario VARCHAR(60),
                                      OUT	vo_Mensaje VARCHAR(100))
BEGIN
	DECLARE var_CodigoSeccion INT;
    SELECT CodigoSeccion INTO var_CodigoSeccion
    FROM Seccion
    WHERE NombreSeccion = vi_SeccionUsuario;
    
	INSERT
    INTO Usuario (CorreoElectronicoUsuario,NombresUsuario,ApellidosUsuario,NombreUsuario,PasswordUsuario,EstadoUsuario,TipoUsuario,ImagenUsuario,CodigoSeccion)
    VALUES (vi_CorreoElectronicoUsuario,vi_NombresUsuario,vi_ApellidosUsuario,vi_NombreUsuario,AES_ENCRYPT(vi_PasswordUsuario,'SistemaIntegrado'),1,vi_TipoUsuario,null,var_CodigoSeccion);

    SET vo_Mensaje = CONCAT('Usuario "',vi_NombreUsuario,'" registrado exitosamente');
END//
DELIMITER ;

CALL sp_RegistrarUsuario ('sistemaintegrado@gmail.com','Administrador','Administrador','admin','admin','Administrador','Ingenieria en sistemas informaticos y de computacion',@v_Mensaje);
Select @v_Mensaje;
                                                                                           
   

/*==============================================================*/
/* VerificarUsuarioPassword                                     */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_VerificarUsuarioPassword;
DELIMITER //
CREATE PROCEDURE sp_VerificarUsuarioPassword   (IN 		vi_NombreUsuario VARCHAR(50), 
												IN		vi_PasswordUsuario VARCHAR(50),
												IN		vi_TipoUsuario VARCHAR(50),
                                                OUT		vo_Mensaje VARCHAR(100))
BEGIN
	IF EXISTS	(	SELECT *
					FROM Usuario
					WHERE NombreUsuario = vi_NombreUsuario
					AND TipoUsuario = vi_TipoUsuario
					AND EstadoUsuario = 0)
	THEN
      SET vo_Mensaje = 'El usuario se encuentra bloqueado';
	ELSEIF 	NOT EXISTS	(	SELECT *
							FROM Usuario
							WHERE NombreUsuario = vi_NombreUsuario
							AND TipoUsuario = vi_TipoUsuario
							AND PasswordUsuario = AES_ENCRYPT(vi_PasswordUsuario,'SistemaIntegrado'))
	THEN
		SET vo_Mensaje = 'Usuario o contraseña incorrectos';
    ELSE
      SET vo_Mensaje = vi_TipoUsuario;
    END IF;
END //
DELIMITER 

CALL sp_VerificarUsuarioPassword ('fpogo1','12345','Administrador',@v_Mensaje);
Select @v_Mensaje;

/*==============================================================*/
/* ObtenerSecciones                                             */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ObtenerSecciones;
DELIMITER //
CREATE PROCEDURE sp_ObtenerSecciones		   (IN 		vi_TipoUsuario VARCHAR(50))
BEGIN
  IF (vi_TipoUsuario LIKE 'Profesor')
  THEN 
	SELECT s.NombreSeccion, f.NombreFacultad
    FROM Seccion AS s, Facultad AS f
    WHERE s.CodigoSeccion = f.CodigoFacultad
    AND s.TipoSeccion LIKE 'Departamento';
  ELSE 
	SELECT s.NombreSeccion, f.NombreFacultad
    FROM Seccion AS s, Facultad AS f
    WHERE s.CodigoSeccion = f.CodigoFacultad
    AND s.TipoSeccion LIKE 'Carrera';
  END IF;
END //
DELIMITER 

INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('1', 'Sistemas');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('1', 'Ingenieria en sistemas informaticos y de computacion', 'Carrera', '1');

INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('2', 'Mecanica');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('2', 'Ingenieria mecanica', 'Carrera', '2');

INSERT INTO Facultad (CodigoFacultad, NombreFacultad) VALUES ('3', 'Ambiental');
INSERT INTO Seccion (CodigoSeccion, NombreSeccion, TipoSeccion, CodigoFacultad) VALUES ('3', 'Ingenieria ambiental', 'Carrera', '3');

CALL sp_ObtenerSecciones ('Estudiante');
