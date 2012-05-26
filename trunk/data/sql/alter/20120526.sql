CREATE SEQUENCE cash_table_session_seq;
CREATE TABLE cash_table_session (
    id INTEGER NOT NULL DEFAULT nextval('cash_table_session_seq'::regclass) PRIMARY KEY,
    cash_table_id INTEGER NOT NULL,
    opened_at TIMESTAMP,
    closed_at TIMESTAMP,
    user_admin_id_open INTEGER,
    user_admin_id_close INTEGER,
    total_players INTEGER,
    total_dealers INTEGER,
    enabled BOOLEAN DEFAULT TRUE,
    visible BOOLEAN DEFAULT TRUE,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT cash_table_session_FK_1 FOREIGN KEY (cash_table_id) REFERENCES cash_table (id),
    CONSTRAINT cash_table_session_FK_2 FOREIGN KEY (user_admin_id_open) REFERENCES user_admin (id),
    CONSTRAINT cash_table_session_FK_3 FOREIGN KEY (user_admin_id_close) REFERENCES user_admin (id)
);

CREATE SEQUENCE cash_table_player_seq;
CREATE TABLE cash_table_player (
    id INTEGER NOT NULL DEFAULT nextval('cash_table_player_seq'::regclass) PRIMARY KEY,
    cash_table_id INTEGER NOT NULL,
    cash_table_session_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    table_position INTEGER,
    buyin DECIMAL(10, 2),
    entrance_fee DECIMAL(10, 2),
    cash_out DECIMAL(10, 2),
    checkin_at TIMESTAMP,
    checkout_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT cash_table_player_FK_1 FOREIGN KEY (cash_table_id) REFERENCES cash_table (id),
    CONSTRAINT cash_table_player_FK_2 FOREIGN KEY (cash_table_session_id) REFERENCES cash_table_session (id),
    CONSTRAINT cash_table_player_FK_3 FOREIGN KEY (people_id) REFERENCES people (id)
);

ALTER TABLE cash_table ADD COLUMN cash_table_session_id INTEGER;
ALTER TABLE cash_table ADD CONSTRAINT cash_table_FK_2 FOREIGN KEY (cash_table_session_id) REFERENCES cash_table_session (id);

ALTER TABLE cash_table ADD COLUMN people_id_dealer INTEGER;
ALTER TABLE cash_table ADD CONSTRAINT cash_table_FK_3 FOREIGN KEY (people_id_dealer) REFERENCES people (id);

CREATE OR REPLACE FUNCTION get_cash_table_total_buyin(cashTableId INTEGER) RETURNS DECIMAL(10, 2) AS '
DECLARE
    totalBuyin DECIMAL(10,2);
BEGIN

    SELECT
        SUM(cash_table_player.BUYIN) INTO totalBuyin
    FROM
        cash_table_player
        INNER JOIN cash_table ON cash_table_player.CASH_TABLE_ID=cash_table.ID AND cash_table_player.CASH_TABLE_SESSION_ID=cash_table.CASH_TABLE_SESSION_ID
    WHERE
        cash_table.ID = cashTableId
        AND cash_table_player.CHECKOUT_AT IS NULL;
    
    IF totalBuyin IS NULL THEN
        totalBuyin := 0;
    END IF;

    RETURN totalBuyin;
END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION get_cash_table_entrance_fee(cashTableId INTEGER) RETURNS DECIMAL(10, 2) AS '
DECLARE
    totalEntranceFee DECIMAL(10,2);
BEGIN

    SELECT
        SUM(cash_table_player.ENTRANCE_FEE) INTO totalEntranceFee
    FROM
        cash_table_player
        INNER JOIN cash_table ON cash_table_player.CASH_TABLE_ID=cash_table.ID AND cash_table_player.CASH_TABLE_SESSION_ID=cash_table.CASH_TABLE_SESSION_ID
    WHERE
        cash_table.ID = cashTableId
        AND cash_table_player.CHECKOUT_AT IS NULL;
    
    IF totalEntranceFee IS NULL THEN
        totalEntranceFee := 0;
    END IF;

    RETURN totalEntranceFee;
END'
LANGUAGE 'plpgsql';