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


CREATE OR REPLACE FUNCTION get_pending_purchases(userSiteId INTEGER) RETURNS INTEGER AS '
DECLARE
    pendingPurchases INTEGER;
BEGIN

    SELECT
        COUNT(DISTINCT id) INTO pendingPurchases
    FROM
        purchase
    WHERE
        user_site_id = userSiteId
        AND has_new_status = TRUE;

    RETURN pendingPurchases;
END'
LANGUAGE 'plpgsql';

INSERT INTO config(config_name, description, config_value, created_at, updated_at)
    VALUES('storeShippingZipcode', 'CEP para cálculo de frete', '04547-003', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

ALTER TABLE purchase ADD COLUMN has_new_status BOOLEAN DEFAULT FALSE;