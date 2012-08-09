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