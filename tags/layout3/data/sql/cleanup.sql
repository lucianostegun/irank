DELETE FROM event_prize_config;
DELETE FROM event_player;
DELETE FROM event_comment;
DELETE FROM event_photo_comment;
DELETE FROM event_photo_contest;
DELETE FROM event_photo;
DELETE FROM event;
DELETE FROM event_personal;
DELETE FROM ranking_history;
DELETE FROM ranking_player;
DELETE FROM ranking_place;
DELETE FROM ranking_prize_split;
DELETE FROM ranking_import_log;
DELETE FROM ranking_subscription_request;
DELETE FROM ranking;
DELETE FROM home_wall;

DELETE FROM access_log;
UPDATE purchase SET discount_coupon_id = null;
UPDATE discount_coupon SET purchase_id = null;
DELETE FROM purchase_product_item;
DELETE FROM purchase;
DELETE FROM user_site;
DELETE FROM user_site_option;
DELETE FROM access_admin_log;
DELETE FROM user_admin_settings;
DELETE FROM cash_table_dealer;
DELETE FROM cash_table_player_buyin;
DELETE FROM cash_table_player;
UPDATE cash_table SET cash_table_session_id = NULL;
DELETE FROM cash_table_session;
DELETE FROM cash_table;
DELETE FROM user_admin;
DELETE FROM event_live_player_disclosure_email;
DELETE FROM event_live_player_score;
DELETE FROM ranking_live_history;
DELETE FROM event_live_player;
DELETE FROM ranking_live_player;
DELETE FROM email_marketing_people;
DELETE FROM club_player;
DELETE FROM blog;
DELETE FROM people;

SELECT SETVAL('event_seq', 1, false);
SELECT SETVAL('ranking_seq', 1, false);
SELECT SETVAL('people_seq', 1, false);
SELECT SETVAL('user_site_seq', 1, false);
/*
DELETE FROM virtual_table_i18n;
DELETE FROM virtual_table;

SELECT SETVAL('virtual_table_seq', (SELECT MAX(id) FROM virtual_table));
*/



DELETE FROM club_ranking_live;
DELETE FROM event_live_player;
DELETE FROM event_live_player_score;
DELETE FROM event_live_photo;
DELETE FROM event_live_schedule;
DELETE FROM event_live;
DELETE FROM ranking_live_player;
DELETE FROM ranking_live_history;
DELETE FROM ranking_live_template;
DELETE FROM ranking_live;
DELETE FROM club_photo;
DELETE FROM club_settings;
DELETE FROM club;
DELETE FROM user_admin WHERE id > 1;
UPDATE user_admin SET master=true, club_id=null;











DELETE FROM cash_table_player;
DELETE FROM cash_table_player_buyin;
DELETE FROM cash_table_dealer;
UPDATE cash_table SET cash_table_session_id = NULL;
DELETE FROM cash_table_session;
DELETE FROM cash_table;
