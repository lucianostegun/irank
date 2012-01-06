ALTER TABLE ranking_player ALTER COLUMN total_average TYPE DECIMAL(10,3);
ALTER TABLE ranking_history ALTER COLUMN total_average TYPE DECIMAL(10,3);
ALTER TABLE ranking_history ALTER COLUMN average TYPE DECIMAL(10,3);

UPDATE ranking_player SET total_average = total_prize/total_paid WHERE total_paid > 0;
UPDATE ranking_history SET total_average = total_prize/total_paid WHERE total_paid > 0;
UPDATE ranking_history SET average = prize_value/paid_value WHERE paid_value > 0;

UPDATE ranking_player SET total_score = (total_average*total_events*10)+(total_events*10);
UPDATE ranking_history SET total_score = (total_average*total_events*10)+(total_events*10);
UPDATE ranking_history SET score = (average*events*10)+(events*10);