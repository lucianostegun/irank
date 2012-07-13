ALTER TABLE ranking ADD COLUMN score_schema VARCHAR(25);
ALTER TABLE ranking ADD COLUMN score_formula VARCHAR(250);

UPDATE ranking SET score_schema = 'irank1' WHERE enabled AND visible;
UPDATE ranking SET score_schema = 'vegas' WHERE enabled AND visible AND start_date >= '2012-01-01';