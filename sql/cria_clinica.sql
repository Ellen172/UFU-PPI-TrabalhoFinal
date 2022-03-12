/*Se houver algum schema de clinica ele será deletado*/
DROP SCHEMA clinica CASCADE;
/*Criamos o schema*/
CREATE SCHEMA clinica;
SET search_path TO clinica;

--PESSOA
create table pessoa
(
    /* CHAVE PRIMARIA */
    id_pessoa serial, 
    /* ATRIBUTOS */
    nome varchar(100) not null,
    sexo char not null,
    email varchar(50),
    telefone varchar(20),
    cep char(10) not null,
    logradouro varchar(100),
    cidade varchar(50) not null,
    estado char(2) not null,
    primary key (id_pessoa)
);

--FUNCIONARIO
create table funcionario
(
    /* CHAVE PRIMARIA */
    id_funcionario int not null, 
    /* ATRIBUTOS */
    data_contrato date not null,
    salario decimal not null,
    senhaHash varchar(100),
    foreign key (id_funcionario) references pessoa(id_pessoa),
    primary key (id_funcionario)
    on delete cascade
);

--PACIENTE
create table paciente
(
    /* CHAVE PRIMARIA */
    id_paciente int, 
    /* ATRIBUTOS */
    peso decimal not null,
    altura decimal not null,
    tipoSanguineo char(3),
    primary key (id_paciente),
    foreign key (id_paciente) references pessoa(id_pessoa)
    on delete cascade,
);

--MEDICO
create table medico
(
    /* CHAVE PRIMARIA */
    id_medico int, 
    /* ATRIBUTOS */
    especialidade varchar(100) not null,
    crm varchar(50),
    primary key (id_medico),
    foreign key (id_medico) references funcionario(id_funcionario)
    on delete cascade
);

--ENDERECO
create table endereco
(
    /* CHAVE PRIMARIA */
    id_endereco serial, 
    /* ATRIBUTOS */
    cep char(10) not null,
    logradouro varchar(100),
    cidade varchar(50) not null,
    estado char(2) not null,
    primary key (id_endereco)
);

--AGENDA
create table agenda
(
    /* CHAVE PRIMARIA */
    id_agenda serial, 
    /* CHAVE ESTRANGEIRA */
    id_medico int not null,
    /* ATRIBUTOS */
    dia date not null,
    horario time not null,
    nome varchar(100) not null,
    sexo char not null,
    email varchar(50),
    primary key (id_agenda),
    foreign key(id_medico) references medico(id_medico)
);

