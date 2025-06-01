CREATE TABLE orders (
                        id INTEGER PRIMARY KEY AUTO_INCREMENT,
                        accountId INTEGER NOT NULL REFERENCES account(id),
                        timestamp DATETIME NOT NULL,
                        status VARCHAR(255) NOT NULL
);

CREATE TABLE orderProduct (
                              orderId INTEGER REFERENCES orders(id),
                              productId INTEGER REFERENCES product(id),
                              PRIMARY KEY (orderId, productId)
);