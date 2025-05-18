CREATE TABLE category
(
    id               INTEGER PRIMARY KEY AUTO_INCREMENT,
    name             VARCHAR(255) NOT NULL,
    parentCategoryId INTEGER REFERENCES category (id)
);

CREATE TABLE productType
(
    id               INTEGER PRIMARY KEY AUTO_INCREMENT,
    categoryId       INTEGER      NOT NULL REFERENCES category (id),
    name             VARCHAR(255) NOT NULL,
    material         VARCHAR(255) NOT NULL,
    price            INTEGER      NOT NULL,
    imgPath          VARCHAR(255) NOT NULL,
    description      VARCHAR(255) NOT NULL,
    collection       VARCHAR(255) NOT NULL,
    careInstructions VARCHAR(255) NOT NULL,
    origin           VARCHAR(255) NOT NULL,
    extraFields      JSON
);

CREATE TABLE color
(
    id   INTEGER PRIMARY KEY AUTO_INCREMENT,
    hex  VARCHAR(6)   NOT NULL,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE size
(
    id   INTEGER PRIMARY KEY AUTO_INCREMENT,
    size VARCHAR(3) NOT NULL
);

CREATE TABLE account
(
    id         INTEGER PRIMARY KEY AUTO_INCREMENT,
    type       VARCHAR(1)   NOT NULL,
    firstname  VARCHAR(255) NOT NULL,
    surname    VARCHAR(255) NOT NULL,
    username   VARCHAR(255) NOT NULL,
    email      VARCHAR(255) NOT NULL,
    password   VARCHAR(255) NOT NULL,
    newsletter BOOLEAN      NOT NULL

);

CREATE TABLE shoppingCart
(
    accId INTEGER PRIMARY KEY REFERENCES account (id)
);

CREATE TABLE product
(
    id             INTEGER AUTO_INCREMENT,
    productTypeId  INTEGER NOT NULL REFERENCES productType (id),
    sizeId         INTEGER NOT NULL REFERENCES size (id),
    colorId        INTEGER NOT NULL REFERENCES color (id),
    shoppingCartId INTEGER REFERENCES shoppingCart (accId),
    accId          INTEGER REFERENCES account (id),
    boughtAt       TIMESTAMP,
    boughtPrice    INTEGER,
    PRIMARY KEY (id, productTypeId)
);

CREATE TABLE globalConfig
(
    attribute VARCHAR(255) PRIMARY KEY,
    value     VARCHAR(255)
);

CREATE TABLE userConfig
(
    attribute VARCHAR(255),
    value     VARCHAR(255),
    accId     INTEGER REFERENCES account (id),
    PRIMARY KEY (attribute, accId)
);

CREATE TABLE address
(
    id       INTEGER PRIMARY KEY AUTO_INCREMENT,
    houseNr  VARCHAR(255) NOT NULL,
    street   VARCHAR(255) NOT NULL,
    zip      INTEGER      NOT NULL,
    city     VARCHAR(255) NOT NULL,
    addition VARCHAR(255)
);

CREATE TABLE joinAddressAcc
(
    addressId INTEGER REFERENCES address (id),
    accountId INTEGER REFERENCES account (id),
    type      VARCHAR(255) NOT NULL,
    PRIMARY KEY (accountId, addressId, type)
);

CREATE TABLE allowedColor
(
    productTypeId INTEGER REFERENCES productType (id),
    colorId       INTEGER REFERENCES color (id),
    PRIMARY KEY (productTypeId, colorId)
);

CREATE TABLE allowedSize
(
    productTypeId INTEGER REFERENCES productType (id),
    sizeId        INTEGER REFERENCES size (id),
    PRIMARY KEY (productTypeId, sizeId)
);

CREATE TABLE feedback
(
    id         INTEGER PRIMARY KEY AUTO_INCREMENT,
    name       VARCHAR(255) NOT NULL,
    evaluation INTEGER   NOT NULL,
    email      VARCHAR(255) NOT NULL,
    message    TEXT         NOT NULL,
    datetime   DATETIME     NOT NULL
);