CREATE SEQUENCE ranking_prize_split_seq;
CREATE TABLE ranking_prize_split (
    id INTEGER NOT NULL DEFAULT nextval('ranking_prize_split_seq'::regclass) PRIMARY KEY,
    ranking_id INTEGER NOT NULL,
    buyins INTEGER NOT NULL,
    paid_places INTEGER NOT NULL,
    percent_list VARCHAR(30),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT ranking_prize_split_FK_1 FOREIGN KEY (ranking_id) REFERENCES ranking (id)
);

INSERT INTO ranking_prize_split(ranking_id, buyins, paid_places, percent_list, created_at, updated_at)
    (SELECT id, 10, 2, '65%, 35%', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP FROM ranking);

INSERT INTO ranking_prize_split(ranking_id, buyins, paid_places, percent_list, created_at, updated_at)
    (SELECT id, 14, 3, '50%, 30%, 20%', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP FROM ranking);

INSERT INTO ranking_prize_split(ranking_id, buyins, paid_places, percent_list, created_at, updated_at)
    (SELECT id, 18, 4, '40%, 30%, 20%, 10%', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP FROM ranking);