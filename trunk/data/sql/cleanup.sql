DELETE FROM event_player;
DELETE FROM event_comment;
DELETE FROM event_photo_comment;
DELETE FROM event_photo;
DELETE FROM event;
DELETE FROM ranking_history;
DELETE FROM ranking_player;
DELETE FROM ranking_place;
DELETE FROM ranking_prize_split;
DELETE FROM ranking;
DELETE FROM home_wall;
DELETE FROM log;
DELETE FROM user_site;
DELETE FROM user_site_option;
DELETE FROM user_admin;
DELETE FROM people;

SELECT SETVAL('event_seq', 1, false);
SELECT SETVAL('ranking_seq', 1, false);
SELECT SETVAL('people_seq', 1, false);
SELECT SETVAL('user_site_seq', 1, false);
SELECT SETVAL('log_seq', 1, false);
/*
DELETE FROM virtual_table_i18n;
DELETE FROM virtual_table;

SELECT SETVAL('virtual_table_seq', (SELECT MAX(id) FROM virtual_table));
*/