CREATE OR REPLACE FUNCTION get_total_fee(p_ranking_id INTEGER) RETURNS DECIMAL AS'
    DECLARE total_entrance_fee DECIMAL(10,2);
BEGIN

        SELECT 
            SUM(entrance_fee) INTO total_entrance_fee
        FROM 
            event
        WHERE
            event.RANKING_ID=p_ranking_id
            AND event.DELETED = FALSE
            AND event.VISIBLE = TRUE
            AND event.ENABLED = TRUE
            AND event.SAVED_RESULT = TRUE;

    RETURN total_entrance_fee;
END'
LANGUAGE 'plpgsql';