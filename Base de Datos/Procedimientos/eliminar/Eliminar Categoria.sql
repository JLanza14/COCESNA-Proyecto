DROP PROCEDURE IF EXISTS SP_BORRARCATEGORIA;
DELIMITER $$
CREATE PROCEDURE SP_BORRARCATEGORIA(
								IN pIdCategoria INT)
BEGIN

	DELETE FROM pregunta WHERE categorias_id_categoria = pIdCategoria;
	DELETE FROM categoria_pregunta WHERE id_categoria = pIdCategoria;
  
END$$
DELIMITER ;
/*
CALL SP_BORRARCATEGORIA(1);
*/