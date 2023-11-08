USE appstore;

DELIMITER $$
CREATE procedure spu_productos_listar()
BEGIN 
	SELECT pro.idproducto, 
	cat.categoria, 
	pro.descripcion, 
	pro.precio, 
	pro.garantia, 
	pro.fotografia
	FROM productos pro
	INNER JOIN categorias cat ON cat.idcategoria = pro.idcategoria
	WHERE pro.inactive_at IS NULL;
END $$

DELIMITER $$
CREATE PROCEDURE spu_productos_buscar(IN _idproducto INT)
BEGIN 
	SELECT pro.idproducto, 
	cat.categoria, 
	pro.descripcion, 
	pro.precio, 
	pro.garantia, 
	pro.fotografia
	FROM productos pro
	INNER JOIN categorias cat ON pro.idcategoria = cat.idcategoria
	WHERE pro.idproducto = _idproducto;
END $$


DELIMITER $$
CREATE PROCEDURE spu_productos_registrar
(
	IN _idcategoria	INT,
	IN _descripcion 	VARCHAR(150),
	IN _precio			FLOAT(7,2),
	IN _garantia		TINYINT,
	IN _fotografia		VARCHAR(200)
)
BEGIN
	INSERT INTO productos
		(idcategoria, descripcion, precio, garantia, fotografia)
		VALUES
		(_idcategoria, _descripcion, _precio, _garantia, NULLIF(_fotografia, ''));
	
    -- Nos devuelve el ultimo valor agregado
    SELECT @@last_insert_id 'idproducto';
END $$

-- En cualquier proceso de consulta/listado/búsqueda, debemos recuperar PK


DELIMITER $$
CREATE PROCEDURE spu_categorias_listar()
BEGIN
	SELECT idcategoria, categoria FROM categorias
	WHERE inactive_at IS NULL;
END $$

DELIMITER $$
CREATE PROCEDURE spu_categorias_registrar(
	IN _categoria 	VARCHAR(30)
)
BEGIN
	INSERT INTO categorias (categoria) VALUES (_categoria);
END $$

DELIMITER $$
CREATE PROCEDURE spu_productos_eliminar(IN _idproducto INT)
BEGIN
	UPDATE productos
    SET inactive_at = NOW()
    WHERE idproducto = _idproducto;
END $$

DELIMITER $$
CREATE PROCEDURE spu_roles_listar()
BEGIN
	SELECT idrol, rol FROM roles
    WHERE inactive_at IS NULL;
END $$

DELIMITER $$
CREATE PROCEDURE spu_nacionalidades_listar()
BEGIN
	SELECT idnacionalidad, nombrepais, nombrecorto FROM nacionalidades;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_listar()
BEGIN
	SELECT
		USU.idusuario,
		ROL.rol,
		NAC.nombrepais,
        USU.avatar,
		USU.apellidos,
		USU.nombres
		FROM usuarios USU
		INNER JOIN roles ROL ON ROL.idrol = USU.idrol
		INNER JOIN nacionalidades NAC ON NAC.idnacionalidad = USU.idnacionalidad
		WHERE USU.inactive_at IS NULL;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_registrar(
	IN _idrol 		INT,
	IN _idnacionalidad	INT,
	IN _avatar		VARCHAR(200),
	IN _apellidos		VARCHAR(30),
	IN _nombres 		VARCHAR(30),
	IN _email 		VARCHAR(50),
	IN _claveacceso		VARCHAR(100)
)
BEGIN
	INSERT INTO usuarios
		(idrol, idnacionalidad, avatar, apellidos, nombres, email, claveacceso)
	VALUES
	(_idrol, _idnacionalidad, NULLIF(_avatar, ''), _apellidos, _nombres, _email, _claveacceso);

	SELECT @@last_insert_id 'idusuario';

END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_eliminar(IN _idusuario INT)
BEGIN
	UPDATE usuarios
    SET inactive_at = NOW()
    WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _email VARCHAR(90))
BEGIN
	SELECT
		USU.idusuario,
        USU.apellidos,
        USU.nombres,
        USU.email,
        USU.claveacceso,
        USU.avatar,
        ROL.rol
		FROM usuarios USU
        INNER JOIN roles ROL ON ROL.idrol = USU.idrol
        WHERE 	email = _email 	AND
				USU.inactive_at IS NULL;
END $$

CREATE VIEW vs_productos_categorias
AS
	SELECT
		PRD.idproducto,
        PRD.idcategoria,
		CAT.categoria,
		PRD.descripcion,
		PRD.precio, 
		PRD.garantia,
		PRD.fotografia, PRD.create_at
		FROM productos PRD
		INNER JOIN categorias CAT ON CAT.idcategoria = PRD.idcategoria
		WHERE PRD.inactive_at IS NULL
		LIMIT 12;
        


        
DELIMITER $$
CREATE PROCEDURE spu_productos_filtrar_categoria(IN _idcategoria INT)
BEGIN
	IF _idcategoria = -1 THEN
		SELECT * FROM vs_productos_categorias ORDER BY create_at;
	ELSE
		SELECT * FROM vs_productos_categorias WHERE idcategoria = _idcategoria ORDER BY create_at;
    END IF;
	
END $$

DELIMITER $$
CREATE PROCEDURE spu_registrar_mantenimiento
(
	IN _idproducto	INT,
    IN _clave		VARCHAR(40),
    IN _valor		VARCHAR(300)
)
BEGIN
	INSERT INTO especificaciones
		(idproducto, clave, valor)
    VALUES
		(_idproducto, _clave, _valor);
        
	SELECT @@last_insert_id 'idespecif';
END $$

CALL spu_registrar_mantenimiento(1,'Tarjeta Gráfica' , 'RTX3060 TI');

SELECT * FROM productos;

CREATE VIEW vs_producto_info
 AS
	SELECT
		P.idproducto,
		E.clave,
		E.valor
	FROM productos P
	INNER JOIN especificaciones E ON P.idproducto = E.idproducto
    WHERE P.inactive_at IS NULL;
    
-- PROCEDIMIENTO PARA LISTAR ESPECIFICACIONES
/*CREATE VIEW vs_especificaciones_listar
	AS
		SELECT
			ESP.idespecif,
			PRO.idproducto,
			PRO.descripcion,
			PRO.garantia,
			PRO.precio,
			PRO.create_at,
			ESP.clave,
			ESP.valor,
			GAL.idgaleria,
			GAL.rutafoto
		FROM especificaciones ESP
		INNER JOIN productos PRO ON PRO.idproducto = ESP.idproducto
        LEFT JOIN galerias GAL ON PRO.idproducto = GAL.idproducto
		WHERE ESP.inactive_at IS NULL;*/
        


CALL spu_productos_especificar(1);

DELIMITER $$
CREATE PROCEDURE spu_productos_especificar(IN _idproducto INT)
BEGIN
 SELECT 
        ESP.idespecif,
        PRO.idproducto,
        PRO.descripcion,
        PRO.create_at,
        PRO.precio,
        PRO.fotografia,
        PRO.garantia,
        ESP.clave,
        ESP.valor,
        GAL.idgaleria,
        GAL.rutafoto
    FROM especificaciones ESP
    INNER JOIN productos PRO ON ESP.idproducto = PRO.idproducto
    LEFT JOIN galerias GAL ON GAL.idgaleria = ESP.idespecif
    WHERE PRO.idproducto = _idproducto;
END $$

CALL spu_productos_especificar(1);




DELIMITER $$
CREATE PROCEDURE spu_especificaciones_registrar(
    IN _idproducto INT,
    IN _clave VARCHAR(50),
    IN _valor VARCHAR(300),
    IN _rutafoto VARCHAR(255)
)
BEGIN
    DECLARE galerias_count INT;
    
    -- Contar cuántas galerías se han registrado para este producto
    SELECT COUNT(*) INTO galerias_count FROM galerias WHERE idproducto = _idproducto;

    -- Insertar especificación
    INSERT INTO especificaciones (idproducto, clave, valor)
    VALUES (_idproducto, NULLIF(_clave, ''), NULLIF(_valor, ''));
    
    -- Verificar si se han alcanzado los 10 registros para el _idproducto en galerías
    IF galerias_count < 10 THEN
        -- Insertar galería si hay espacio
        INSERT INTO galerias (idproducto, rutafoto)
        VALUES (_idproducto, _rutafoto);
    ELSE
        -- Se han alcanzado 10 registros, establecer _rutafoto en NULL
        SET _rutafoto = NULL;
    END IF;

    -- Obtener el último id de especificación
    SELECT @@last_insert_id 'idespecif';
END $$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE spu_clavegenerada_registrar(
    IN _idusuario                INT,
    IN _email                    VARCHAR(50),
    IN _clavegenerada            CHAR(6)
)
BEGIN
    UPDATE usuarios
    SET 
        clavegenerada =  _clavegenerada,
        estado = '0'
    WHERE idusuario = _idusuario;
END $$
CALL spu_clavegenerada_registrar(1, 'yorghetyauri123@gmail.com', '280703');
SELECT * FROM usuarios


DELIMITER $$
CREATE PROCEDURE spu_desbloqueosms_registrar(
	IN _idusuario 				INT,
    IN _telefono				CHAR(9),
    IN _clavegenerada 			CHAR(6)
)
BEGIN
	UPDATE usuarios
    SET
		clavegenerada = _clavegenerada,
		estado = '0'
		WHERE idusuario = _idusuario;
END $$

CALL spu_desbloqueosms_registrar(2, '956418436', '123456')


/*DELIMITER $$
CREATE PROCEDURE spu_usuario_validartiempo
(
	IN _idusuario INT
)
BEGIN
	-- Verificar si hay registros para el usuario
	IF (SELECT COUNT(*) FROM desbloqueos WHERE idusuario = _idusuario) = 0 THEN
		SELECT 'GENERAR' AS 'status';
	ELSE
		-- Buscar el último estado vigente del usuario (0 o 1)
		IF (SELECT estado FROM desbloqueos WHERE idusuario = _idusuario ORDER BY create_at DESC LIMIT 1) = '0' THEN
			SELECT 'GENERAR' AS 'status';
		ELSE
			-- Verificar si ha pasado más de 15 minutos desde la generación
			IF (SELECT COUNT(*) FROM desbloqueos WHERE idusuario = _idusuario AND estado = '1' AND NOW() NOT BETWEEN create_at AND DATE_ADD(create_at, INTERVAL 15 MINUTE) ORDER BY create_at DESC LIMIT 1) = 1 THEN
				SELECT 'GENERAR' AS 'status';
			ELSE
				SELECT 'DENEGAR' AS 'status';
			END IF;
		END IF;
	END IF;
END $$
DELIMITER ;*/

DELIMITER //
CREATE PROCEDURE spu_usuario_validarclave
(
	IN p_idusuario INT,
    IN p_clavegenerada CHAR(6))
BEGIN
    -- Verificar si el estado es '0' y si la clave generada coincide
    IF EXISTS (
		SELECT 1 FROM usuarios 
        WHERE idusuario = p_idusuario AND estado = '0' 
        AND clavegenerada = p_clavegenerada
        )
        THEN
        -- Actualizar el estado a '1' sin cambiar la clavegenerada
        UPDATE usuarios
        SET estado = '1'
        WHERE idusuario = p_idusuario;
        SELECT 'VALIDO' AS 'status';
    ELSE
        SELECT 'DENEGADO' AS 'status';
    END IF;
END //
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE spu_usuario_actualizarclave
(
	IN _idusuario INT,
	IN _claveacceso VARCHAR(100)
)
BEGIN
	-- Actualizar la clave de acceso del usuario
	UPDATE usuarios SET claveacceso = _claveacceso WHERE idusuario = _idusuario;
	
	-- Desactivar todos los registros relacionados con el usuario
	UPDATE desbloqueos SET estado = '0' WHERE idusuario = _idusuario;
END $$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE spu_usuario_actualizarclave
(
	IN _idusuario INT,
	IN _claveacceso VARCHAR(100)
)
BEGIN
	UPDATE usuarios 	SET 
        claveacceso = _claveacceso,
        update_at = NOW()
	WHERE idusuario = _idusuario;
END $$

delimiter $$
CREATE procedure spu_clavegenerada_obtener(in _campocriterio varchar(60))
begin
	select 
		idusuario,
		apellidos,
		nombres,
        email,
        telefono,
        clavegenerada
    from usuarios 
    where 
		-- email like concat('%',_campocriterio,'%') or telefono like concat('%',_campocriterio,'%') and
        email = _campocriterio;
        
end $$
delimiter ;

DELIMITER $$
CREATE PROCEDURE spu_buscar_email(IN _email VARCHAR(100))
BEGIN
    SELECT 
    idusuario,
    apellidos,
    nombres,
    email,
    telefono,
    clavegenerada
    FROM usuarios
    WHERE 
			email = _email OR telefono = _email;
END $$

CALL spu_buscar_email('970526015');




CALL spu_clavegenerada_obtener('alonsomunoz263@gmail.com');



CALL spu_usuario_validartiempo(1);
CALL spu_usuario_validarclave(1,'123456');
CALL spu_usuario_actualizarclave(1, 'holayorghet');


CALL spu_desbloqueos_registrar(1,'123456');
CALL spu_desbloqueosms_registrar(1, '987654321', '456789');

CALL spu_especificaciones_registrar(6, 'Pantallass', '15.6 pulgadas','xas.jpg');
CALL spu_productos_especificar(6);
CALL spu_productos_especificar(1);
select * from galerias;
CALL spu_productos_filtrar_categoria(3);
CALL spu_usuarios_login ('alonso@gmail.com');
SELECT * FROM especificaciones;
SELECT * FROM nacionalidades;
SELECT * FROM desbloqueos;
SELECT * FROM roles;
SELECT * FROM galerias;
SELECT * FROM productos;
use appstore;
SELECT * FROM usuarios;
CALL spu_usuarios_listar();
CALL spu_roles_listar();
CALL spu_nacionalidades_listar();
CALL spu_usuarios_registrar(1, 1, '', 'Hernandez Yerén', 'Yorghet', 'yorghetyauri123@gmail.com', '12345');
CALL spu_usuarios_registrar(1, 50, '', 'Muñoz Quispe', 'Alonso', 'alonsomunoz263@gmail.com' ,'12345');
CALL spu_usuarios_registrar(3, 50, '', 'Quispe Napa', 'Harold', 'harito@gmail.com', '12345');
CALL spu_usuarios_registrar(2, 50, '', 'Villegas', 'Lucas', 'lucas@gmail.com', '12345');
CALL spu_productos_registrar(1,'ProductoA', 4500, 12, '');
CALL spu_productos_registrar(2,'ProductoB', 500, 24, '');
CALL spu_categorias_registrar("Laptop");
CALL spu_categorias_listar();
CALL spu_productos_listar();
CALL spu_productos_buscar(1);

DELETE FROM especificaciones;
ALTER TABLE especificaciones AUTO_INCREMENT 1;
DELETE FROM galerias;
ALTER TABLE galerias AUTO_INCREMENT 1;

DELETE FROM usuarios;
ALTER TABLE usuarios AUTO_INCREMENT 1;