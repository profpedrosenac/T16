-- criação de base de dados
create database t16_ex01

-- comando para usar o banco de dados
use t16_ex01

-- comando para criar tabelas
create table Produto
(
	id_produto int not null identity primary key,
	nome_produto varchar(50) not null,
	valor_produto decimal(10,2) not null,
	qtde_produto int not null,
	obs_produto varchar(255) null,
	status_produto varchar(30) not null default 'ATIVO'
)
-- comando para retornar uma consulta do BD
select * from Produto

-- comando para excluir a tabela
drop table Produto

create table ItemCompra
(
	id_itemCompra	int	not null	identity	primary key,
	id_produto_itemCompra	int	not null,
	id_compra_itemCompra	int	not null,
	valor_itemCompra	decimal(10,2)	not null,
	qtde_itemCompra	int	not null,
	obs_itemCompra	varchar(255)	null,
	status_itemCompra	varchar(30)	not null	default 'ATIVO'
)
select * from ItemCompra

create table Compra
(
	id_compra int not null identity primary key,
	id_fornecedor_compra int not null  ,
	nf_compra varchar(30) not null  ,
	data_Compra smalldatetime not null  ,
	total_compra decimal(10,2) not null  ,
	itens_compra int not null  ,
	formaPagamento_compra varchar(30) not null  ,
	obs_compra varchar(255) null  ,
	status_compra varchar(30) not null default 'ATIVO'
)
select * from Compra

create table Fornecedor
(
	id_fornecedor int not null identity primary key,
	nome_Fornecedor varchar(50) not null  ,
	cnpj_Fornecedor char(18) not null  ,
	logradouro_Fornecedor varchar(50) not null  ,
	numero_Fornecedor int not null  ,
	complemento_Fornecedor varchar(50) not null  ,
	cep_Fornecedor char(9) not null  ,
	bairro_Fornecedor varchar(50) not null  ,
	cidade_Fornecedor varchar(50) not null  ,
	uf_Fornecedor char(2) not null  ,
	telefone1_Fornecedor char(15) not null  ,
	telefone2_Fornecedor char(15) not null  ,
	email_Fornecedor varchar(50) not null  ,
	site_Fornecedor varchar(50) not null  ,
	contato1_Fornecedor varchar(50) not null  ,
	contato2_Fornecedor varchar(50) not null  ,
	descrição_Fornecedor varchar(255) not null , 
	obs_Fornecedor varchar(255) null  ,
	status_Fornecedor varchar(30) not null default 'ATIVO' 
)

select * from Fornecedor

-- criando as FK de todas as tabelas

alter table itemcompra add
constraint FK_id_produto_itemCompra
foreign key (id_produto_itemCompra) references produto (id_produto)

alter table itemcompra add
constraint FK_id_compra_itemCompra
foreign key (id_compra_itemCompra) references compra (id_compra)

alter table compra add
constraint FK_id_fornecedor_compra
foreign key (id_fornecedor_compra) references fornecedor (id_fornecedor)