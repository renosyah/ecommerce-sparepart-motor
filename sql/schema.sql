CREATE TABLE user(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    username TEXT,
    password TEXT
);

CREATE TABLE payment(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    detail TEXT
);

CREATE TABLE customer(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    username TEXT,
    email TEXT,
    password TEXT  
);

CREATE TABLE category(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    image_url TEXT
);

CREATE TABLE product(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_id INT(11) NOT NULL,
    name TEXT,
    price INT,
    image_url TEXT,
    stock INT,
    rating INT,
    detail TEXT,
    FOREIGN KEY (category_id) REFERENCES category(id)
);

CREATE TABLE cart(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customer_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    quantity INT,
    price INT,
    sub_total INT,
    FOREIGN KEY (customer_id) REFERENCES customer(id),
    FOREIGN KEY (product_id) REFERENCES product(id)
);

CREATE TABLE transaction(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ref_id TEXT,
    customer_id INT(11) NOT NULL,
    payment_id INT(11) NOT NULL,
    address TEXT,
    shipment_fee INT,
    total INT,
    expired_date DATETIME NULL,
    FOREIGN KEY (customer_id) REFERENCES customer(id),
    FOREIGN KEY (payment_id) REFERENCES payment(id)
);

CREATE TABLE detail_transaction(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    quantity INT,
    price INT,
    sub_total INT,
    FOREIGN KEY (transaction_id) REFERENCES transaction(id),
    FOREIGN KEY (product_id) REFERENCES product(id)
);

CREATE TABLE validate_transaction(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT(11) NOT NULL,
    image_url TEXT,
    FOREIGN KEY (transaction_id) REFERENCES transaction(id)
);