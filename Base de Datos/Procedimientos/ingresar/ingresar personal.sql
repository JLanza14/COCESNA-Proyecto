DROP PROCEDURE IF EXISTS SP_INPERSONAL;
DELIMITER $$
CREATE PROCEDURE SP_INPERSONAL( 
						IN pcNombres		VARCHAR(50), 
                        IN pcApellidos 		VARCHAR(50), 
                        IN pfNacimiento		DATE,
                        IN pfIngreso		DATE,
                        IN pcGenero			ENUM('M', 'F', ''),
                        IN pcEmpleadoN		VARCHAR (10),
                        IN pnActivo		TINYINT(1)
                        )
SP:BEGIN

       INSERT INTO personal1 (nombres,apellidos,fecha_nacimiento,fecha_ingreso,sexo,no_empleado,activo)
       VALUES (pcNombres,pcApellidos,pfNacimiento,pfIngreso,pcGenero,pcEmpleadoN,pnActivo);
       
       INSERT INTO personal (id_personal,nombres,apellidos,fecha_nacimiento,fecha_ingreso,sexo,no_empleado,activo)
       VALUES (
			( select id_personal from personal1 ORDER BY id_personal DESC LIMIT 1),
			( select nombres from personal1 ORDER BY id_personal DESC LIMIT 1),
            ( select apellidos from personal1 ORDER BY id_personal DESC LIMIT 1),
            ( select fecha_nacimiento from personal1 ORDER BY id_personal DESC LIMIT 1),
            ( select fecha_ingreso from personal1 ORDER BY id_personal DESC LIMIT 1),
            ( select sexo from personal1 ORDER BY id_personal DESC LIMIT 1),
            ( select no_empleado  from personal1 ORDER BY id_personal DESC LIMIT 1),
            ( select activo from personal1 ORDER BY id_personal DESC LIMIT 1)
       );
END $$
DELIMITER ;

/*
call SP_INPERSONAL('Juan','Lopez','1970-05-13','2019-02-15','M','JL201902',1);
*/