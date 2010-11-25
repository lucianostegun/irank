ALTER TABLE ranking_player ALTER COLUMN score TYPE DECIMAL(10,2);
ALTER TABLE ranking_history ALTER COLUMN score TYPE DECIMAL(10,2);
ALTER TABLE ranking_history ALTER COLUMN total_score TYPE DECIMAL(10,2);

ALTER TABLE ranking_player ADD COLUMN average DECIMAL(10,2) DEFAULT 0;
ALTER TABLE ranking_history ADD COLUMN average DECIMAL(10,2) DEFAULT 0;
ALTER TABLE ranking_history ADD COLUMN total_average DECIMAL(10,2) DEFAULT 0;


UPDATE ranking_player SET average = total_prize/total_paid WHERE total_paid > 0;
UPDATE ranking_history SET average = prize_value/paid_value WHERE paid_value > 0;
UPDATE ranking_history SET total_average = total_prize/total_paid WHERE total_paid > 0;

UPDATE ranking_player SET score = (average*events*10);
UPDATE ranking_history SET score = (average*events*10);
UPDATE ranking_history SET total_score = (total_average*total_events*10);

UPDATE virtual_table SET description = 'Pontos' WHERE virtual_table_name = 'rankingType' AND tag_name = 'score';
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'rankingType', 'Média', 'average', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);