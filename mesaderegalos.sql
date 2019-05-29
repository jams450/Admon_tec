create database mesaderegalos;
use mesaderegalos;

create table tipoevento
(
	idtipoevento int not null auto_increment,
    nombreevento varchar(15),
    primary key(idtipopago)
);
insert into tipoevento values(null,"Cumpleaños");
insert into tipoevento values(null,"Bautizo");
insert into tipoevento values(null,"Boda");
insert into tipoevento values(null,"XV Años");

create table clientes
(
	idcliente int not null auto_increment,
    nombre varchar(45) not null,
	appat varchar(45) not null,
	apmat varchar(45) not null,
    telefono varchar(10) not null,
    calle varchar(100) not null,
    noext varchar(30),
    noint varchar(30) not null,
    colonia varchar(50) not null,
    idmunidel int,
    primary key(idcliente)
);
alter table clientes add foreign key (idmunidel) references muni_del(idmunidel);

create table muni_del
(
	idmuni_del int not null auto_increment,
    muni_del varchar(60) not null,
    idestado int not null,
    primary key(idmuni_del)
);
alter table muni_del add foreign key (idestado) references estados(idestado);

create table estados
(
	idestado int not null,
    estado varchar(25),
    primary key(idestado)
);

create table eventos
(
	idevento int not null auto_increment,
    idtipoevento int not null,
    idcliente int not null,
    fechaevento date,
    fechacierre date,
    primary key(idevento,idtipoevento,idcliente)
);
alter table eventos add foreign key (idtipoevento) references tipoevento(idtipoevento);
alter table eventos add foreign key (idcliente) references clientes(idcliente);

create table mesaderegalos
(
	idmesa int not null auto_increment,
    idevento int not null,
    idarticulo int not null,
    primary key(idmesa,idevento,idarticulo)
);
alter table mesaderegalos add foreign key (idevento) references eventos(idevento);
alter table mesaderegalos add foreign key (idarticulo) references articulos(idarticulo);

create table articulos
(
	idarticulo int not null auto_increment,    
    idcategoria int not null,
    nombre varchar(50) not null,
    precio float,
    primary key(idarticulo,idcategoria)
);
alter table articulos add foreign key (idcategoria) references categoria_articulo(idarticulo);

create table categoria_articulo
(
	idcategoria int not null auto_increment,
    categoria varchar(50),
    primary key(idcategoria)
);