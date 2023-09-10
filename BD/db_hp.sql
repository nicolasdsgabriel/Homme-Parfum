create database if not exists db_hp;

use db_hp;

-- *TABLES*

-- Classe Perfume: Id, Nome, Marca e Preço

create table Produto(
	produtoId int not null primary key,
    produtoImg varchar(20),
    produtoNome varchar (50) not null,
    produtoMarca varchar (30) not null,
    produtoPreco float not null,
    produtoCor varchar(25),
    produtoFrg varchar(25),
    produtoTipo character
);

-- Classe Bolsa: id, Nome, Marca, Preco e Cor

create table Cliente(
	clienteId int not null primary key auto_increment,
    clienteCpf varchar(14) not null,
    clienteNome varchar (30) not null,
    clienteSenha varchar (30) not null,
    adm int not null
);

create table Pedido(
	pedidoId int not null primary key,
    data date,
    clienteId int not null,
    foreign key (clienteId) references Cliente(clienteId)
);

create table Carrinho(
	pedidoId int not null,
    produtoId int not null,
    primary key (pedidoId, produtoId),
    foreign key (pedidoId) references Pedido(pedidoId),
    foreign key (produtoId) references Produto(produtoId),
    qtd int
);

-- *INSERTS*

insert into Produto(produtoId, produtoImg, produtoNome, produtoMarca, produtoPreco, produtoCor, produtoFrg, produtoTipo)
values
(1, 'img/medusablack.avif', 'MEDUSA BIGGIE BACKPACK',  'VERSACE',  12900.00, 'Preto',null, 'b'),
(2, 'img/VERSACE.avif', 'VERSACE ALLOVER DENIM TOTE BAG', 'VERSACE', 14100.00, 'Azul com grenã',null, 'b'),
(3, 'img/allover.avif', 'VERSACE ALLOVER CROSSBODY BAG', 'VERSACE', 7400.00, 'Azul e branco',null, 'b'),
(4, 'img/masc.avif', 'VERSACE ALLOVER SMALL MESSENGER BAG', 'VERSACE', 7650.00, 'Azul',null, 'b'),
(5,'img/blacklabel.avif', 'BLACK LABEL OUD', 'MONOTHEME', 314.00, null, 'Amadeirado Medio', 'p'),
(6, 'img/blazing.avif', 'HE BLAZING MISTER SAM', "PENHALIGON'S", 2300.00, null, 'Amadeirado Marcante', 'p'),
(7, 'img/eros.avif', 'EROS', 'VERSACE', 529.00, null, 'Amadeirado Marcante', 'p'),
(8, 'img/gentleman.avif', 'GENTLEMAN SOCIETY', 'GIVENCHY', 589.00, null, 'Amadeirado Moderado', 'p'),
(9, 'img/guiltypour.avif', 'GUILTY POUR', 'GUCCI', 689.00, null, 'Frescor fraco', 'p'),
(10, 'img/hero.avif', 'HERO', 'BURBERRY', 739.00, null, 'Amadeirado Medio', 'p'),
(11, 'img/legend.avif', 'LEGEND', 'MONTBLANC', 539.00, null, 'Frescor Marcante', 'p'),
(12, 'img/old.avif', 'GOLD', 'ANIMALE', 414.00, null, 'Amadeirado Medio', 'p');

insert into cliente(clienteCpf, clienteNome, clienteSenha, adm)
	values('527.050.928-89','Weslly', '123', 1);

-- *USERS*
-- *TRIGGERS*
-- *VIEWS*