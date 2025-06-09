CREATE TABLE wishlist
(
    accId     INT REFERENCES account (id) ON DELETE CASCADE,
    productTypeId INT REFERENCES productType (id) ON DELETE CASCADE,
    timestamp   DATE NOT NULL,
    PRIMARY KEY (accId, productTypeId)
);