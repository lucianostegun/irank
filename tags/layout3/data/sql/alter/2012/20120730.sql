ALTER TABLE product_item ADD COLUMN unavailable BOOLEAN DEFAULT FALSE;
ALTER TABLE product_item ADD COLUMN locked_stock BOOLEAN DEFAULT FALSE;

CREATE SEQUENCE product_item_stock_log_seq;
CREATE TABLE product_item_stock_log (
    id INTEGER NOT NULL DEFAULT nextval('product_item_stock_log_seq'::regclass) PRIMARY KEY,
    product_item_id INTEGER NOT NULL,
    stock INTEGER NOT NULL,
    comments VARCHAR(200),
    created_at TIMESTAMP
);