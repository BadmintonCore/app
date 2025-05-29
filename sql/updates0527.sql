ALTER TABLE productType
    MODIFY price FLOAT;
ALTER TABLE product
MODIFY boughtPrice FLOAT;

CREATE TABLE image (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    path TEXT NOT NULL
);

CREATE TABLE productImage (
    productTypeId INTEGER REFERENCES productType(id),
    imageId INTEGER REFERENCES image(id),
    PRIMARY KEY (productTypeId, imageId)
);
ALTER TABLE productType DROP COLUMN imgPath