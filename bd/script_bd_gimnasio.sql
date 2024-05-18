drop database if exists bd_gimnasio;
create database bd_gimnasio;
use bd_gimnasio;

create table tb_servicio(
	codigo_servicio char(5) primary key not null,
    nombre varchar(100) not null,
    descripcion varchar(100) not null
);

create table tb_metodo(
	codigo_metodo varchar(5) primary key not null,
    nombre varchar(100) not null,
    descripcion varchar(100) not null
);

create table tb_promocion(
	codigo_promocion varchar(5) primary key not null,
    nombre varchar(100) not null,
    descripcion varchar(100) not null
);

create table tb_cliente(
	codigo_cliente varchar(5) primary key not null,
    identificacion varchar(8) not null,
    nombre varchar(100) not null,
    telefono varchar(100) not null
);

ALTER TABLE tb_cliente ADD clave VARCHAR(50) DEFAULT codigo_cliente;

-- call sp_BuscarClientePorCodigo('C0004');
-- call sp_ListarCliente();

create table tb_inscripcion(
	codigo_inscripcion varchar(5) primary key not null,
    numboleta varchar(11) not null,
    inscripcion_codigo_cliente varchar(5) not null,
    inscripcion_codigo_servicio varchar(5) not null,
    inscripcion_codigo_promocion varchar(5) not null,
    emision date not null,
    caducidad date not null,
    precio decimal(11,2) not null,
    pago decimal(11,2) not null,
    inscripcion_codigo_metodo varchar(5) not null,
    deuda decimal(11,2) not null,
    estado varchar(20) not null,
    foreign key (inscripcion_codigo_cliente) references tb_cliente(codigo_cliente),
    foreign key (inscripcion_codigo_servicio) references tb_servicio(codigo_servicio),
    foreign key (inscripcion_codigo_promocion) references tb_promocion(codigo_promocion),
    foreign key (inscripcion_codigo_metodo) references tb_metodo(codigo_metodo)
);

create table tb_categoria(
	codigo_categoria varchar(5) primary key not null,
    nombre varchar(100) not null,
    descripcion varchar(100) not null
);

create table tb_producto(
	codigo_producto varchar(5) primary key not null,
    nombre varchar(100) not null,
    descripcion varchar(100) not null,
    stock_disponible int not null,
    precio decimal(11,2),
    producto_codigo_categoria varchar(5) not null,
    foreign key (producto_codigo_categoria) references tb_categoria(codigo_categoria)
);

-- create table tb_venta();
-- create table tb_detalleventa();

-- Insertando registros en tb_servicio
INSERT INTO tb_servicio (codigo_servicio, nombre, descripcion) VALUES
('S0001', 'Clases de Zumba', 'Clases divertidas de baile y ejercicio'),
('S0002', 'Entrenamiento personalizado', 'Entrenamiento individualizado para alcanzar tus objetivos'),
('S0003', 'Pilates', 'Ejercicios de flexibilidad y fuerza'),
('S0004', 'Spinning', 'Clases intensivas de ciclismo indoor'),
('S0005', 'Yoga', 'Prácticas de relajación y equilibrio');

-- Insertando registros en tb_metodo
INSERT INTO tb_metodo (codigo_metodo, nombre, descripcion) VALUES
('M0001', 'Efectivo', 'Pago en efectivo al momento de la inscripción'),
('M0002', 'Tarjeta', 'Pago con tarjeta de crédito o débito'),
('M0003', 'Transferencia', 'Pago mediante transferencia bancaria'),
('M0004', 'Yape', 'Pago a través de plataforma Yape'),
('M0005', 'Plin', 'Pago a través de plataforma Plin');

-- Insertando registros en tb_promocion
INSERT INTO tb_promocion (codigo_promocion, nombre, descripcion) VALUES
('PR001', '1 mes', '1 persona matriculada por 1 mes'),
('PR002', '2 personas x 1 mes', '2 personas matriculas por 1 mes'),
('PR003', '3 personas x 1 mes', '3 personas matriculadas por 1 mes'),
('PR004', '3 veces x semana', '1 persona asiste al gym 3 veces a la semana por 1 mes'),
('PR005', 'Rutina del dia', 'La persona solo asiste ese mismo dia');

-- Insertando registros en tb_cliente
INSERT INTO tb_cliente (codigo_cliente, identificacion, nombre, telefono) VALUES
('C0001', '72345678', 'Juan Pérez', '923456789'),
('C0002', '77654321', 'María Gómez', '987654321'),
('C0003', '73579246', 'Pedro Sánchez', '923987654'),
('C0004', '74681357', 'Ana López', '987123456'),
('C0005', '78765432', 'Carlos Martínez', '954321987'),
('C0006', '72213763', 'Daryl Oscco', '956467609');

-- Insertando registros en tb_inscripcion
INSERT INTO tb_inscripcion (codigo_inscripcion, numboleta, inscripcion_codigo_cliente, inscripcion_codigo_servicio, inscripcion_codigo_promocion, emision, caducidad, precio, pago, inscripcion_codigo_metodo, deuda, estado) VALUES
('I0001', '001000', 'C0001', 'S0001', 'PR001', '2024-04-01', '2024-05-01', 50.00, 50.00, 'M0001', 0.00, 'Vigente'),
('I0002', '001001', 'C0002', 'S0002', 'PR002', '2024-04-02', '2024-05-02', 60.00, 60.00, 'M0002', 0.00, 'Próximo'),
('I0003', '001002', 'C0003', 'S0003', 'PR003', '2024-03-03', '2024-04-03', 70.00, 70.00, 'M0003', 0.00, 'Vencido'),
('I0004', '001003', 'C0004', 'S0004', 'PR004', '2024-02-04', '2024-03-04', 80.00, 80.00, 'M0004', 0.00, 'Vencido'),
('I0005', '001004', 'C0005', 'S0005', 'PR005', '2024-04-05', '2024-05-05', 90.00, 90.00, 'M0005', 0.00, 'Vigente');

-- Insertando registros en tb_categoria
INSERT INTO tb_categoria (codigo_categoria, nombre, descripcion) VALUES
('CAT01', 'Hidratantes', 'Productos para hidratacion deportiva'),
('CAT02', 'Quemadores', 'Equipamiento para entrenamiento cardiovascular'),
('CAT03', 'Accesorios', 'Accesorios para actividades deportivas'),
('CAT04', 'Ropa deportiva', 'Ropa especializada para ejercicio'),
('CAT05', 'Suplementos', 'Suplementos nutricionales para deportistas');

-- Insertando registros en tb_producto
INSERT INTO tb_producto (codigo_producto, nombre, descripcion, stock_disponible, precio, producto_codigo_categoria) VALUES
('P0001', 'Agua Cielo', 'Botella de agua mineral Cielo de 500 ml', 100, 1.50, 'CAT01'),
('P0002', 'Agua Loa', 'Botella de agua mineral Loa de 500 ml', 80, 1.25, 'CAT01'),
('P0003', 'Agua San Carlos', 'Botella de agua mineral San Carlos de 500 ml', 120, 1.20, 'CAT01'),
('P0004', 'Sporade', 'Bebida isotónica Sporade de 500 ml', 50, 2.00, 'CAT01'),
('P0005', 'Proteína en polvo', 'Suplemento de proteína para batidos', 30, 29.99, 'CAT05');

select * from tb_servicio;
select * from tb_metodo;
select * from tb_promocion;
select * from tb_cliente;
select * from tb_inscripcion;
select * from tb_categoria;
select * from tb_producto;

-- STORE PROCEDURE: sp_ListarServicio
DELIMITER //
CREATE PROCEDURE sp_ListarServicio()
BEGIN
    SELECT * FROM tb_servicio;
END//
DELIMITER ;
-- call sp_ListarServicio();

-- STORE PROCEDURE: sp_ListarMetodo
DELIMITER //
CREATE PROCEDURE sp_ListarMetodo()
BEGIN
    SELECT * FROM tb_metodo;
END//
DELIMITER ;
-- call sp_ListarMetodo();

-- STORE PROCEDURE: sp_ListarPromocion
DELIMITER //
CREATE PROCEDURE sp_ListarPromocion()
BEGIN
    SELECT * FROM tb_promocion;
END//
DELIMITER ;
-- call sp_ListarPromocion();

-- STORE PROCEDURE: sp_ListarCliente
DELIMITER //
CREATE PROCEDURE sp_ListarCliente()
BEGIN
    SELECT * FROM tb_cliente;
END//
DELIMITER ;
-- call sp_ListarCliente();

-- STORE PROCEDURE: sp_ListarInscripcion
DELIMITER //
CREATE PROCEDURE sp_ListarInscripcion()
BEGIN
    SELECT 
        i.codigo_inscripcion, 
        i.numboleta, 
        c.nombre AS nombre_cliente, 
        s.nombre AS nombre_servicio, 
        i.emision, 
        i.caducidad, 
        i.estado
    FROM 
        tb_inscripcion i
    INNER JOIN 
        tb_cliente c ON i.inscripcion_codigo_cliente = c.codigo_cliente
    INNER JOIN 
        tb_servicio s ON i.inscripcion_codigo_servicio = s.codigo_servicio;
END//
DELIMITER ;
call sp_ListarInscripcion();

-- STORE PROCEDURE: sp_ListarCategoria
DELIMITER //
CREATE PROCEDURE sp_ListarCategoria()
BEGIN
    SELECT * FROM tb_categoria;
END//
DELIMITER ;
-- call sp_ListarCategoria();

-- STORE PROCEDURE: sp_ListarProducto
DELIMITER //
CREATE PROCEDURE sp_ListarProducto()
BEGIN
    SELECT * FROM tb_producto;
END//
DELIMITER ;
-- call sp_ListarProducto();


-- STORE PROCEDURE: sp_MostrarServicioPorCodigo
DELIMITER //
CREATE PROCEDURE sp_MostrarServicioPorCodigo(in codserv char(5))
BEGIN
    SELECT * 
    FROM tb_servicio
    WHERE codigo_servicio = codserv;
END//
DELIMITER ;

-- STORE PROCEDURE: sp_MostrarMetodoPorCodigo
DELIMITER //
CREATE PROCEDURE sp_MostrarMetodoPorCodigo(
    IN codmet VARCHAR(5)
)
BEGIN
    SELECT * 
    FROM tb_metodo
    WHERE codigo_metodo = codmet;
END//
DELIMITER ;

-- STORE PROCEDURE: sp_MostrarPromocionPorCodigo
DELIMITER //
CREATE PROCEDURE sp_MostrarPromocionPorCodigo(
    IN codprom VARCHAR(5)
)
BEGIN
    SELECT * 
    FROM tb_promocion
    WHERE codigo_promocion = codprom;
END//
DELIMITER ;


-- STORE PROCEDURE: sp_MostrarClientePorCodigo
DELIMITER //
CREATE PROCEDURE sp_MostrarClientePorCodigo(
    IN codcli VARCHAR(5)
)
BEGIN
    SELECT 
        codigo_cliente,
        identificacion,
        nombre,
        telefono
    FROM tb_cliente
    WHERE codigo_cliente = codcli;
END//
DELIMITER ;



-- STORE PROCEDURE: sp_MostrarInscripcionPorCodigo
DELIMITER //
CREATE PROCEDURE sp_MostrarInscripcionPorCodigo(
    IN codinsc VARCHAR(5)
)
BEGIN
    SELECT 
        i.codigo_inscripcion,
        i.numboleta,
        c.nombre AS nombre_cliente,
        s.nombre AS nombre_servicio,
        p.nombre AS nombre_promocion,
        i.emision,
        i.caducidad,
        DATEDIFF(i.caducidad, CURDATE()) AS dias_restantes,
        i.precio,
        i.pago,
        m.nombre AS nombre_metodo_pago,
        i.deuda,
        i.estado
    FROM 
        tb_inscripcion i
    INNER JOIN 
        tb_cliente c ON i.inscripcion_codigo_cliente = c.codigo_cliente
    INNER JOIN 
        tb_servicio s ON i.inscripcion_codigo_servicio = s.codigo_servicio
    INNER JOIN 
        tb_promocion p ON i.inscripcion_codigo_promocion = p.codigo_promocion
    INNER JOIN 
        tb_metodo m ON i.inscripcion_codigo_metodo = m.codigo_metodo
    WHERE 
        i.codigo_inscripcion = codinsc;
END//
DELIMITER ;

-- CALL sp_MostrarInscripcionPorCodigo('I0003');

-- STORE PROCEDURE: sp_MostrarCategoriaPorCodigo
DELIMITER //
CREATE PROCEDURE sp_MostrarCategoriaPorCodigo(
    IN codcat VARCHAR(5)
)
BEGIN
    SELECT * 
    FROM tb_categoria
    WHERE codigo_categoria = codcat;
END//
DELIMITER ;


-- STORE PROCEDURE: sp_MostrarProductoPorCodigo
DELIMITER //
CREATE PROCEDURE sp_MostrarProductoPorCodigo(
    IN codprod VARCHAR(5)
)
BEGIN
    SELECT 
		p.codigo_producto,
        p.nombre,
        p.descripcion,
        p.stock_disponible,
        p.precio,
        c.nombre AS nombre_categoria
    FROM 
        tb_producto p
    INNER JOIN 
        tb_categoria c ON p.producto_codigo_categoria = c.codigo_categoria
    WHERE 
        p.codigo_producto = codprod;
END//
DELIMITER ;

-- CALL sp_MostrarProductoPorCodigo('P0001');



-- STORE PROCEDURE: sp_RegistrarServicio
DELIMITER //
CREATE PROCEDURE sp_RegistrarServicio(
    IN codserv CHAR(5),
    IN nom VARCHAR(100),
    IN descr VARCHAR(100)
)
BEGIN
    INSERT INTO tb_servicio (codigo_servicio, nombre, descripcion)
    VALUES (codserv, nom, descr);
END//
DELIMITER ;
CALL sp_RegistrarServicio('S0006', 'CrossFit', 'Entrenamientos intensivos de CrossFit');


-- STORE PROCEDURE: sp_RegistrarMetodo
DELIMITER //
CREATE PROCEDURE sp_RegistrarMetodo(
    IN codmet VARCHAR(5),
    IN nom VARCHAR(100),
    IN descr VARCHAR(100)
)
BEGIN
    INSERT INTO tb_metodo (codigo_metodo, nombre, descripcion)
    VALUES (codmet, nom, descr);
END//
DELIMITER ;

CALL sp_RegistrarMetodo('M0006', 'Tunki', 'Pago mediante aplicacion Tunki');


-- STORE PROCEDURE: sp_RegistrarCliente
DELIMITER //
CREATE PROCEDURE sp_RegistrarCliente(
    IN codcli VARCHAR(5),
    IN ident VARCHAR(8),
    IN nom VARCHAR(100),
    IN telef VARCHAR(100)
)
BEGIN
    INSERT INTO tb_cliente (codigo_cliente, identificacion, nombre, telefono)
    VALUES (codcli, ident, nom, telef);
END//
DELIMITER ;

-- CALL sp_RegistrarCliente('C0009', '99999999', 'Lupita Lupe', '987667890');


-- STORE PROCEDURE: sp_RegistrarPromocion
DELIMITER //
CREATE PROCEDURE sp_RegistrarPromocion(
    IN codprom VARCHAR(5),
    IN nom VARCHAR(100),
    IN descr VARCHAR(100)
)
BEGIN
    INSERT INTO tb_promocion (codigo_promocion, nombre, descripcion)
    VALUES (codprom, nom, descr);
END//
DELIMITER ;

CALL sp_RegistrarPromocion('PR006', 'Promoción de verano', 'Descuento especial para la temporada de verano');


-- STORE PROCEDURE: sp_RegistrarInscripcion
DELIMITER //
CREATE PROCEDURE sp_RegistrarInscripcion(
    IN codinsc VARCHAR(5),
    IN numbol VARCHAR(10),
    IN codcli VARCHAR(5),
    IN codserv VARCHAR(5),
    IN codprom VARCHAR(5),
    IN emi DATE,
    IN cad DATE,
    IN prec DECIMAL(11,2),
    IN pag DECIMAL(11,2),
    IN codmet VARCHAR(5),
    IN deu DECIMAL(11,2),
    IN est VARCHAR(20)
)
BEGIN
    INSERT INTO tb_inscripcion (codigo_inscripcion, numboleta, inscripcion_codigo_cliente, inscripcion_codigo_servicio, inscripcion_codigo_promocion, emision, caducidad, precio, pago, inscripcion_codigo_metodo, deuda, estado)
    VALUES (codinsc, numbol, codcli, codserv, codprom, emi, cad, prec, pag, codmet, deu, est);
END//
DELIMITER ;

-- CALL sp_RegistrarInscripcion('I0006', '001003', 'C0006', 'S0001', 'PR001', '2024-04-12', '2024-05-12', 50.00, 50.00, 'M0001', 0.00, 'Vigente');


/*EDITAR LA INFORMACIÓN DE UN SERVICIO.*/
DELIMITER //
CREATE PROCEDURE sp_EditarServicio(
    IN codserv CHAR(5), 
    IN nom VARCHAR(100), 
    IN descr VARCHAR(100))
BEGIN
    UPDATE tb_servicio SET nombre = nom, descripcion = descr 
    WHERE codigo_servicio = codserv;
END; //
-- CALL sp_EditarServicio('S0001', 'Clases de zumba', 'Clase de baile y ejercicio focalizado');

/*EDITAR LA INFORMACIÓN DE UN METODO.*/
DELIMITER //
CREATE PROCEDURE sp_EditarMetodo(
    IN codmet CHAR(5), 
    IN nom VARCHAR(100), 
    IN descr VARCHAR(100))
BEGIN
    UPDATE tb_metodo SET nombre = nom, descripcion = descr 
    WHERE codigo_metodo = codmet;
END; //
-- CALL sp_EditarMetodo('M0001', 'Efectivo', 'Pago en efectivo al momento de la inscripción');

/*EDITAR LA INFORMACIÓN DE UNA PROMOCION.*/
DELIMITER //
CREATE PROCEDURE sp_EditarPromocion(
    IN codprom CHAR(5), 
    IN nom VARCHAR(100), 
    IN descr VARCHAR(100))
BEGIN
    UPDATE tb_promocion SET nombre = nom, descripcion = descr 
    WHERE codigo_promocion = codprom;
END; //
-- CALL sp_EditarPromocion('PR006', 'Promocion de invierno', 'Descuento especial para la temporada de invierno');

/*EDITAR LA INFORMACIÓN DE UN CLIENTE.*/
DELIMITER //
CREATE PROCEDURE sp_EditarCliente(
    IN codcli CHAR(5), 
    IN ident VARCHAR(8), 
    IN nom VARCHAR(100),
    IN telef VARCHAR(100))
BEGIN
    UPDATE tb_cliente SET identificacion = ident, nombre = nom, telefono = telef 
    WHERE codigo_cliente = codcli;
END; //
-- CALL sp_EditarCliente('C0001', '77788899', 'Ana Lopez', '987123456');

-- EDITAR INFORMACION DE UNA INSCRIPCION
DELIMITER //
CREATE PROCEDURE sp_EditarInscripcion(
    IN codinscr CHAR(5), 
    IN numbol VARCHAR(11), 
    IN codcli VARCHAR(5),
    IN codserv VARCHAR(5), 
    IN codprom VARCHAR(5), 
    IN emi DATE, 
    IN cad DATE,
    IN prec DECIMAL(11,2),
    IN pag DECIMAL(11,2),
    IN codmet VARCHAR(5),
    IN deu DECIMAL(11,2),
    IN est VARCHAR(20))
BEGIN
    UPDATE tb_inscripcion 
    SET numboleta = numbol, 
        inscripcion_codigo_cliente = codcli, 
        inscripcion_codigo_servicio = codserv,
        inscripcion_codigo_promocion = codprom, 
        emision = emi, 
        caducidad = cad,
        precio = prec,
        pago = pag,
        inscripcion_codigo_metodo = codmet,
        deuda = deu,
        estado = est
    WHERE codigo_inscripcion = codinscr;
END; //
-- CALL sp_EditarInscripcion('I0002', '001001', 'C0002', 'S0002', 'PR002', '2024-04-02', '2024-05-02', 80.00, 70.00, 'M0002', 10.00, 'Vigente');

/*BUSCAR SERVICIO POR CODIGO*/
DELIMITER //
CREATE PROCEDURE sp_BuscarServicioPorCodigo(in codserv char(5))
BEGIN
	SELECT * FROM tb_servicio WHERE codigo_servicio = codserv;
END; //
-- CALL sp_BuscarServicioPorCodigo('S0001');

/*BUSCAR METODO POR CODIGO*/
DELIMITER //
CREATE PROCEDURE sp_BuscarMetodoPorCodigo(in codmet char(5))
BEGIN
	SELECT * FROM tb_metodo WHERE codigo_metodo = codmet;
END; //
-- CALL sp_BuscarMetodoPorCodigo('M0001');

/*BUSCAR PROMOCION POR CODIGO*/
DELIMITER //
CREATE PROCEDURE sp_BuscarPromocionPorCodigo(in codprom char(5))
BEGIN
	SELECT * FROM tb_promocion WHERE codigo_promocion = codprom;
END; //
-- CALL sp_BuscarPromocionPorCodigo('PR001');

/*BUSCAR CLIENTE POR CODIGO*/
DELIMITER //
CREATE PROCEDURE sp_BuscarClientePorCodigo(in codcli char(5))
BEGIN
	SELECT * FROM tb_cliente WHERE codigo_cliente = codcli;
END; //
-- CALL sp_BuscarClientePorCodigo('C0001');

/*BUSCAR INSCRIPCION POR CODIGO*/
DELIMITER //
CREATE PROCEDURE sp_BuscarInscripcionPorCodigo(in codinscr char(5))
BEGIN
	SELECT * FROM tb_inscripcion WHERE codigo_inscripcion = codinscr;
END; //
-- CALL sp_BuscarInscripcionPorCodigo('I0001');

/*BORRAR SERVICIO POR CODIGO*/
DELIMITER //
CREATE PROCEDURE sp_BorrarServicioPorCodigo(in codserv char(5))
BEGIN
	DELETE FROM tb_servicio WHERE codigo_servicio = codserv;
END; //
-- CALL sp_BorrarServicioPorCodigo('S0001');

/*BORRAR METODO POR CODIGO*/
DELIMITER //
CREATE PROCEDURE sp_BorrarMetodoPorCodigo(in codmet char(5))
BEGIN
	DELETE FROM tb_metodo WHERE codigo_metodo = codmet;
END; //
-- CALL sp_BorrarMetodoPorCodigo('M0001');

/*BORRAR PROMOCION POR CODIGO*/
DELIMITER //
CREATE PROCEDURE sp_BorrarPromocionPorCodigo(in codprom char(5))
BEGIN
	DELETE FROM tb_promocion WHERE codigo_promocion = codprom;
END; //
-- CALL sp_BorrarPromocionPorCodigo('PR001');

/*BORRAR CLIENTE POR CODIGO*/
DELIMITER //
CREATE PROCEDURE sp_BorrarClientePorCodigo(in codcli char(5))
BEGIN
	DELETE FROM tb_cliente WHERE codigo_cliente = codcli;
END; //
-- CALL sp_BorrarClientePorCodigo('C0001');

/*BORRAR INSCRIPCION POR CODIGO*/
DELIMITER //
CREATE PROCEDURE sp_BorrarInscripcionPorCodigo(in codinscr char(5))
BEGIN
	DELETE FROM tb_inscripcion WHERE codigo_inscripcion = codinscr;
END; //
-- CALL sp_BorrarInscripcionPorCodigo('I0001');

/*FILTRAR SERVICIOS POR NOMBRE*/
DELIMITER //
CREATE PROCEDURE sp_FiltrarServicio(in valor varchar(100))
BEGIN
	SELECT * FROM tb_servicio WHERE nombre LIKE(CONCAT('%', valor ,'%'));
END;//
-- CALL sp_FiltrarServicio('Sa');

/*FILTRAR METODO POR NOMBRE*/
DELIMITER //
CREATE PROCEDURE sp_FiltrarMetodo(in valor varchar(100))
BEGIN
	SELECT * FROM tb_metodo WHERE nombre LIKE(CONCAT('%', valor ,'%'));
END;//
-- CALL sp_FiltrarMetodo('Ya');

/*FILTRAR PROMOCION POR NOMBRE*/
DELIMITER //
CREATE PROCEDURE sp_FiltrarPromocion(in valor varchar(100))
BEGIN
	SELECT * FROM tb_promocion WHERE nombre LIKE(CONCAT('%', valor ,'%'));
END;//
-- CALL sp_FiltrarPromocion('mes');

/*FILTRAR CLIENTE POR NOMBRE*/
DELIMITER //
CREATE PROCEDURE sp_FiltrarCliente(in valor varchar(100))
BEGIN
	SELECT * FROM tb_cliente WHERE nombre LIKE(CONCAT('%', valor ,'%'));
END;//
-- CALL sp_FiltrarCliente('Y');

/*FILTRAR INSCRIPCION POR NOMBRE*/
DELIMITER //
CREATE PROCEDURE sp_FiltrarInscripcion(in valor varchar(100))
BEGIN
	SELECT 
        i.codigo_inscripcion,
        i.numboleta,
        c.nombre AS nombre_cliente,
        s.nombre AS nombre_servicio,
        p.nombre AS nombre_promocion,
        i.emision,
        i.caducidad,
        i.precio,
        i.pago,
        m.nombre AS nombre_metodo_pago,
        i.deuda,
        i.estado
    FROM 
        tb_inscripcion i
    INNER JOIN 
        tb_cliente c ON i.inscripcion_codigo_cliente = c.codigo_cliente
    INNER JOIN 
        tb_servicio s ON i.inscripcion_codigo_servicio = s.codigo_servicio
    INNER JOIN 
        tb_promocion p ON i.inscripcion_codigo_promocion = p.codigo_promocion
    INNER JOIN 
        tb_metodo m ON i.inscripcion_codigo_metodo = m.codigo_metodo
    WHERE 
        c.nombre
	LIKE(CONCAT('%', valor ,'%'));
END;//
-- CALL sp_FiltrarInscripcion('A');


DELIMITER $$
CREATE PROCEDURE sp_MostrarDetallesInscripcion()
BEGIN
    SELECT 
        i.codigo_inscripcion,
        i.numboleta,
        c.nombre AS cliente,
        s.nombre AS servicio,
        p.nombre AS promocion,
        i.emision AS fecha_emision,
        i.caducidad AS fecha_caducidad,
        i.precio,
        i.pago,
        mp.nombre AS metodo_pago,
        i.deuda,
        i.estado
    FROM 
        tb_inscripcion i
    JOIN 
        tb_cliente c ON i.inscripcion_codigo_cliente = c.codigo_cliente
    JOIN 
        tb_servicio s ON i.inscripcion_codigo_servicio = s.codigo_servicio
    JOIN 
        tb_promocion p ON i.inscripcion_codigo_promocion = p.codigo_promocion
    JOIN 
        tb_metodo mp ON i.inscripcion_codigo_metodo = mp.codigo_metodo
    ORDER BY 
        i.codigo_inscripcion;  -- Ordena por código de inscripción para mayor claridad
END$$
DELIMITER ;

-- call sp_MostrarDetallesInscripcion();

