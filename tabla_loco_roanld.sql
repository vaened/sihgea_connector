create table loco_ronald(
	id_loco bigserial not null primary key,
	usuario varchar(20) not null default '',
	mensaje varchar(120) not null default '',
	estado char(1) not null default '0',
	f_registro timestamp NOT NULL DEFAULT current_timestamp,
	f_modifica timestamp NOT NULL DEFAULT current_timestamp,
	id_usi_crea varchar(35) NOT NULL default '2' ,
	id_usi_modi varchar(35) NOT NULL default '' ,
	activo char(1) not null DEFAULT '1'
);
