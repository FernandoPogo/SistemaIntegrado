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

CALL sp_RegistrarObjetoAprendizaje ('Pruebas pasrciales','Alguien sabe doande puedo estudiar','Ruta','Activo','Publico','admin','redes',@v_Mensaje);
Select @v_Mensaje;

