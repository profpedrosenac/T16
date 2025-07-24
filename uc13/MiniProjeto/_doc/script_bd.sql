create database t16_miniprojeto;

use t16_miniprojeto;

create table usuario
(
	id_usuario int not null auto_increment primary key ,
	nome_usuario varchar(50) not null  ,
	login_usuario varchar(30) not null unique ,
	senha_usuario varchar(30) not null  ,
	foto_usuario varchar(255) null  ,
	funcao_usuario varchar(50) not null  ,
	cad_usuario timestamp not null  ,
	obs_usuario varchar(255) null  ,
	status_usuario varchar(30) not null  
);

create table categoria
(
	id_categoria int not null auto_increment primary key ,
	nome_categoria varchar(50) not null unique ,
	descricao_categoria varchar(255) not null  ,
	obs_categoria varchar(255) null  ,
	status_categoria varchar(30) not null  
);

create table produto
(
	id_produto int not null auto_increment primary key ,
	id_categoria_produto int not null  ,
	nome_produto varchar(100) not null  ,
	valor_custo decimal(10,2) not null  ,
	valor_venda decimal(10,2) not null  ,
	qtde_produto int not null  ,
	obs_produto varchar(255) null  ,
	status_produto varchar(30) not null  
);

create table Movimentacao
(
	id_movimentacao int not null auto_increment primary key ,
	id_usuario_movimentacao int not null  ,
	id_produto_movimentacao int not null  ,
	data_movimentacao timestamp not null  ,
	tipo_movimentacao varchar(30) not null  ,
	qtde_movimentacao int not null  ,
	obs_movimentacao varchar(255) null  ,
	status_movimentacao varchar(30) not null  
);

create table Fornecedor
(
	id_fornecedor int not null auto_increment primary key ,
	nome_fornecedor varchar(100) not null  ,
	cnpj_fornecedor varchar(18) not null  ,
	email_fornecedor varchar(100) not null  ,
	telefone_fornecedor varchar(20) not null  ,
	endereco_rua varchar(100) not null  ,
	endereco_numero varchar(10) not null  ,
	endereco_complemento varchar(50) not null  ,
	endereco_bairro varchar(50) not null  ,
	endereco_cidade varchar(50) not null  ,
	endereco_estado varchar(2) not null  ,
	endereco_cep varchar(9) not null  ,
	cad_fornecedor timestamp not null  ,
	obs_fornecedor varchar(255) null  ,
	status_fornecedor varchar(30) not null  
)


select * from usuario;
select * from categoria;
select * from produto;
select * from movimentacao;
select * from fornecedor;

alter table produto 
add constraint FK_id_categoria_produto foreign key (id_categoria_produto) references categoria (id_categoria);

alter table movimentacao
add constraint FK_id_usuario_movimentacao foreign key (id_usuario_movimentacao) references usuario (id_usuario); 

alter table movimentacao
add constraint FK_id_produto_movimentacao foreign key (id_produto_movimentacao) references produto (id_produto);

insert into usuario
(nome_usuario, login_usuario, senha_usuario, funcao_usuario, status_usuario)
values
('Administrador do Sistema', 'admin', '123', 'Administrador', 'Ativo')










