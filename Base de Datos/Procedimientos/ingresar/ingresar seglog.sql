DROP PROCEDURE IF EXISTS SP_INSEGLOG;
DELIMITER $$
CREATE PROCEDURE SP_INSEGLOG(IN pcUsuario VARCHAR(20),
							IN pcDetalle mediumtext,
							IN pnLlave int,
							IN pcTabla varchar(60),
							IN pcAccion mediumtext,
							In pcComando mediumtext,
							IN pcLogIp varchar(20)				
)
SP:BEGIN

	INSERT INTO `ccocesna`.`seglog`
	(`SegLogFecha`,`SegLogHora`,`SegUsrUsuario`,`SegLogDetalle`,`SegLogLlave`,`SegLogTabla`,`SegLogAccion`,`SegLogComando`,`SegLogIp`)
	VALUES(
		(select current_timestamp()),
		(SELECT extract(HOUR FROM(select current_timestamp()))),
		pcUsuario,pcDetalle,pnLlave,pcTabla,pcAccion,pcComando,pcLogIp
		);

END $$
DELIMITER ;