CREATE TABLE colaborador_empresa_area (
  id int not null,
  colaborador_id int not null,
  empresa_area_id int not null,
  PRIMARY KEY (id),
  FOREIGN KEY(colaborador_id) REFERENCES colaboradores(id),
  FOREIGN KEY(empresa_area_id) REFERENCES empresa_areas(id)
)engine=INNODB;