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
/* RegistrarForo                                  */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_RegistrarForo;
DELIMITER //
CREATE PROCEDURE sp_RegistrarForo (	IN	vi_NombreForo VARCHAR(50),
									IN	vi_DescripcionForo TEXT, 
                                    IN  vi_EstadoForo VARCHAR(15),
                                    IN  vi_TipoForo VARCHAR (20),
									IN	vi_AutorForo VARCHAR(50),
									IN	vi_MateriaForo VARCHAR(50),
                                    OUT	vo_Mensaje VARCHAR(100))
BEGIN
	DECLARE var_AutorForo VARCHAR(50);
    DECLARE var_MateriaForo VARCHAR(50);
	
    SELECT codigoUsuario INTO var_AutorForo
    FROM Usuario
    WHERE nombreUsuario = vi_AutorForo;
    
    SELECT codigoMateria INTO var_MateriaForo
    FROM Materia
    WHERE NombreMateria = vi_MateriaForo;
    
    IF (vi_EstadoForo LIKE 'Activo')
    THEN 	
	  INSERT
      INTO Foro (NombreForo,DescripcionForo,EstadoForo,TipoForo,FechaCreacionForo,CodigoUsuario,CodigoMateria)
      VALUES (vi_NombreForo,vi_DescripcionForo,1,vi_TipoForo,CURDATE(),var_AutorForo,var_MateriaForo);
    ELSE
      INSERT
      INTO Foro (NombreForo,DescripcionForo,EstadoForo,TipoForo,FechaCreacionForo,CodigoUsuario,CodigoMateria)
      VALUES (vi_NombreForo,vi_DescripcionForo,0,vi_TipoForo,CURDATE(),var_AutorForo,var_MateriaForo);
    END IF;
    SET vo_Mensaje = CONCAT('El foro "',vi_NombreForo,'" se ha registrado exitosamente');
    
END//
DELIMITER ;

/*CALL sp_RegistrarForo ('Pruebas pasrciales','Alguien sabe doande puedo estudiar','Activo','Publico','admin','redes',@v_Mensaje);
Select @v_Mensaje;*/

/*==============================================================*/
/* ObtenerForos                                                 */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ObtenerForos;
DELIMITER //
CREATE PROCEDURE sp_ObtenerForos (	IN	vi_TemaForo VARCHAR(50),
									IN	vi_MateriaForo VARCHAR(50), 
                                    IN  vi_NombreUsuario VARCHAR(50))
BEGIN
  DECLARE var_TipoUsuario VARCHAR(20);
  
  SELECT TipoUsuario INTO var_TipoUsuario
  FROM Usuario
  WHERE NombreUsuario=vi_NombreUsuario;

  SELECT f.CodigoForo ,f.NombreForo,f.DescripcionForo, u.NombreUsuario, m.NombreMateria ,f.FechaCreacionForo, f.EstadoForo, f.TipoForo
  FROM Foro AS f, Usuario AS u, Materia AS m
  WHERE (	f.CodigoUsuario = u.CodigoUsuario
	    	AND f.CodigoMateria = m.CodigoMateria
			AND f.EstadoForo = 1
            AND f.TipoForo = 'Publico')
  OR 	(	f.CodigoUsuario = u.CodigoUsuario
			AND f.CodigoMateria = m.CodigoMateria
			AND f.EstadoForo = 1
            AND f.TipoForo = 'Privado'
			AND u.TipoUsuario = var_TipoUsuario )
  ORDER BY f.NombreForo;
END//
DELIMITER ;

/*CALL sp_ObtenerForos ('','Todas','fpogo');*/

/*==============================================================*/
/* RegistrarComentario                                          */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_RegistrarComentario;
DELIMITER //
CREATE PROCEDURE sp_RegistrarComentario (	IN	vi_CodigoForo VARCHAR(50),
											IN  vi_NombreUsuario VARCHAR(50),
											IN	vi_Opinion TEXT,
                                            OUT	vo_Mensaje VARCHAR(100))
BEGIN
	DECLARE var_CodigoUsuario INT;
	SELECT u.CodigoUsuario INTO var_CodigoUsuario 
    FROM Usuario AS u
    WHERE u.NombreUsuario = vi_NombreUsuario;
    
    INSERT
    INTO Opinion (Opinion,FechaOpinion,CodigoForo,CodigoUsuario)
    VALUES (vi_Opinion,NOW(),vi_CodigoForo,var_CodigoUsuario);
    
    SET vo_Mensaje = CONCAT(vi_NombreUsuario,'": Su comentario se ha subido con exito');
END//
DELIMITER ;

/*CALL sp_RegistrarComentario (1,'admin','Ya termine',@v_Mensaje);
Select @v_Mensaje;*/

/*==============================================================*/
/* ObtenerComentarios                                           */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ObtenerComentarios;
DELIMITER //
CREATE PROCEDURE sp_ObtenerComentarios (	IN	vi_CodigoForo INT)
BEGIN
	SELECT o.Opinion, u.NombreUsuario, o.FechaOpinion
    FROM Foro AS f, Usuario AS u, Opinion AS o
    WHERE o.CodigoForo=f.CodigoForo
    AND u.CodigoUsuario = o.CodigoUsuario
    AND f.CodigoForo = vi_CodigoForo;
END//
DELIMITER ;

/*CALL sp_ObtenerComentarios (1);*/

/*==============================================================*/
/* ObtenerMisForos                                              */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ObtenerMisForos;
DELIMITER //
CREATE PROCEDURE sp_ObtenerMisForos (	IN  vi_NombreUsuario VARCHAR(50))
BEGIN
      SELECT f.CodigoForo ,f.NombreForo,f.DescripcionForo, u.NombreUsuario, m.NombreMateria ,f.FechaCreacionForo, f.EstadoForo, f.TipoForo
      FROM Foro AS f, Usuario AS u, Materia AS m
      WHERE f.CodigoUsuario = u.CodigoUsuario
	  AND f.CodigoMateria = m.CodigoMateria
	  AND u.NombreUsuario = vi_NombreUsuario
	  ORDER BY f.NombreForo;
END//
DELIMITER ;

/*CALL sp_ObtenerMisForos ('admin');*/

/*==============================================================*/
/* ModificarEstadoMisForos                                              */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ModificarEstadoMisForos;
DELIMITER //
CREATE PROCEDURE sp_ModificarEstadoMisForos (	IN  vi_CodigoForo VARCHAR(50),
										        IN  vi_EstadoForo INT)
BEGIN
  
  UPDATE Foro 
  SET EstadoForo=vi_EstadoForo
  WHERE CodigoForo=vi_CodigoForo;
END//
DELIMITER ;

/*CALL sp_ModificarEstadoMisForos (1,1);*/


/*==============================================================*/
/* ModificarTipoMisForos                                              */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ModificarTipoMisForos;
DELIMITER //
CREATE PROCEDURE sp_ModificarTipoMisForos (	IN  vi_CodigoForo VARCHAR(50),
											IN  vi_TipoForo VARCHAR(20))
BEGIN
  DECLARE var_TipoForo VARCHAR(20);
  
  IF(vi_TipoForo LIKE 'Publico')
  THEN
    SET var_TipoForo = 'Privado';
  ELSE
    SET var_TipoForo = 'Publico';
  END IF;
  
  UPDATE Foro 
  SET TipoForo= var_TipoForo
  WHERE CodigoForo=vi_CodigoForo;
END//
DELIMITER ;

/*CALL sp_ModificarTipoMisForos (1,'Publico');*/

/*==============================================================*/
/* EliminarForo                                              */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_EliminarForo;
DELIMITER //
CREATE PROCEDURE sp_EliminarForo (	IN  vi_CodigoForo VARCHAR(50))
BEGIN
  DELETE 
  FROM Opinion
  WHERE CodigoForo = vi_CodigoForo;
  
  DELETE
  FROM Foro
  WHERE CodigoForo = vi_CodigoForo;
END//
DELIMITER ;

/*CALL sp_EliminarForo (4);*/

