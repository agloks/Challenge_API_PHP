CREATE DATABASE webjump_challenge;
use webjump_challenge;

CREATE TABLE categories(
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    code int(10) NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT uc_code UNIQUE (code)
); 

CREATE TABLE products(
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    sku int NOT NULL,
    price int(10) DEFAULT 0,
    quantity int(10) DEFAULT 0,
    description varchar(255),
    categories int,
    PRIMARY KEY (id),
    CONSTRAINT uc_name_sku UNIQUE (name, sku),
    CONSTRAINT fk_description FOREIGN KEY (categories) REFERENCES categories(code)
);

CREATE TABLE desafio(
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(255),
    sku varchar(255),
    descricao varchar(255),
    quantidade int(10),
    preco decimal(20,2),
    categoria varchar(255),
    PRIMARY KEY (id)
);

INSERT INTO categories(name, code) VALUES('Categorie 1', '1201');
INSERT INTO categories(name, code) VALUES('Categorie 2', '1202');
INSERT INTO categories(name, code) VALUES('Categorie 3', '1203');
INSERT INTO categories(name, code) VALUES('Categorie 4', '1204');

INSERT INTO products(name, sku, price, quantity, description, categories) values (
    'default_one', 8021, 721, 10, 'awesome', 1201
);
INSERT INTO products(name, sku, price, quantity, description, categories) values (
    'default_two', 8022, 722, 11, 'awesome', 1202
);
INSERT INTO products(name, sku, price, quantity, description, categories) values (
    'default_three', 8023, 723, 12, 'awesome', 1203
);
INSERT INTO products(name, sku, price, quantity, description, categories) values (
    'default_four', 8024, 724, 13, 'awesome', 1204
);

load data local infile './pyd.csv' into table desafio fields terminated by ',' enclosed by '"' lines terminated by '\n' ignore 1 rows;
