CREATE SEQUENCE product_category_seq;
DROP TABLE IF EXISTS product_category;
CREATE TABLE product_category (
    id INTEGER NOT NULL DEFAULT nextval('product_category_seq'::regclass) PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL,
    short_name VARCHAR(25) NOT NULL,
    description VARCHAR(250),
    tag_name VARCHAR(32),
	enabled BOOLEAN DEFAULT FALSE,
	visible BOOLEAN DEFAULT TRUE,
	locked BOOLEAN DEFAULT FALSE,
	deleted BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP
);

CREATE SEQUENCE product_seq;
DROP TABLE IF EXISTS product;
CREATE TABLE product (
    id INTEGER NOT NULL DEFAULT nextval('product_seq'::regclass) PRIMARY KEY,
    product_category_id INTEGER NOT NULL,
    product_code VARCHAR(10) NOT NULL UNIQUE,
    product_name VARCHAR(50) NOT NULL,
    short_name VARCHAR(25) NOT NULL,
    description VARCHAR(250),
    default_price DECIMAL(10, 2) DEFAULT 0,
    default_weight FLOAT,
    is_new BOOLEAN DEFAULT FALSE,
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
    CONSTRAINT product_FK_1 FOREIGN KEY (product_category_id) REFERENCES product_category (id)
);

DELETE FROM product_category;
INSERT INTO product_category(category_name, short_name, description, tag_name, enabled, visible, created_at, updated_at) VALUES
    ('Camisetas', 'Camiseta', null, 'tshirt', true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Dealers', 'Dealer', null, 'dealer', true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


DELETE FROM product;
INSERT INTO product(id, product_code, product_category_id, product_name, short_name, default_price, default_weight, image_1, image_2, image_3, image_4, image_5, is_new, enabled, visible, created_at, updated_at, description) VALUES
    (1, 'IRKTS-001', (SELECT id FROM product_category WHERE tag_name='tshirt'), 'I''m bluffing / I''m All In', 'I''m bluffing', 39.9, 300, 'irkts-001-01.jpg', 'irkts-001-02.jpg', 'irkts-001-03.png', 'irkts-001-04.png', 'irkts-001-05.jpg', true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'Camiseta <b>iRank</b> 100% algodão com estampa termocolante com o texto "I''M NOT CALLING CAUSE I''M BLUFFING" com a mensagem "<b>I''M ALL IN</b>" sutilmente escondida no meio da frase.'),
    (2, 'IRKDL-002', (SELECT id FROM product_category WHERE tag_name='dealer'), 'Dealer iRank 3D', 'Dealer iRank 3D', 22.9, 100, 'irkdl-002-01.jpg', 'irkdl-002-02.jpg', 'irkdl-002-03.jpg', null, null, true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'Dealer <b>iRank</b> personalizado confeccionado em acrílico de alta densidade.');