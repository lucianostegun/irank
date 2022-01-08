ALTER TABLE product_option ALTER COLUMN option_name DROP NOT NULL;
ALTER TABLE product_option ALTER COLUMN tag_name DROP NOT NULL;
SELECT setval('product_option_seq', (SELECT MAX(id) FROM product_option));

INSERT INTO product_option(product_category_id, option_type, option_name, description, tag_name, is_default, created_at, updated_at) VALUES
    ((SELECT id FROM product_category WHERE tag_name = 'babyLook'), 'size', 'P', 'Pequena', 'small', FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ((SELECT id FROM product_category WHERE tag_name = 'babyLook'), 'size', 'M', 'Média', 'medium', FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ((SELECT id FROM product_category WHERE tag_name = 'babyLook'), 'size', 'G', 'Grande', 'large', TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ((SELECT id FROM product_category WHERE tag_name = 'babyLook'), 'size', 'GG', 'Extra grande', 'extraLarge', FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

CREATE OR REPLACE FUNCTION get_product_sizes(productId INTEGER) RETURNS VARCHAR AS '
DECLARE
    sizeList VARCHAR;
BEGIN
    
    SELECT
        string_agg(option_name, '', '') INTO sizeList
    FROM
        (SELECT
            option_name
        FROM
            product_option
            INNER JOIN product_item ON product_item.PRODUCT_OPTION_ID_SIZE = product_option.ID
        WHERE
            option_type = ''size''
            AND product_item.PRODUCT_ID = productId
            AND product_item.ENABLED
            AND product_item.VISIBLE
            AND NOT product_item.DELETED
        GROUP BY
            product_option.OPTION_NAME,
            product_option.ORDER_SEQ,
            product_option.ID
        ORDER BY
            product_option.ORDER_SEQ,
            product_option.ID) AS t1;
    
    RETURN sizeList;
END'
LANGUAGE 'plpgsql';