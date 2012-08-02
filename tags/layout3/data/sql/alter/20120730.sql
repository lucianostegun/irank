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

SELECT
    stock+
    (SELECT SUM(stock) FROM product_item_stock_log WHERE product_item_id=product_item.ID)-
    COALESCE((SELECT 
        SUM(quantity) 
     FROM 
        purchase_product_item
        INNER JOIN purchase ON purchase_product_item.PURCHASE_ID=purchase.ID
     WHERE 
        purchase_product_item.PRODUCT_ITEM_ID=product_item.ID
        AND purchase.ORDER_STATUS IN ('shipped', 'complete')), 0)
FROM 
    product_item 
WHERE 
    visible 
    AND enabled 
    AND NOT deleted