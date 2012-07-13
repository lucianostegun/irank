INSERT INTO config VALUES('maintenanceScheduleDate', 'Manutenção programada', '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO config VALUES('isUnderMaintenance', 'Site em manutenção', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

CREATE SEQUENCE email_marketing_seq;
CREATE TABLE email_marketing (
    id INTEGER NOT NULL DEFAULT nextval('email_marketing_seq'::regclass) PRIMARY KEY,
    description VARCHAR(80),
    file_id INTEGER,
    club_id INTEGER,
    email_template_id INTEGER,
    email_subject VARCHAR(50),
    schedule_date DATE,
    sending_status VARCHAR(15) DEFAULT 'pending',
    last_sent_date TIMESTAMP,
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    locked BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT email_marketing_FK_1 FOREIGN KEY (file_id) REFERENCES file (id),
    CONSTRAINT email_marketing_FK_2 FOREIGN KEY (club_id) REFERENCES club (id),
    CONSTRAINT email_marketing_FK_3 FOREIGN KEY (email_template_id) REFERENCES email_template (id)
);

CREATE TABLE email_marketing_people (
    email_marketing_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    email_log_id INTEGER,
    created_at TIMESTAMP,
    PRIMARY KEY(email_marketing_id, people_id),
    CONSTRAINT people_email_marketing_FK_1 FOREIGN KEY (people_id) REFERENCES people (id),
    CONSTRAINT people_email_marketing_FK_2 FOREIGN KEY (email_marketing_id) REFERENCES email_marketing (id)
);

CREATE SEQUENCE poll_seq;
CREATE TABLE poll(
    id INTEGER NOT NULL PRIMARY KEY DEFAULT nextval('poll_seq'),
    question VARCHAR(200),
    locked BOOLEAN DEFAULT false,
    enabled BOOLEAN DEFAULT false,
    visible BOOLEAN DEFAULT true,
    deleted BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE TABLE poll_answer(
    poll_id INTEGER NOT NULL,
    answer VARCHAR(20),
    user_response INTEGER,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT poll_answer_fk_1 FOREIGN KEY (poll_id) REFERENCES poll(id)
);