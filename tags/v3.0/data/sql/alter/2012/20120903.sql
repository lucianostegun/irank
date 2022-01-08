CREATE SEQUENCE ranking_subscription_request_seq;
CREATE TABLE ranking_subscription_request (
    id INTEGER NOT NULL DEFAULT nextval('ranking_subscription_request_seq'::regclass) PRIMARY KEY,
    user_site_id INTEGER NOT NULL,
    user_site_id_owner INTEGER,
    ranking_id INTEGER NOT NULL,
    request_status VARCHAR(15),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT ranking_subscription_request_FK_1 FOREIGN KEY (user_site_id) REFERENCES user_site (id),
    CONSTRAINT ranking_subscription_request_FK_2 FOREIGN KEY (user_site_id_owner) REFERENCES user_site (id),
    CONSTRAINT ranking_subscription_request_FK_3 FOREIGN KEY (ranking_id) REFERENCES ranking (id)
);

INSERT INTO file(file_name, file_path, description, created_at, updated_at)
    VALUES('rankingSubscriptionRequest.htm', 'templates/email/rankingSubscriptionRequest.htm', 'Pedido de inscrição no ranking', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO email_template(email_template_id, tag_name_parent, template_name, description, tag_name, file_id, enabled, visible, deleted, locked, created_at, updated_at)
    VALUES((SELECT MAX(id) FROM email_template), 'rankingSubscriptionRequest', 'Pedido de inscrição no ranking', 'Pedido de inscrição no ranking', 'rankingSubscriptionRequest', (SELECT MAX(id) FROM file), true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);