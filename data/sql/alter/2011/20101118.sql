DROP TABLE IF EXISTS ranking_history;
CREATE TABLE ranking_history ( 
	ranking_id INTEGER NOT NULL,
	people_id INTEGER NOT NULL,
    ranking_date DATE NOT NULL,
    events INTEGER DEFAULT 0,
	score FLOAT DEFAULT 0,
    ranking_position INTEGER DEFAULT 0,
	balance_value FLOAT DEFAULT 0,
	prize_value FLOAT DEFAULT 0,
	paid_value FLOAT DEFAULT 0, 
    total_ranking_position INTEGER DEFAULT 0,
    total_events INTEGER DEFAULT 0,
	total_score FLOAT DEFAULT 0,
	total_balance FLOAT DEFAULT 0,
	total_prize FLOAT DEFAULT 0,
	total_paid FLOAT DEFAULT 0, 
	enabled BOOLEAN DEFAULT TRUE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
	PRIMARY KEY(ranking_id, people_id, ranking_date),
    CONSTRAINT ranking_member_FK_1 FOREIGN KEY(ranking_id) REFERENCES ranking(id),
    CONSTRAINT ranking_member_FK_2 FOREIGN KEY(people_id) REFERENCES people(id)
);