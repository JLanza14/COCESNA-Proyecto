DROP PROCEDURE IF EXISTS SP_ACTUALIZARCATEGORIA;
DELIMITER $$
CREATE PROCEDURE SP_ACTUALIZARCATEGORIA( 
						IN pnId						INT,
						IN pcNombre  	  			VARCHAR(45), 
						IN pcDescripcion			VARCHAR(255)
)
SP:BEGIN
         UPDATE categoria_pregunta SET  nombre_cat=pcNombre,descripcion=pcDescripcion
         WHERE id_categoria=pnId;
END $$
DELIMITER ;

/*
call SP_ACTUALIZARCATEGORIA(1,'categoria actlizada', 'descripcion actualizada');
*/
