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

