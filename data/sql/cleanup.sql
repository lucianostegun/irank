DELETE FROM event_member;
DELETE FROM ranking_member;
DELETE FROM event;
DELETE FROM ranking;
DELETE FROM user_site WHERE id <> 1;
DELETE FROM people WHERE id <> 1;

SELECT SETVAL('event_seq', (SELECT MAX(id) FROM event));
SELECT SETVAL('ranking_seq', (SELECT MAX(id) FROM ranking));
SELECT SETVAL('people_seq', (SELECT MAX(id) FROM people));
SELECT SETVAL('user_site_seq', (SELECT MAX(id) FROM user_site));