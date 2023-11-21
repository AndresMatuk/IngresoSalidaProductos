create database Ingreso_Salida_Productos;
use Ingreso_Salida_Productos;
create table productos (
	id_producto int auto_increment not null primary key,
    nombreProducto varchar(40) not null,
    precio int not null,
    cantidad int not null,
    fechaRegistro datetime
);
create table ingreso (
	id_ingreso int auto_increment not null primary key,
    FK_id_producto int not null,
    nombreProducto varchar(40) not null,
    precio int not null,
    cantidadIngreso int not null,
    fechaIngreso datetime
);
create table ventas (
	id_ventas int auto_increment not null primary key,
	FK_id_producto int not null,
    cantidadVenta int not null,
    fecha_venta datetime
);

explain productos;
explain ventas;
explain ingreso;

alter table ventas add foreign key (FK_id_producto) references productos(id_producto);
alter table ingreso add foreign key (FK_id_producto) references productos(id_producto);

INSERT INTO productos (nombreProducto, precio, cantidad, fechaRegistro) VALUES
('Libro', 12.75, 30, '2023-11-13 17:00:00');

INSERT INTO ingreso (FK_id_producto, nombreProducto, precio, cantidadIngreso, fechaIngreso) VALUES
(2, 'jabón', 2.5, 50, '2023-11-17 14:00:00');

select * from productos;
select * from ingreso;
select * from ventas;
SELECT FK_id_producto from Ingreso where FK_id_producto= 3;

ALTER TABLE ventas CHANGE cantidadVenta cantidad int;

DELETE FROM productos WHERE (id_producto = 9);

insert into ventas(fk_id_producto, cantidad, fecha_venta) values 
(2,10,'2023-11-17 14:00:00');
