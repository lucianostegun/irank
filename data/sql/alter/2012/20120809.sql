ALTER TABLE discount_coupon ADD COLUMN purchase_id INTEGER;
ALTER TABLE discount_coupon ADD CONSTRAINT discount_coupon_FK_1 FOREIGN KEY (purchase_id) REFERENCES purchase (id);

UPDATE discount_coupon SET purchase_id = (SELECT id FROM purchase WHERE discount_coupon_id = discount_coupon.ID);