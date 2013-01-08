ALTER TABLE purchase ADD COLUMN discount_value DECIMAL(10, 2) DEFAULT 0;

ALTER TABLE purchase ADD COLUMN discount_coupon_id INTEGER;
ALTER TABLE purchase ADD CONSTRAINT purchase_FK_3 FOREIGN KEY (discount_coupon_id) REFERENCES discount_coupon (id);