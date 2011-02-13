CREATE TABLE ranking_import_log (
    ranking_id INTEGER NOT NULL,
    ranking_id_from INTEGER NOT NULL,
    import_table VARCHAR(32),
    object_id INTEGER NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(ranking_id, ranking_id_from, import_table, object_id),
    CONSTRAINT ranking_import_log_FK_1 FOREIGN KEY (ranking_id) REFERENCES ranking (id),
    CONSTRAINT ranking_import_log_FK_2 FOREIGN KEY (ranking_id_from) REFERENCES ranking (id)
);

INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'userSiteOption', 'Resumo padrão', 'quickResume', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO user_site_option (SELECT id, (SELECT id FROM virtual_table WHERE virtual_table_name = 'userSiteOption' AND tag_name = 'quickResume'), 'balance', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP FROM user_site);

UPDATE user_site_option SET option_value = 'profit' WHERE user_site_option_id = (SELECT id FROM virtual_table WHERE virtual_table_name = 'userSiteOption' AND tag_name = 'quickResume') AND people_id IN (SELECT people_id FROM (SELECT SUM(event_player.PRIZE-(event_player.BUYIN+event_player.ADDON+event_player.REBUY)), event_player.PEOPLE_ID FROM event_player, event WHERE event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID GROUP BY event_player.PEOPLE_ID) as T1);