CREATE OR REPLACE VIEW ranking_type
AS
SELECT 
    id, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at
FROM
    virtual_table
WHERE
    virtual_table_name = 'rankingType';