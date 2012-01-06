DELETE FROM virtual_table_i18n;
INSERT INTO virtual_table_i18n 
    (SELECT 
        id, 'pt_BR', description
    FROM 
        virtual_table 
    WHERE 
        virtual_table_name IN ('gameType', 'gameStyle', 'rankingType', 'userSiteOption'));


INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'gameType' AND tag_name = 'holdem'), 'en_US', 'Texas Hold''em');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'gameType' AND tag_name = 'stud'), 'en_US', 'Stud');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'gameType' AND tag_name = 'omaha'), 'en_US', 'Omaha');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'gameType' AND tag_name = 'mixed'), 'en_US', 'All');

INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'gameStyle' AND tag_name = 'tournament'), 'en_US', 'Tournament');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'gameStyle' AND tag_name = 'ring'), 'en_US', 'Ring game');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'gameStyle' AND tag_name = 'sitngo'), 'en_US', 'Sit & Go');

INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'rankingType' AND tag_name = 'value'), 'en_US', 'Profit');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'rankingType' AND tag_name = 'score'), 'en_US', 'Score');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'rankingType' AND tag_name = 'balance'), 'en_US', 'Balance');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'rankingType' AND tag_name = 'average'), 'en_US', 'Average');

INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'userSiteOption' AND tag_name = 'receiveFriendEventConfirmNotify'), 'en_US', 'Confirmation of guest''s presence on events');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'userSiteOption' AND tag_name = 'receiveEventReminder0'), 'en_US', 'Notify scheduled events for the day');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'userSiteOption' AND tag_name = 'receiveEventReminder3'), 'en_US', 'Notify scheduled events for next 3 days');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'userSiteOption' AND tag_name = 'receiveEventReminder7'), 'en_US', 'Notify scheduled events for next 7 days');
INSERT INTO virtual_table_i18n VALUES((SELECT id FROM virtual_table WHERE virtual_table_name = 'userSiteOption' AND tag_name = 'receiveEventCommentNotify'), 'en_US', 'Notify new event comments');