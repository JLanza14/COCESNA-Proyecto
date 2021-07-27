DROP PROCEDURE IF EXISTS SP_INCATEGORIA;
DELIMITER $$
CREATE PROCEDURE SP_INCATEGORIA( 
						IN pcNombre  	  		VARCHAR(45), 
						IN pcDescripcion			VARCHAR(255)
)
SP:BEGIN
         /**/
		INSERT INTO categoria_pregunta (nombre_cat,descripcion) 
		VALUES(pcNombre, pcDescripcion);
		/**/
END $$
DELIMITER ;

/*
call SP_INCATEGORIA('categoria 1', 'Primera categoria');
*/