INSERT INTO virtual_table(virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at) VALUES
    ('gameLimit', 'No limit', 'noLimit', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('gameLimit', 'Pot limit', 'potLimit', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('gameLimit', 'Fixed limit', 'fixedLimit', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

ALTER TABLE cash_table ADD COLUMN game_limit_id INTEGER;
ALTER TABLE cash_table ADD CONSTRAINT cash_table_FK_5 FOREIGN KEY (game_limit_id) REFERENCES virtual_table (id);

ALTER TABLE cash_table ADD COLUMN layout_top INTEGER DEFAULT 0;
ALTER TABLE cash_table ADD COLUMN layout_left INTEGER DEFAULT 0;

ALTER TABLE cash_table_player_buyin ADD COLUMN cash_table_player_id INTEGER;
ALTER TABLE cash_table_player_buyin ADD CONSTRAINT cash_table_player_buyin_FK_6 FOREIGN KEY (cash_table_player_id) REFERENCES cash_table_player (id);

UPDATE 
    cash_table_player_buyin 
SET 
    cash_table_player_id = (SELECT 
                                MIN(id) 
                            FROM 
                                cash_table_player 
                            WHERE 
                                cash_table_player.cash_table_session_id=cash_table_player_buyin.cash_table_session_id 
                                AND cash_table_player.people_id=cash_table_player_buyin.people_id);