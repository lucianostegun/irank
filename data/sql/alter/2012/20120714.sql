CREATE SEQUENCE product_option_seq;
DROP TABLE IF EXISTS product_option;
CREATE TABLE product_option (
    id INTEGER NOT NULL DEFAULT nextval('product_option_seq'::regclass) PRIMARY KEY,
    product_category_id INTEGER,
    option_type VARCHAR(20),
    option_name VARCHAR(20) NOT NULL,
    description VARCHAR(32),
    tag_name VARCHAR(32) NOT NULL,
    is_default BOOLEAN DEFAULT FALSE,
    order_seq INTEGER,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT product_option_UK_1 UNIQUE (product_category_id, option_type, tag_name),
    CONSTRAINT product_option_FK_1 FOREIGN KEY (product_category_id) REFERENCES product_category (id)
);

CREATE SEQUENCE product_item_seq;
DROP TABLE IF EXISTS product_item;
CREATE TABLE product_item (
    id INTEGER NOT NULL DEFAULT nextval('product_item_seq'::regclass) PRIMARY KEY,
    product_id INTEGER NOT NULL,
    product_option_id_color INTEGER,
    product_option_id_size INTEGER,
    price DECIMAL(10, 2) DEFAULT 0,
    weight FLOAT,
    image_1 VARCHAR(32) NOT NULL,
    image_2 VARCHAR(32),
    image_3 VARCHAR(32),
    image_4 VARCHAR(32),
    image_5 VARCHAR(32),
	enabled BOOLEAN DEFAULT FALSE,
	visible BOOLEAN DEFAULT TRUE,
	locked BOOLEAN DEFAULT FALSE,
	deleted BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT product_item_FK_1 FOREIGN KEY (product_id) REFERENCES product (id),
    CONSTRAINT product_item_FK_2 FOREIGN KEY (product_option_id_color) REFERENCES product_option (id),
    CONSTRAINT product_item_FK_3 FOREIGN KEY (product_option_id_size) REFERENCES product_option (id)
);




DELETE FROM product_option;
INSERT INTO product_option(id, product_category_id, option_type, option_name, description, tag_name, is_default, created_at, updated_at) VALUES
    (1, (SELECT id FROM product_category WHERE tag_name = 'tshirt'), 'size', 'P', 'Pequena', 'small', FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (2, (SELECT id FROM product_category WHERE tag_name = 'tshirt'), 'size', 'M', 'Média', 'medium', FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (3, (SELECT id FROM product_category WHERE tag_name = 'tshirt'), 'size', 'G', 'Grande', 'large', TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (4, (SELECT id FROM product_category WHERE tag_name = 'tshirt'), 'size', 'GG', 'Extra grande', 'extraLarge', FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (5, (SELECT id FROM product_category WHERE tag_name = 'tshirt'), 'size', 'BL', 'Baby look', 'babyLook', FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (6, (SELECT id FROM product_category WHERE tag_name = 'dealer'), 'size', '60mm', '60mm', '60mm', TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),

    (7, null, 'color', 'Branca', '#FFFFFF', 'white', false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (8, null, 'color', 'Preta', '#000000', 'black', true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    (9, null, 'color', 'Vermelha', '#FF0000', 'red', false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


DELETE FROM product_item;
INSERT INTO product_item(product_id, product_option_id_color, product_option_id_size, price, weight, image_1, enabled, visible, created_at, updated_at)
    (SELECT
        product.ID, 
        product_option_color.ID,
        product_option_size.ID,
        default_price, 
        default_weight, 
        image_1,
        true, 
        true, 
        CURRENT_TIMESTAMP, 
        CURRENT_TIMESTAMP
    FROM
        product,
        product_option product_option_color,
        product_option product_option_size
    WHERE
        product_code LIKE 'IRKTS%'
        AND product_option_size.PRODUCT_CATEGORY_ID = (SELECT id FROM product_category WHERE tag_name = 'tshirt'));

DELETE FROM product_item WHERE product_option_id_color = (SELECT id FROM product_option WHERE tag_name = 'red');

INSERT INTO product_item(product_id, product_option_id_color, product_option_id_size, price, weight, image_1, enabled, visible, created_at, updated_at)
    (SELECT
        product.ID, 
        product_option_color.ID,
        product_option_size.ID,
        default_price, 
        default_weight, 
        image_1,
        true, 
        true, 
        CURRENT_TIMESTAMP, 
        CURRENT_TIMESTAMP
    FROM
        product,
        product_option product_option_color,
        product_option product_option_size
    WHERE
        product_code = 'IRKDL-002'
        AND product_option_color.TAG_NAME = 'black'
        AND product_option_size.TAG_NAME = '60mm');

DELETE FROM product WHERE id = 3;
INSERT INTO product(id, product_code, product_category_id, product_name, short_name, default_price, default_weight, image_1, image_2, image_3, image_4, image_5, is_new, enabled, visible, created_at, updated_at, description) VALUES
    (3, 'IRKTS-004', (SELECT id FROM product_category WHERE tag_name='tshirt'), 'Give me ACES and no one gets hurt', 'Give me ACES', 29.9, 300, 'irkts-004-01.jpg', 'irkts-004-02.jpg', 'irkts-004-03.jpg', null, null, true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'Camiseta <b>iRank</b> 100% algodão com estampa termocolante com o texto "GIVE ME ACES AND NO ONE GETS HURT"');

INSERT INTO product_item(product_id, product_option_id_color, product_option_id_size, price, weight, image_1, enabled, visible, created_at, updated_at)
    (SELECT
        product.ID, 
        product_option_color.ID,
        product_option_size.ID,
        default_price, 
        default_weight, 
        image_1,
        true, 
        true, 
        CURRENT_TIMESTAMP, 
        CURRENT_TIMESTAMP
    FROM
        product,
        product_option product_option_color,
        product_option product_option_size
    WHERE
        product_code = 'IRKTS-004'
        AND product_option_color.TAG_NAME = 'red'
        AND product_option_size.PRODUCT_CATEGORY_ID = (SELECT id FROM product_category WHERE tag_name = 'tshirt'));

UPDATE product_item SET image_1 = 'irkts-001-04.png' WHERE product_id = 1 AND product_option_id_color = 7;
UPDATE product_item SET image_1 = 'irkts-001-03.png' WHERE product_id = 1 AND product_option_id_color = 8;
DELETE FROM product_item WHERE product_option_id_size IN (SELECT id FROM product_option WHERE tag_name IN ('small', 'babyLook'));