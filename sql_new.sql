CREATE DATABASE Schemashapers_HimalayaStore;
USE Schemashapers_HimalayaStore;

DROP TABLE IF EXISTS vandors;
CREATE TABLE vendors (
	vendor_id VARCHAR(20) PRIMARY KEY,
    vendor_name VARCHAR(40),
	vendor_phone VARCHAR(15),
    vendor_email VARCHAR(50),
    vendor_address VARCHAR(50)
);
drop table if exists products;
create table products (
    product_id int not null unique primary key,
    product_name varchar(40),
    product_category varchar(40),
    price double(5,2),
    vendor_id VARCHAR(30),
    FOREIGN KEY (vendor_id) REFERENCES vendors(vendor_id)
);
drop table if exists customers;
create table customers (
    customer_id int not null unique primary key,
    first_name varchar(40),
    last_name varchar(40),
    customer_email varchar(40) unique,
    customer_phone varchar(15) unique,
    address VARCHAR(100) NOT NULL
);
drop table if exists technicians;
create table technicians (
    technician_id int not null unique primary key,
    first_name varchar(40),
    last_name varchar(40),
    specialization varchar(40),
    technician_phone varchar(15) unique
);
drop table if exists orders;
create table orders (
    order_id int not null unique primary key,
    customer_id int not null,
    technician_id int not null,
    order_total double(7,2),
    order_date date,
    foreign key (customer_id) references customers(customer_id),
    foreign key (technician_id) references technicians(technician_id)
);
drop table if exists order_items;
create table order_items (
	order_item_id int not null unique primary key,
    order_id int not null,
    product_id int not null,
    quantity int,
    items_price double(7,2),
    foreign key (order_id) references orders(order_id),
	foreign key (product_id) references products(product_id)
);









