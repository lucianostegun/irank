DELETE FROM event_player;
DELETE FROM event_comment;
DELETE FROM event_photo_comment;
DELETE FROM event_photo;
DELETE FROM event;
DELETE FROM ranking_history;
DELETE FROM ranking_player;
DELETE FROM ranking_place;
DELETE FROM ranking;
DELETE FROM home_wall;
DELETE FROM log;
DELETE FROM user_site;
DELETE FROM user_site_option;
DELETE FROM user_admin;
DELETE FROM people;


SELECT SETVAL('event_seq', (SELECT MAX(id) FROM event));
SELECT SETVAL('ranking_seq', (SELECT MAX(id) FROM ranking));
SELECT SETVAL('people_seq', (SELECT MAX(id) FROM people));
SELECT SETVAL('user_site_seq', (SELECT MAX(id) FROM user_site));
/*
DELETE FROM virtual_table_i18n;
DELETE FROM virtual_table;

SELECT SETVAL('virtual_table_seq', (SELECT MAX(id) FROM virtual_table));
*/