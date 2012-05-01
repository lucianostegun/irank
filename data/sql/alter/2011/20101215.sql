CREATE SEQUENCE event_comment_seq;
CREATE TABLE event_comment (
    id INTEGER NOT NULL DEFAULT nextval('event_comment_seq'::regclass) PRIMARY KEY,
    event_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    comment VARCHAR(140) NOT NULL,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT event_comment_FK_1 FOREIGN KEY (event_id) REFERENCES event (id),
    CONSTRAINT event_comment_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

UPDATE virtual_table SET description = 'Confirmação de presença dos convidados para os eventos' WHERE virtual_table_name = 'userSiteOption' AND tag_name = 'receiveFriendEventConfirmNotify';

INSERT INTO user_site_option (SELECT id, (SELECT id FROM virtual_table WHERE virtual_table_name = 'userSiteOption' AND tag_name = 'receiveEventCommentNotify'), '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP FROM user_site);