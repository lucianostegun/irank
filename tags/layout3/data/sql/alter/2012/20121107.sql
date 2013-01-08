ALTER TABLE purchase ADD COLUMN finished_at TIMESTAMP;
ALTER TABLE purchase DROP COLUMN duration;

UPDATE purchase SET finished_at = '2012-09-10 22:08:30' WHERE id = 4;
UPDATE purchase SET finished_at = '2012-10-11 10:24:11' WHERE id = 13;
UPDATE purchase SET finished_at = '2012-10-11 20:09:09' WHERE id = 14;
UPDATE purchase SET finished_at = '2012-11-05 18:13:42' WHERE id = 15;
UPDATE purchase SET finished_at = '2012-11-05 21:03:16' WHERE id = 16;
UPDATE purchase SET finished_at = '2012-11-05 21:16:32' WHERE id = 17;