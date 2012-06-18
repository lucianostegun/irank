CREATE OR REPLACE FUNCTION check_mobile_access(userSiteId INTEGER, pDeviceUDID VARCHAR, mobileToken VARCHAR) RETURNS BOOLEAN AS '
DECLARE
    accessGranted BOOLEAN;
BEGIN
    
    SELECT
        (id IS NOT NULL) INTO accessGranted
    FROM
        user_site
    WHERE
        id = userSiteId
        AND (deviceudid IS NULL OR (deviceudid = pDeviceUDID AND mobile_token = mobileToken));

    IF accessGranted IS NULL THEN
        accessGranted := FALSE;
    END IF;

    RETURN accessGranted;

END'
LANGUAGE 'plpgsql';