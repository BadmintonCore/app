ALTER TABLE shoppingCart ADD COLUMN cartNumber INTEGER NOT NULL DEFAULT 0;
ALTER TABLE shoppingCart ADD COLUMN isShared BOOLEAN NOT NULL DEFAULT false;
ALTER TABLE shoppingCart ADD COLUMN name VARCHAR(255);
ALTER TABLE product DROP FOREIGN KEY product_ibfk_4;
ALTER TABLE product ADD COLUMN shoppingCartNumber INTEGER;
SET foreign_key_checks = 0;
ALTER TABLE shoppingCart DROP PRIMARY KEY;
ALTER TABLE shoppingCart ADD PRIMARY KEY (accId, cartNumber);
alter table product
    add constraint fk_shoppingCart
        foreign key (accId, shoppingCartNumber) references shoppingCart (accId, cartNumber)
            on delete set null;
SET foreign_key_checks = 1;

CREATE TABLE shoppingCartMember (
    userId INTEGER REFERENCES account(id) ON DELETE CASCADE,
    accId INTEGER NOT NULL,
    cartNumber INTEGER NOT NULL,
    PRIMARY KEY (userId, accId, cartNumber),
    FOREIGN KEY (accId, cartNumber) REFERENCES shoppingCart(accId, cartNumber) ON DELETE CASCADE
);
ALTER TABLE shoppingCart ADD COLUMN inviteSecret VARCHAR(255) DEFAULT '123';