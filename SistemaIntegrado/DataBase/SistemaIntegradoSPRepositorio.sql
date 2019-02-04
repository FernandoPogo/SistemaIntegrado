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
/* RegistrarObjetoAprendizaje                                  */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_RegistrarObjetoAprendizaje;
DELIMITER //
CREATE PROCEDURE sp_RegistrarObjetoAprendizaje (	IN	vi_NombreOA VARCHAR(50),
													IN	vi_DescripcionOA TEXT,
                                                    IN  vi_ArchivoOA TINYTEXT,
													IN  vi_EstadoOA VARCHAR(15),
													IN  vi_TipoOA VARCHAR (20),
													IN	vi_AutorOA VARCHAR(50),
													IN	vi_MateriaOA VARCHAR(50),
													OUT	vo_Mensaje VARCHAR(100))
BEGIN
	DECLARE var_AutorOA VARCHAR(50);
    DECLARE var_MateriaOA VARCHAR(50);
	
    SELECT codigoUsuario INTO var_AutorOA
    FROM Usuario
    WHERE nombreUsuario = vi_AutorOA;
    
    SELECT codigoMateria INTO var_MateriaOA
    FROM Materia
    WHERE NombreMateria = vi_MateriaOA;
    
    IF (vi_EstadoOA LIKE 'Activo')
    THEN 	
	  INSERT
      INTO ObjetoAprendizaje (NombreObjetoAprendizaje,DescripcionObjetoAprendizaje,ArchivoObjetoAprendizaje,FechaCreacionObjetoAprendizaje,EstadoObjetoAprendizaje,TipoObjetoAprendizaje,CodigoUsuario,CodigoMateria)
      VALUES (vi_NombreOA,vi_DescripcionOA,vi_ArchivoOA,CURDATE(),1,vi_TipoOA,var_AutorOA,var_MateriaOA);
    ELSE
      INSERT
      INTO ObjetoAprendizaje (NombreObjetoAprendizaje,DescripcionObjetoAprendizaje,ArchivoObjetoAprendizaje,FechaCreacionObjetoAprendizaje,EstadoObjetoAprendizaje,TipoObjetoAprendizaje,CodigoUsuario,CodigoMateria)
      VALUES (vi_NombreOA,vi_DescripcionOA,vi_ArchivoOA,CURDATE(),0,vi_TipoOA,var_AutorOA,var_MateriaOA);
    END IF;
    SET vo_Mensaje = CONCAT('El Objeto de aprendizaje "',vi_NombreOA,'" se ha registrado exitosamente');
END//
DELIMITER ;

/*CALL sp_RegistrarObjetoAprendizaje ('Pruebas pasrciales','Alguien sabe doande puedo estudiar','Ruta','Activo','Publico','admin','redes',@v_Mensaje);
Select @v_Mensaje;*/


/*==============================================================*/
/* ObtenerOA                                                    */
/*==============================================================*/

DROP PROCEDURE IF EXISTS sp_ObtenerOA;
DELIMITER //
CREATE PROCEDURE sp_ObtenerOA (	IN  vi_NombreUsuario VARCHAR(50))
BEGIN
  DECLARE var_TipoUsuario VARCHAR(20);
  
  SELECT TipoUsuario INTO var_TipoUsuario
  FROM Usuario
  WHERE NombreUsuario=vi_NombreUsuario;

  SELECT oa.CodigoObjetoAprendizaje , oa.NombreObjetoAprendizaje, oa.DescripcionObjetoAprendizaje, oa.ArchivoObjetoAprendizaje ,u.NombreUsuario, m.NombreMateria ,oa.FechaCreacionObjetoAprendizaje, oa.EstadoObjetoAprendizaje, oa.TipoObjetoAprendizaje
  FROM ObjetoAprendizaje AS oa, Usuario AS u, Materia AS m
  WHERE (	oa.CodigoUsuario = u.CodigoUsuario
	    	AND oa.CodigoMateria = m.CodigoMateria
			AND oa.EstadoObjetoAprendizaje = 1
            AND oa.TipoObjetoAprendizaje = 'Publico')
  OR 	(	oa.CodigoUsuario = u.CodigoUsuario
			AND oa.CodigoMateria = m.CodigoMateria
			AND oa.EstadoObjetoAprendizaje = 1
            AND oa.TipoObjetoAprendizaje = 'Privado'
			AND u.TipoUsuario = var_TipoUsuario )
  ORDER BY oa.NombreObjetoAprendizaje;
END//
DELIMITER ;

/*CALL sp_ObtenerOA ('carolg');*/

