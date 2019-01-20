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
/* ObtenerDatosColaborador                                      */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ObtenerDatosColaborador;
DELIMITER //
CREATE PROCEDURE sp_ObtenerDatosColaborador (	IN	vi_NombreUsuario VARCHAR(50))
BEGIN
  SELECT u.NombresUsuario, u.ApellidosUsuario, CorreoElectronicoUsuario
  FROM Usuario AS u
  WHERE u.NombreUsuario = vi_NombreUsuario;
END//
DELIMITER ;

/*CALL sp_ObtenerDatosColaborador('carolg');*/

/*==============================================================*/
/* RegistrarColaborador                                         */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_RegistrarColaborador;
DELIMITER //
CREATE PROCEDURE sp_RegistrarColaborador (	IN	vi_NombreUsuario VARCHAR(50),
											IN	vi_CedulaColaborador VARCHAR(10),
                                            IN	vi_FechaNacimientoColaborador DATE,
                                            IN	vi_DireccionColaborador TEXT,
                                            IN	vi_TelefonoColaborador	VARCHAR(10),
                                            IN	vi_SexoColaborador VARCHAR(10),
                                            IN	vi_FotoColaborador TEXT)
BEGIN
  DECLARE var_CodigoUsuario INT;
  
  SELECT CodigoUsuario INTO var_CodigoUsuario
  FROM Usuario AS u
  WHERE u.NombreUsuario = vi_NOmbreUsuario;

  INSERT
  INTO Colaborador (CedulaColaborador, FechaNacimientoColaborador, DireccionColaborador, TelefonoColaborador, SexoColaborador, ImagenColaborador, EstadoColaborador, CodigoUsuario)
  VALUES (vi_CedulaColaborador, vi_FechaNacimientoColaborador, vi_DireccionColaborador, vi_TelefonoColaborador, vi_SexoColaborador, vi_FotoColaborador,1,var_CodigoUsuario);
END//
DELIMITER ;

/*CALL sp_RegistrarColaborador('Usuario','CEDULA','FECHANACIMIENTO','DIRECCION','TELEFONO','SEXO','IMAGEN');*/

/*==============================================================*/
/* ColaboradorNuevo                                         */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ColaboradorNuevo;
DELIMITER //
CREATE PROCEDURE sp_ColaboradorNuevo (	IN	vi_NombreUsuario VARCHAR(50),
										OUT		vo_Mensaje VARCHAR(100))
BEGIN
  IF EXISTS	(	SELECT *
				FROM Usuario AS u, Colaborador AS c
				WHERE c.CodigoUsuario = u.CodigoUsuario
                AND u.NombreUsuario = vi_NombreUsuario)
	THEN
      SET vo_Mensaje = 'Colaborador';
  ELSEIF EXISTS	(	SELECT *
				        FROM Usuario AS u, ObjetoAprendizaje AS oa
				        WHERE oa.CodigoUsuario = u.CodigoUsuario
                        AND u.NombreUsuario = vi_NombreUsuario)
    THEN	
	  SET vo_Mensaje = 'Nuevo Colaborador';
  ELSE
      SET vo_Mensaje = 'No Colaborador';
  END IF;
END//
DELIMITER ;

/*CALL sp_ColaboradorNuevo('fpogo', @v_Mensaje);
Select @v_Mensaje;*/


/*==============================================================*/
/* ObtenerDatosColaboradorCompleto                              */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ObtenerDatosColaboradorCompleto;
DELIMITER //
CREATE PROCEDURE sp_ObtenerDatosColaboradorCompleto (	IN	vi_NombreUsuario VARCHAR(50))
BEGIN
  SELECT c.CedulaColaborador, c.FechaNacimientoColaborador, u.NombresUsuario, u.ApellidosUsuario, CorreoElectronicoUsuario, c.DireccionColaborador, c.TelefonoColaborador, c.SexoColaborador, c.EstadoColaborador, c.ImagenColaborador 
  FROM Usuario AS u, Colaborador AS c
  WHERE u.NombreUsuario = vi_NombreUsuario
  AND c.CodigoUsuario = u.CodigoUsuario;
END//
DELIMITER ;

/*CALL sp_ObtenerDatosColaboradorCompleto('carolg');*/

/*==============================================================*/
/* ModificarColaborador                                         */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ModificarColaborador;
DELIMITER //
CREATE PROCEDURE sp_ModificarColaborador (	IN	vi_NombreUsuario VARCHAR(50),
											IN	vi_CedulaColaborador VARCHAR(10),
                                            IN	vi_FechaNacimientoColaborador DATE,
                                            IN	vi_DireccionColaborador TEXT,
                                            IN	vi_TelefonoColaborador	VARCHAR(10),
                                            IN	vi_SexoColaborador VARCHAR(10),
                                            IN  vi_EstadoColaborador VARCHAR(10),
                                            IN	vi_FotoColaborador TEXT)
BEGIN
  DECLARE var_CodigoUsuario INT;
  DECLARE var_EstadoColaborador INT;
  
  SELECT CodigoUsuario INTO var_CodigoUsuario
  FROM Usuario AS u
  WHERE u.NombreUsuario = vi_NOmbreUsuario;
  
  IF (vi_EstadoColaborador LIKE 'Visible')
  THEN
    SET var_EstadoColaborador = 1;
  ELSE
    SET var_EstadoColaborador = 0;
  END IF;
  
  UPDATE Colaborador
  SET CedulaColaborador=vi_CedulaColaborador,
  FechaNacimientoColaborador=vi_FechaNacimientoColaborador,
  DireccionColaborador=vi_DireccionColaborador,
  TelefonoColaborador=vi_TelefonoColaborador,
  SexoColaborador=vi_SexoColaborador,
  EstadoColaborador=var_EstadoColaborador,
  ImagenColaborador=vi_FotoColaborador
  WHERE CodigoUsuario = var_CodigoUsuario;
END//
DELIMITER ;

/*CALL sp_ModificarColaborador ('carolg','1718715095',CURRENT_DATE(),'NO','0987654322','Diario','Oculto','/hola');*/

/*==============================================================*/
/* ObtenerColaboradores                                         */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ObtenerColaboradores;
DELIMITER //
CREATE PROCEDURE sp_ObtenerColaboradores ()
BEGIN
  SELECT u.CodigoUsuario, u.NombreUsuario, CONCAT(u.NombresUsuario,' ',u.ApellidosUsuario) AS 'NombreCompleto', c.CedulaColaborador, c.FechaNacimientoColaborador, c.DireccionColaborador, u.CorreoElectronicoUsuario, c.TelefonoColaborador, c.SexoColaborador, c.ImagenColaborador 
  FROM Usuario AS u, Colaborador AS c
  WHERE c.CodigoUsuario = u.CodigoUsuario
  AND c.EstadoColaborador = 1;
END//
DELIMITER ;

/*==============================================================*/
/* ObtenerObjetosAprendizajeColaboradores                       */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ObtenerObjetosAprendizajeColaboradores;
DELIMITER //
CREATE PROCEDURE sp_ObtenerObjetosAprendizajeColaboradores ( IN vi_CodigoUsuario INT,
															 in vi_NombreUsuario VARCHAR(50))
BEGIN
  DECLARE var_TipoUsuario VARCHAR(20);
  
  SELECT TipoUsuario INTO var_TipoUsuario
  FROM Usuario AS u
  WHERE u.NombreUsuario = vi_NombreUsuario;
  
  SELECT oa.CodigoObjetoAprendizaje, oa.NombreObjetoAprendizaje, oa.DescripcionObjetoAprendizaje,oa.FechaCreacionObjetoAprendizaje,m.NombreMateria ,oa.TipoObjetoAprendizaje, oa.ArchivoObjetoAprendizaje 
  FROM Usuario AS u, Colaborador AS c, ObjetoAprendizaje AS oa, Materia AS m
  WHERE c.CodigoUsuario = vi_CodigoUsuario
  AND c.EstadoColaborador = 1
  AND u.CodigoUsuario = c.CodigoUsuario
  AND oa.CodigoUsuario = u.CodigoUsuario
  AND oa.EstadoObjetoAprendizaje = 1
  AND oa.CodigoMateria = m.CodigoMateria
  AND 	(		(	oa.TipoObjetoAprendizaje = 'Privado'
			AND u.TipoUsuario = var_TipoUsuario)
		OR 	(	oa.TipoObjetoAprendizaje = 'Publico')
		);
END//
DELIMITER ;

/*CALL sp_ObtenerObjetosAprendizajeColaboradores (2, 'carolg');*/

/*==============================================================*/
/* FotografiaColaborador                                        */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_FotografiaColaborador;
DELIMITER //
CREATE PROCEDURE sp_FotografiaColaborador ( IN vi_NombreUsuario VARCHAR(50),
											OUT	vo_Mensaje VARCHAR(100))
BEGIN
  IF EXISTS ( 	SELECT *
				FROM Usuario AS u, Colaborador AS c
                WHERE u.CodigoUsuario = c.CodigoUsuario
                AND u.NombreUsuario=vi_NombreUsuario)
  THEN
    SELECT c.ImagenColaborador INTO vo_Mensaje
    FROM Usuario AS u, Colaborador AS c
    WHERE u.CodigoUsuario = c.CodigoUsuario
    AND u.NombreUsuario = vi_NombreUsuario;
  ELSE
	SET vo_Mensaje = '';
  END IF;
END//
DELIMITER ;

CALL sp_FotografiaColaborador ('carolg',@mensaje);
SELECT @mensaje
