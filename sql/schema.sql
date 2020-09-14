CREATE TABLE users(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    username TEXT,
    password TEXT
);

CREATE TABLE payments(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    detail TEXT
);

CREATE TABLE customers(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    username TEXT,
    email TEXT,
    password TEXT  
);

CREATE TABLE categories(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    image_url TEXT
);

CREATE TABLE products(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    categories_id INT(11) NOT NULL,
    name TEXT,
    price INT,
    image_url TEXT,
    stock INT,
    rating INT,
    FOREIGN KEY (categories_id) REFERENCES categories(id)
);

CREATE TABLE carts(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customers_id INT(11) NOT NULL,
    products_id INT(11) NOT NULL,
    quantity INT,
    price INT,
    sub_total INT,
    FOREIGN KEY (customers_id) REFERENCES customers(id),
    FOREIGN KEY (products_id) REFERENCES products(id)
);

CREATE TABLE transactions(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customers_id INT(11) NOT NULL,
    payments_id INT(11) NOT NULL,
    address TEXT,
    total INT,
    FOREIGN KEY (customers_id) REFERENCES customers(id),
    FOREIGN KEY (payments_id) REFERENCES payments(id)
);

CREATE TABLE detail_transactions(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transactions_id INT(11) NOT NULL,
    products_id INT(11) NOT NULL,
    quantity INT,
    price INT,
    sub_total INT,
    FOREIGN KEY (transactions_id) REFERENCES transactions(id),
    FOREIGN KEY (products_id) REFERENCES products(id)
);