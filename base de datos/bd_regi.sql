Create database BD_REGI;
USE BD_REGI;

create table roles (
idrol bigint primary key auto_increment,
nombre_rol varchar (30) ,
desc_rol varchar (50) ,
fecha_rol date ,
Habilitar_desahabilitar set ('enable', 'disable')
)engine=InnoDB
character set utf8
collate utf8_unicode_ci;

create table modulos (
idmodulo bigint primary key auto_increment,
nombre_modulos varchar(30) not null,
descmodulo varchar (30) not null,
fecha_modulo date not null,
Habilitar_desahabilitar set ('enable', 'disable') 
)engine=InnoDB
character set utf8
collate utf8_unicode_ci;

create table estados (
idestado bigint  (20) primary key auto_increment,
estado varchar (45) not null
)engine=InnoDB
character set utf8
collate utf8_unicode_ci;

Create table paramentros(
idparamentros bigint (20) not null
)engine=InnoDB
character set utf8
collate utf8_unicode_ci;

Create table permisos (
idpermiso bigint(20) not null,
idrol  bigint ,
permiso_insertar int (20) not null,
permiso_eliminar int (20) not null,
permiso_actualizar int (20) not null,
foreign key (idrol) references Roles (idrol) on delete cascade
)engine=InnoDB
character set utf8
collate utf8_unicode_ci;

create table usuarios(
idusuario bigint primary key auto_increment,
idrol bigint,
idestado bigint,
nombre_usuario varchar (30) not null,
contra_usuario varchar (20) not null,
correo_usuario varchar (30) not null,
tele_usuario varchar (30) not null,
direccion_usuario varchar (30) not null,
apellido_usuario varchar (30) not null,
identidad_usuario varchar (20) not null,
apodo_usuario varchar (20) not null,
token varchar (120) not null ,
intento_fallidos int (20),
fecha_ingreso datetime not null,
foreign key (idrol) references roles (idrol) on delete cascade,
foreign key (idestado) references estados (idestado) on delete cascade
)engine=InnoDB
character set utf8
collate utf8_unicode_ci; 

/*Servicios */
Create table Servicios(
idservicio bigint primary key auto_increment,
nombre_servicio varchar (30) not null,
desc_servicio varchar (255) not null,
cost_servicio numeric not null,
fech_inicio date not null,
fech_final date not null,
actualizado_por varchar (30)
)engine=InnoDB character set utf8 collate utf8_unicode_ci;

create table pagos(
idpago bigint primary key auto_increment,
idusuario bigint,
idservicio bigint,
iddeudor bigint,
fecha_pago date not null,
no_registro_banco varchar (20) not null,
comprobante VARCHAR(255) not null,
monto int(20) not null,
cuenta_depositar int(20) not null,
foreign key (idusuario) references Usuarios (idusuario) on delete cascade,
foreign key (idservicio) references servicios (idservicio) on delete cascade
)engine=InnoDB character set utf8 collate utf8_unicode_ci;

create table estadoscuenta(
idestado bigint primary key auto_increment,
idpago bigint,
desc_estado varchar (30),
foreign key (idpago) references pagos (idpago) on delete cascade
)engine=InnoDB character set utf8 collate utf8_unicode_ci;

create table historial_pago(
idhistorial bigint primary key auto_increment,
idpago bigint,
idestado bigint,
foreign key (idpago) references pagos (idpago) on delete cascade,
foreign key (idestado) references estadoscuenta(idestado) on delete cascade
)engine=InnoDB character set utf8 collate utf8_unicode_ci;

CREATE TABLE adelantos (
    idadelanto BIGINT PRIMARY KEY AUTO_INCREMENT,
    idusuario BIGINT,
    idservicio BIGINT,
    idpagos BIGINT,
    monto_total INT(20) NOT NULL,
    monto_restante INT(20) NOT NULL,
    fecha_adelanto DATE NOT NULL,
    FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario) ON DELETE CASCADE,
    FOREIGN KEY (idservicio) REFERENCES Servicios (idservicio) ON DELETE CASCADE,
    FOREIGN KEY (idpagos) REFERENCES pagos (idpago) ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE deudores (
    iddeudor BIGINT PRIMARY KEY AUTO_INCREMENT,
    idusuario BIGINT,
    idservicio BIGINT,
    monto_pendiente INT NOT NULL,
    fecha_deuda Date not null,
    FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario) ON DELETE CASCADE,
    FOREIGN KEY (idservicio) REFERENCES servicios (idservicio) ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

/* Notificaciones */
create table tipo_notificacion (
idtipo bigint primary key auto_increment,
des_not varchar (30)
)engine=InnoDB character set utf8 collate utf8_unicode_ci;

create table notificacion (
idnotificacion bigint primary key auto_increment,
idtipo bigint,
idusuario bigint,
idpago bigint,
idservicio bigint,
usuarioR varchar (30),
usuarioE varchar (30),
estado boolean,
fecha date ,
foreign key (idpago) references pagos (idpago) on delete cascade,
foreign key (idtipo) references tipo_notificacion (idtipo) on delete cascade
)engine=InnoDB character set utf8 collate utf8_unicode_ci;


/*publicaciones */
create table publicaciones (
idpublicacion bigint primary key auto_increment,
idusuario bigint,
tit_publicacion varchar (50),
desc_publicacion varchar (100),
fec_publicacion date,
foreign key (idusuario) references usuarios (idusuario) on delete cascade
)engine=InnoDB character set utf8 collate utf8_unicode_ci;


/*Procedimientos Almacenados */

/* Ver Usuarios*/
delimiter $$
create procedure VerUsuario ()
begin 
select*from usuarios;
end$$
/*Nuevo Usuario*/
delimiter $$
Create procedure NuevoUsuario(
in idrol bigint,
in idestado bigint,
in nombre_usuario varchar (30),
in contra_usuario varchar (20),
in correo_usuario varchar (30),
in tele_usuario varchar (30),
in direccion_usuario varchar (30),
in apellido_usuario varchar (30),
in identidad_usuario varchar (20),
in apodo_usuario varchar (20),
in token varchar (120) ,
in intento_fallidos int (20),
in fecha_ingreso datetime
)
begin 
INSERT INTO usuarios (idrol, idestado, nombre_usuario, contra_usuario, 
correo_usuario, tele_usuario, direccion_usuario, apellido_usuario,identidad_usuario,
 apodo_usuario, token, intento_fallidos,fecha_ingreso)
values (idrol, idestado, nombre_usuario, contra_usuario, 
correo_usuario, tele_usuario, direccion_usuario, apellido_usuario,identidad_usuario,
 apodo_usuario, token, intento_fallidos,fecha_ingreso);
 end$$
 
/*Eliminar Usuarios*/
delimiter $$ 
create procedure EliminarUsuario( in id bigint)
begin 
delete from usuarios where id= idusuario;
end$$

/*Actualizar Usuario*/
delimiter $$
Create procedure ActualizarUsuarios(
in id bigint,
in idrol bigint,
in idestado bigint,
in nombre_usuario varchar (30),
in contra_usuario varchar (20),
in correo_usuario varchar (30),
in tele_usuario varchar (30),
in direccion_usuario varchar (30),
in apellido_usuario varchar (30),
in identidad_usuario varchar (20),
in apodo_usuario varchar (20),
in token varchar (120) ,
in intento_fallidos int (20)
)
begin 
UPDATE usuarios SET idrol=idrol, idestado=idestado, nombre_usuario=nombre_usuario, contra_usuario=contra_usuario, 
correo_usuario=correo_usuario, tele_usuario=tele_usuario, direccion_usuario=direccion_usuario, apellido_usuario=apellido_usuario,identidad_usuario=identidad_usuario,
 apodo_usuario=apodo_usuario, token=token, intento_fallidos=intento_fallidos WHERE id=idusuario;
end$$


DELIMITER $$
/*porceso para eliminar los datos del deudor despues del pago*/
CREATE PROCEDURE EliminarDeudoresPagado()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE idpago_temp INT;

    -- Cursor para obtener los idpagos de pagos con desc_estado 'Pagado'
    DECLARE cur CURSOR FOR
        SELECT p.idpago
        FROM pagos p
        INNER JOIN estadoscuenta e ON p.idpago = e.idpago
        WHERE e.desc_estado = 'Pagado';

    -- Manejo de excepciones
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO idpago_temp;

        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Eliminar deudores que coincidan con el idpago_temp y el idusuario de pagos
        DELETE FROM deudores
        WHERE iddeudor IN (SELECT iddeudor FROM pagos WHERE idpago = idpago_temp)
        AND iddeudor = (SELECT iddeudor FROM pagos WHERE idpago = idpago_temp);
    END LOOP;

    CLOSE cur;
END$$


DELIMITER $$
/*activa automaticamente el proceso*/
CREATE EVENT eliminar_deudores
ON SCHEDULE EVERY 10 SECOND
DO
    CALL EliminarDeudoresPagado();
END$$

DELIMITER //
SET GLOBAL event_scheduler = ON;
//


delimiter $$
/*porceso de almacenado para guardar los datos del adelanto*/
CREATE PROCEDURE InsertarAdelanto(IN p_idpago BIGINT)
BEGIN
    DECLARE servicio_id BIGINT;
    DECLARE monto_pago INT;
    DECLARE servicio_nombre VARCHAR(30);
    DECLARE fecha_pag date;
    
    -- Obtener el id de servicio, el monto de pago y el nombre del servicio
    SELECT servicios.idservicio, monto, nombre_servicio, fecha_pago
    INTO servicio_id, monto_pago, servicio_nombre, fecha_pag
    FROM pagos
    JOIN servicios ON pagos.idservicio = servicios.idservicio
    WHERE pagos.idpago = p_idpago;

    -- Insertar en la tabla adelantos solo si el nombre del servicio es "adelanto"
    IF servicio_nombre = 'adelanto' THEN
        INSERT INTO adelantos (idusuario, idpagos, monto_total, monto_restante, fecha_adelanto)
        VALUES (
            (SELECT idusuario FROM pagos WHERE idpago = p_idpago),
            p_idpago, monto_pago, monto_pago, fecha_pag
        );
    END IF;
END $$


DELIMITER $$
/*trigger de insertar pago en adelantos*/
CREATE TRIGGER insert_adelanto
AFTER INSERT
ON pagos FOR EACH ROW
BEGIN
    CALL InsertarAdelanto(NEW.idpago);
END$$



DELIMITER $$
/*proceso para insertar los pagos en usuarios en deudas*/
CREATE PROCEDURE CrearDeuda(IN p_idservicio BIGINT)
BEGIN
    DECLARE monto_pendiente INT;
    DECLARE fecha_inicio DATE;

    -- Obtener el monto del servicio y la fecha de inicio
    SELECT cost_servicio, fech_inicio
    INTO monto_pendiente, fecha_inicio
    FROM servicios
    WHERE idservicio = p_idservicio;

    -- Insertar en la tabla deuda solo si el nombre del servicio no es "adelanto"
    IF (SELECT nombre_servicio FROM servicios WHERE idservicio = p_idservicio) <> 'adelanto' THEN
        INSERT INTO deudores (idusuario, idservicio, monto_pendiente, fecha_deuda)
        SELECT idusuario, p_idservicio, monto_pendiente, fecha_inicio
        FROM usuarios;
    END IF;

END $$


DELIMITER $$
/*al crear un pago inserta el idpago, y escribe en desc_estado no pagado*/
CREATE TRIGGER insert_pago_estado
AFTER INSERT
ON pagos FOR EACH ROW

BEGIN
    INSERT INTO estadoscuenta (idpago, desc_estado)
    VALUES (NEW.idpago, 'No Pagado');
END$$
