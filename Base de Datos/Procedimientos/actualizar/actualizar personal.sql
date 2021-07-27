DROP PROCEDURE IF EXISTS SP_ACTUALIZARPERSONAL;
DELIMITER $$
CREATE PROCEDURE SP_ACTUALIZARPERSONAL( 
						IN pnId				INT(3),
						IN pcNombres		VARCHAR(50), 
                        IN pcApellidos 		VARCHAR(50), 
                        IN pfNacimiento		DATE,
                        IN pfIngreso		DATE,
                        IN pcGenero			ENUM('M', 'F', ''),
                        IN pcEmpleadoN		VARCHAR (10),
                        IN pnActivo		TINYINT(1)
                        )
SP:BEGIN
       UPDATE personal1 SET nombres=pcNombres,apellidos=pcApellidos,fecha_nacimiento=pfNacimiento,fecha_ingreso=pfIngreso,sexo=pcGenero,no_empleado=pcEmpleadoN,activo=pnactivo WHERE id_personal=pnId;
       UPDATE personal SET nombres=pcNombres,apellidos=pcApellidos,fecha_nacimiento=pfNacimiento,fecha_ingreso=pfIngreso,sexo=pcGenero,no_empleado=pcEmpleadoN,activo=pnactivo WHERE id_personal=pnId;
END $$
DELIMITER ;

/*
CALL SP_ACTUALIZARPERSONAL(1,'Juan Pedro','Lopez Lopez','1971-06-13','2015-04-15','M','JL2015',1);
*/