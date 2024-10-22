CREATE DATABASE IF NOT EXISTS music CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE music;

CREATE TABLE IF NOT EXISTS users (
    id INT(255) NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    image VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    CONSTRAINT pk_users PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS categories (
    id INT(255) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    CONSTRAINT pk_categories PRIMARY KEY(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS albums (
    id INT(255) NOT NULL AUTO_INCREMENT,
    category_id INT(255) NOT NULL,
    title VARCHAR(50) NOT NULL,
    artist VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    stock INT(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    release_date DATE NOT NULL,
    image VARCHAR(255) NOT NULL,
    CONSTRAINT pk_albums PRIMARY KEY(id),
    CONSTRAINT fk_albums_category FOREIGN KEY(category_id) REFERENCES categories(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS singles (
    id INT(255) NOT NULL AUTO_INCREMENT,
    album_id INT(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    duration VARCHAR(255) NOT NULL,
    music_file VARCHAR(255) NOT NULL,
    CONSTRAINT pk_singles PRIMARY KEY(id),
    CONSTRAINT fk_singles_album FOREIGN KEY(album_id) REFERENCES albums(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS orders (
    id INT(255) NOT NULL AUTO_INCREMENT,
    user_id INT(255) NOT NULL,
    status BOOLEAN NOT NULL,
    order_date DATE NOT NULL,
    total_cost DOUBLE(10,2) NOT NULL,
    CONSTRAINT pk_orders PRIMARY KEY(id),
    CONSTRAINT fk_orders_user FOREIGN KEY(user_id) REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS order_lines (
    id INT(255) NOT NULL AUTO_INCREMENT,
    order_id INT(255) NOT NULL,
    album_id INT(255) NOT NULL,
    quantity INT(255) NOT NULL,
    CONSTRAINT pk_order_lines PRIMARY KEY(id),
    CONSTRAINT fk_order_lines_order FOREIGN KEY(order_id) REFERENCES orders(id),
    CONSTRAINT fk_order_lines_album FOREIGN KEY(album_id) REFERENCES albums(id)
) ENGINE=InnoDB;
