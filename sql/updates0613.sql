CREATE TABLE product_reviews (
                                 id INT AUTO_INCREMENT PRIMARY KEY,
                                 product_id INT NOT NULL,
                                 user_id INT NOT NULL,
                                 rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
                                 review TEXT,
                                 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                 FOREIGN KEY (product_id) REFERENCES productType(id),
                                 FOREIGN KEY (user_id) REFERENCES account(id)
);  