
--
--		Project:		Inmob
--		Description:	Sitio de Negocios Inmobiliarios
--



--
--		Entity:		Propiedad
--		Description:	Propiedad
--


drop table if exists inmob_propiedades;


create table inmob_propiedades (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		Domicilio varchar(200),
		Metros int,
		Ambientes int,
		IdTipo int,
		Descripcion text,
		Precio int,
		IdMoneda int,
		Operacion int,
		IdZona int,
		IdInmobiliaria int,
		Notas text,
		Habilitada tinyint(4),
		AceptaComentarios tinyint(4),
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		ImagenPropiedad
--		Description:	Imagen de Propiedad
--


drop table if exists inmob_propiedadimagenes;


create table inmob_propiedadimagenes (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		Descripcion text,
		NombreArchivo varchar(200),
		Uuid varchar(200),
		IdPropiedad int,
		Notas text,
		Principal tinyint(4),
		Habilitada tinyint(4),
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		Zona
--		Description:	Zona
--


drop table if exists inmob_zonas;


create table inmob_zonas (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		IdZonaPadre int,
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		Inmobiliaria
--		Description:	Inmobiliaria
--


drop table if exists inmob_inmobiliarias;


create table inmob_inmobiliarias (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		Domicilio varchar(200),
		Descripcion text,
		Contacto text,
		Notas text,
		IdInmobiliaria int,
		Habilitada tinyint(4),
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		Moneda
--		Description:	Moneda
--


drop table if exists inmob_monedas;


create table inmob_monedas (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		Simbolo varchar(10),
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		Comentario
--		Description:	Comentario
--


drop table if exists inmob_comentarios;


create table inmob_comentarios (
		Id int NOT NULL auto_increment,
		Texto text,
		IdPropiedad int,
		IdUser int,
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		User
--		Description:	Usuario
--


drop table if exists inmob_users;


create table inmob_users (
		Id int NOT NULL auto_increment,
		UserName varchar(16),
		Password varchar(200),
		FirstName varchar(40),
		LastName varchar(40),
		Email varchar(100),
		Genre varchar(20),
		IsAdministrator tinyint(4),
		DateTimeInsert datetime,
		DateTimeUpdate datetime,
		DateTimeLastLogin datetime,
		LoginCount int(11),
		Habilitado tinyint(4),
		Notas text,
		IdInmobiliaria int,
		EsAdmInmobiliaria tinyint(4),
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		TipoPropiedad
--		Description:	Tipo de Propiedad
--


drop table if exists inmob_tipospropiedad;


create table inmob_tipospropiedad (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		Evento
--		Description:	Evento
--


drop table if exists inmob_eventos;


create table inmob_eventos (
		Id int NOT NULL auto_increment,
		Tipo varchar(4),
		IdParametro int,
		IdUsuario int,
		FechaHora datetime,
		primary key (Id)
) TYPE=InnoDB;


--
--		Entity:		Agente
--		Description:	Agente
--


drop table if exists inmob_agentes;


create table inmob_agentes (
		Id int NOT NULL auto_increment,
		Nombre varchar(200),
		Contacto text,
		Notas text,
		NombreArchivo varchar(200),
		Uuid varchar(200),
		IdInmobiliaria int,
		primary key (Id)
) TYPE=InnoDB;

