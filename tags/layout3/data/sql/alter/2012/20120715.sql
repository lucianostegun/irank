ALTER TABLE product_item RENAME COLUMN weight TO weight_old;
ALTER TABLE product_item ADD COLUMN weight FLOAT;
UPDATE product_item SET weight = CAST(weight_old AS FLOAT);
ALTER TABLE product_item DROP COLUMN weight_old;

CREATE OR REPLACE FUNCTION getProductItemWeight(productItemId INTEGER) RETURNS FLOAT AS
'
DECLARE
  weight FLOAT;
BEGIN
	
    SELECT
        COALESCE(product_item.WEIGHT, product.DEFAULT_WEIGHT) INTO weight
    FROM
        product_item
        INNER JOIN product ON product_item.PRODUCT_ID=product.ID
    WHERE
        product_item.ID = productItemId;

   IF weight IS NULL THEN
     weight := 0;
   END IF;

   RETURN weight;
END
'
LANGUAGE 'plpgsql';