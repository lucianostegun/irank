CREATE SEQUENCE product_seq;
CREATE TABLE product (
    id INTEGER NOT NULL DEFAULT nextval('product_seq'::regclass) PRIMARY KEY,
    product_type_id INTEGER NOT NULL,
    product_name VARCHAR(10) NOT NULL,
    default_price DECIMAL(10, 2) DEFAULT 0,
    is_new BOOLEAN DEFAULT FALSE,
	enabled BOOLEAN DEFAULT FALSE,
	visible BOOLEAN DEFAULT TRUE,
	locked BOOLEAN DEFAULT FALSE,
	deleted BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT product_FK_1 FOREIGN KEY (product_type_id) REFERENCES virtual_table (id)
);

CREATE TABLE product_file (
    product_id INTEGER NOT NULL,
    file_id INTEGER NOT NULL,
    is_default BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
    PRIMARY KEY(product_id, file_id),
    CONSTRAINT product_file_FK_1 FOREIGN KEY (product_id) REFERENCES product (id),
    CONSTRAINT product_file_FK_2 FOREIGN KEY (file_id) REFERENCES file (id)
);
