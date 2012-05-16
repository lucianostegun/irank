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
