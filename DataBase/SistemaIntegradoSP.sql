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
                                      IN	vi_ImagenUsuario BLOB,
                                      OUT	vo_Mensaje VARCHAR(100))
BEGIN
	INSERT
    INTO Usuario (CorreoElectronicoUsuario,NombresUsuario,ApellidosUsuario,NombreUsuario,PasswordUsuario,EstadoUsuario,TipoUsuario,ImagenUsuario)
    VALUES (vi_CorreoElectronicoUsuario,vi_NombresUsuario,vi_ApellidosUsuario,vi_NombreUsuario,vi_PasswordUsuario,1,vi_TipoUsuario,vi_ImagenUsuario);
    SET vo_Mensaje = CONCAT('Usuario "',vi_NombreUsuario,'" registrado exitosamente');
END//
DELIMITER ;

CALL sp_RegistrarUsuario ('fernandopogo961@live.com','Fernando Paul','Pogo Torres','fpogo1','12345','Administrador',null,@v_Mensaje);
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
							AND PasswordUsuario = vi_PasswordUsuario)
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

CALL sp_ObtenerSecciones ('Profesor');