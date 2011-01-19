DELETE FROM ranking_history;
DELETE FROM user_site_option;
DELETE FROM event_player;
DELETE FROM ranking_player;
DELETE FROM event;
DELETE FROM ranking;
DELETE FROM user_site;
DELETE FROM people;
DELETE FROM virtual_table;

SELECT SETVAL('event_seq', (SELECT MAX(id) FROM event));
SELECT SETVAL('ranking_seq', (SELECT MAX(id) FROM ranking));
SELECT SETVAL('people_seq', (SELECT MAX(id) FROM people));
SELECT SETVAL('user_site_seq', (SELECT MAX(id) FROM user_site));
SELECT SETVAL('virtual_table_seq', (SELECT MAX(id) FROM virtual_table));