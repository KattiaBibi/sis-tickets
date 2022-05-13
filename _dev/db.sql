CREATE TABLE empresa (
  id int not null,
  ruc char(11) not null,
  razon_social varchar(100) not null,
  direccion varchar(100) not null,
  telefono varchar(20),
  email varchar(30),
  color varchar(7) not null,
  estado boolean not null default 1,
  created_at datetime,
  updated_at datetime,
  PRIMARY KEY(id)
)engine=INNODB;

CREATE TABLE area (
  id int not null,
  descripcion varchar(100) not null,
  created_at datetime,
  updated_at datetime,
  PRIMARY KEY(id)
);

CREATE TABLE empresa_area (
  id int not null,
  id_empresa int not null,
  id_area int not null,
  created_at datetime,
  updated_at datetime,
  PRIMARY KEY(id),
  FOREIGN KEY(id_empresa) REFERENCES empresa(id),
  FOREIGN KEY(id_area) REFERENCES area(id),
);

CREATE TABLE rol_usuario (
  id int not null,
);

CREATE TABLE usuario (
  id int not null,
  numero_documento varchar(20) not null,
  nombres varchar(50) not null,
  apellidos varchar(100) not null,
  id_empresa_area int not null,
  email varchar(50) not null,
  password_hash varchar(255) not null,
  tiene_acceso boolean not null default 1,
  estado boolean int not null default 1,
  created_at datetime,
  updated_at datetime,
  PRIMARY KEY(id)
);

CREATE TABLE requerimiento (
  id int not null,
  titulo varchar(100) not null,
  descripcion varchar(255),
  avance int not null default 0,
  enum('pendiente', 'en espera', 'en proceso', 'culminado', 'cancelado') not null,
  id_registrado_por int not null,
  id_empresa_designada int not null,
  created_at datetime,
  updated_at datetime,
  PRIMARY KEY(id),
  FOREIGN KEY(id_registrado_por) REFERENCES usuario(id) ,
  FOREIGN KEY(id_empresa_designada) REFERENCES empresa(id)
)engine=INNODB;

CREATE TABLE colaborador_requerimiento (
  id int not null,
  requerimiento int not null,
  id_colaborador int not null,
  created_at datetime,
  updated_at datetime,
  PRIMARY KEY(id),
  FOREIGN KEY(id_colaborador) REFERENCES usuario(id),
  FOREIGN KEY(requerimiento) REFERENCES requerimiento(id)
)engine=INNODB;

CREATE TABLE gerente_requerimiento (
  id int not null,
  id_requerimiento int not null,
  gerente int not null,
  created_at datetime,
  updated_at datetime,
  PRIMARY KEY(id),
  FOREIGN KEY(gerente) REFERENCES usuario(id),
  FOREIGN KEY(id_requerimiento) REFERENCES requerimiento(id)
)engine=INNODB;