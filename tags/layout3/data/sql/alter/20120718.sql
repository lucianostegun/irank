DROP TABLE IF EXISTS purchase_product_item;
DROP TABLE IF EXISTS purchase;
DROP SEQUENCE IF EXISTS purchase_seq;

CREATE SEQUENCE purchase_seq;
CREATE TABLE purchase (
    id INTEGER NOT NULL DEFAULT nextval('purchase_seq'::regclass) PRIMARY KEY,
    user_site_id INTEGER NOT NULL,
    order_number VARCHAR(10),
    order_status VARCHAR(20),    
    order_value DECIMAL(10, 2) DEFAULT 0,
    products INTEGER DEFAULT 0,
    itens INTEGER DEFAULT 0,
    shipping_value DECIMAL(10, 2) DEFAULT 0,
    total_value DECIMAL(10, 2) DEFAULT 0,
    paymethod VARCHAR(20),
    ip_address INET,
    duration TIME,
    approval_date TIMESTAMP,
    refusal_date TIMESTAMP,
    refusal_reason VARCHAR(200),
    shipping_date TIMESTAMP,
    tracing_code VARCHAR(20),
    customer_name VARCHAR(150),
    address_name VARCHAR(150),
    address_number VARCHAR(15),
    address_quarter VARCHAR(30),
    address_complement VARCHAR(50),
    address_city VARCHAR(50),
    address_state CHAR(2),
    address_zipcode CHAR(9),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT purchase_FK_1 FOREIGN KEY (user_site_id) REFERENCES user_site (id)
);

CREATE TABLE purchase_product_item (
    purchase_id INTEGER NOT NULL,
    product_item_id INTEGER,
    price DECIMAL(10, 2) DEFAULT 0,
    weight FLOAT,
    quantity INTEGER,
    total_value DECIMAL(10, 2) DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(purchase_id, product_item_id),
    CONSTRAINT purchase_product_item_FK_1 FOREIGN KEY (purchase_id) REFERENCES purchase (id),
    CONSTRAINT purchase_product_item_FK_2 FOREIGN KEY (product_item_id) REFERENCES product_item (id)
);