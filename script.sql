create database ecommerce;
set sql_safe_updates=0;
use ecommerce;

create table cliente 
(
	id_cliente int primary key auto_increment,
	cpf_login int not null,
    nome varchar(255) not null,
    senha varchar(256)not null,
    email varchar(255) unique not null,
    foto_perfil varchar(255),
    nivel varchar(255)
);


create table endereco 
(
	id int primary key auto_increment,
    rua varchar(255),
	numero int,
	cidade varchar(255),
	estado varchar(2),
	cep varchar(9),
    id_cliente int,
    foreign key (id_cliente) references cliente(id_cliente) 	
			on delete cascade
			on update cascade
);

create table produto 
(
	id int auto_increment primary key,
	preco double,
	descricao varchar(255),
    estoque int,
    ativo int,
	foto varchar(255)
);

create table carrinho 
(
	id int auto_increment primary key,
    id_produto int,
		foreign key (id_produto) references produto(id),
    id_cliente int,
		foreign key (id_cliente) references cliente(id_cliente)
							on delete cascade
							on update cascade,
	quantidade int
);


create table pedido 
(
	id int auto_increment primary key,
    status_atualizacao varchar(155),
    forma_pagamento varchar(255),
	pedido_id_cliente int,
	foreign key (pedido_id_cliente) references cliente(id_cliente)
);

create table compra_itens 
(
	id int auto_increment primary key,
	id_produto int,
    id_pedido int,
	quantidade int,
	data_emissao datetime default now(),
	foreign key (id_produto) references produto(id),
    foreign key (id_pedido) references pedido(id)
);


create table funcionario
(
	numero_login int primary key,
    senha varchar(255),
    cpf int,
    nome varchar(255),
    email varchar(255),
    nivel_hierarquico enum('Funcionario_Comum','Administrador_Basico','Administrador_RH','Administrador_Supervisor'),
    cargo varchar(255),
    salario numeric(10,2)
);

create table arquivo
(
	id int primary key auto_increment,
	nome varchar(255),
	endereco varchar(255)
);

create table arquivo_funcionario
(
	id int primary key auto_increment,
	id_arquivo int,
    foreign key (id_arquivo) references arquivo(id) 	
			on delete cascade
			on update cascade,
    numero_login_funcionario_arquivo int,
    foreign key (numero_login_funcionario_arquivo) references funcionario(numero_login) 	
			on delete cascade
			on update cascade
);

create table arquivo_cliente
(
	id int primary key auto_increment,
	id_arquivo int,
    foreign key (id_arquivo) references arquivo(id) 	
			on delete cascade
			on update cascade,
    id_cliente_arquivo int,
    foreign key (id_cliente_arquivo) references cliente(id_cliente) 	
			on delete cascade
			on update cascade
);

create table arquivo_produto
(
	id int primary key auto_increment,
	id_arquivo int,
    foreign key (id_arquivo) references arquivo(id) 	
			on delete cascade
			on update cascade,
    id_produto_arquivo int,
    foreign key (id_produto_arquivo) references produto(id) 	
			on delete cascade
			on update cascade
);

create table atendimento 
(
	id int auto_increment primary key,
    atendimento_id_cliente int,
    numero_login_funcionario int NULL,
    pergunta varchar(255),
    resposta varchar(255) NULL,
    id_pedido int,
    foreign key (id_pedido) references pedido(id),
	foreign key (atendimento_id_cliente) references cliente(id_cliente),
    foreign key (numero_login_funcionario) references funcionario(numero_login)
);

-- inserts cliente
insert into cliente(cpf_login,nome,senha,email,foto_perfil, nivel) values(13064564,"rayana",sha2(1234,512),"rayana@gmail.com","", "cliente");
insert into endereco(rua,numero,cidade,estado,cep,id_cliente) values("funcoes",10,"porto","ba","45810000", last_insert_id());
insert into cliente(cpf_login,nome,senha,email, nivel) values(24864564,"daniel",sha2(1234,512),"daniel@gmail.com", "cliente");
insert into endereco(rua,numero,cidade,estado,cep,id_cliente) values("funcoes",5,"coroa","ba","45807000", last_insert_id());

insert into carrinho (id_produto, id_cliente, quantidade) values (1, 1, 10);
select * from cliente;
select * from carrinho;
-- outros inserts
insert into atendimento(atendimento_id_cliente,id_pedido,pergunta) values(13064564,1,"como?");
select * from pedido;
select * from compra_itens;

-- selects 
select * from funcionario;
select * from endereco;
select * from cliente;
select * from produto;
select * from pedido;
select * from compra_itens;
select * from atendimento;
select * from carrinho;
select * from arquivo;
select * from arquivo_funcionario;
select * from arquivo_cliente;
select * from arquivo_produto;
