CREATE SEQUENCE poll_answer_seq;
ALTER TABLE poll_answer ADD COLUMN id INTEGER NOT NULL PRIMARY KEY DEFAULT nextval('poll_answer_seq');
