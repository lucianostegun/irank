ALTER TABLE city RENAME COLUMN description TO city_name;
ALTER TABLE state RENAME COLUMN description TO state_name;

UPDATE city SET order_seq = id;

CREATE OR REPLACE FUNCTION no_accent(text) RETURNS text  AS '
    SELECT translate($1, ''‡ˆ‰‹Š‘’“•—˜™›šœŸçËåÌ€ƒéæèêíìîñïÍ…òôó†‚'',
                        ''aaaaaeeeeiiiooooouuuuAAAAAEEEEIIIOOOOOUUUUcC'');
'
LANGUAGE sql IMMUTABLE STRICT; 

CREATE OR REPLACE VIEW city_view AS
SELECT
    city.ID AS id,
    state.ID AS state_id,
    city.CITY_NAME||', '||state.INITIAL AS full_name,
    city.CITY_NAME,
    state.STATE_NAME,
    state.INITIAL
FROM
    city
    INNER JOIN state ON city.STATE_ID=state.ID
ORDER BY
    state.ORDER_SEQ,
    city.ORDER_SEQ;


ALTER TABLE club ADD COLUMN enabled BOOLEAN DEFAULT FALSE;
ALTER TABLE club ADD COLUMN visible BOOLEAN DEFAULT FALSE;
ALTER TABLE club ADD COLUMN locked BOOLEAN DEFAULT FALSE;
ALTER TABLE club ADD COLUMN deleted BOOLEAN DEFAULT FALSE;

UPDATE club SET enabled=TRUE, visible=TRUE, deleted=false;
ALTER TABLE club ALTER COLUMN city_id DROP NOT NULL;