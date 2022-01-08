CREATE OR REPLACE VIEW user_option
AS
SELECT * FROM virtual_table WHERE virtual_table_name = 'userSiteOption' ORDER BY id;

UPDATE virtual_table SET description = REPLACE(description, '7', '5'), tag_name = REPLACE(tag_name, '7', '5') WHERE tag_name = 'receiveEventReminder7';