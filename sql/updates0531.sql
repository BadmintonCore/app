ALTER TABLE shoppingCart
    DROP CONSTRAINT shoppingCart_ibfk_1;

ALTER TABLE shoppingCart
    ADD FOREIGN KEY (accId) REFERENCES account (id) ON DELETE CASCADE;

ALTER TABLE productImage
    DROP CONSTRAINT productImage_ibfk_2;

ALTER TABLE productImage
    ADD FOREIGN KEY (imageId) REFERENCES image (id) ON DELETE CASCADE;

ALTER TABLE allowedSize
    DROP CONSTRAINT allowedSize_ibfk_1;

ALTER TABLE allowedSize
    ADD FOREIGN KEY (productTypeId) REFERENCES productType (id) ON DELETE CASCADE;

ALTER TABLE allowedColor
    DROP CONSTRAINT allowedColor_ibfk_1;

ALTER TABLE allowedSize
    ADD FOREIGN KEY (productTypeId) REFERENCES productType (id) ON DELETE CASCADE;