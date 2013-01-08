DELETE FROM product_item WHERE product_id = 1 AND product_option_id_color IN (SELECT id FROM product_option WHERE option_type = 'size');

ALTER TABLE product_item ALTER COLUMN image_1 DROP NOT NULL;