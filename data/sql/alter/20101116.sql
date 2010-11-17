ALTER TABLE event_member ALTER COLUMN rebuys TYPE FLOAT;
ALTER TABLE event_member ALTER COLUMN addons TYPE FLOAT;

ALTER TABLE event_member RENAME COLUMN rebuys TO rebuy;
ALTER TABLE event_member RENAME COLUMN addons TO addon;

ALTER TABLE event RENAME COLUMN buy_in TO buyin;

ALTER TABLE event_member DROP COLUMN email_sent;
ALTER TABLE event ADD COLUMN saved_result BOOLEAN DEFAULT FALSE;

ALTER TABLE ranking ADD COLUMN default_buyin FLOAT DEFAULT 0;

UPDATE event SET saved_result = TRUE WHERE event_date <= '2010-11-16';

ALTER TABLE event DROP COLUMN game_style_id;
ALTER TABLE ranking ADD COLUMN game_style_id INTEGER;
ALTER TABLE ranking ADD CONSTRAINT ranking_FK_2 FOREIGN KEY (game_style_id) REFERENCES virtual_table (id);

ALTER TABLE ranking_member ADD COLUMN balance FLOAT DEFAULT 0;
ALTER TABLE ranking_member ADD COLUMN total_paid FLOAT DEFAULT 0;
ALTER TABLE ranking_member ADD COLUMN total_prize FLOAT DEFAULT 0;

ALTER TABLE event_member RENAME COLUMN prize_value TO prize;

UPDATE virtual_table SET description = 'Ganhos' WHERE virtual_table_name = 'rankingType' AND tag_name = 'value';
UPDATE virtual_table SET description = 'Classificação' WHERE virtual_table_name = 'rankingType' AND tag_name = 'position';

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventDeleteNotify.htm', 'templates/eventDeleteNotify.htm', 'Template de notificação de exclusão de evento por e-mail', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Template de notificação de exclusão de evento por e-mail', (SELECT MAX(id) FROM file), 'eventDeleteNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

ALTER TABLE user_site ADD COLUMN enabled BOOLEAN DEFAULT TRUE;
ALTER TABLE user_site ADD COLUMN visible BOOLEAN DEFAULT TRUE;
ALTER TABLE user_site ADD COLUMN deleted BOOLEAN DEFAULT FALSE;
ALTER TABLE user_site ADD COLUMN locked BOOLEAN DEFAULT FALSE;