ALTER TABLE ranking_live ADD COLUMN game_type_id INTEGER;
ALTER TABLE ranking_live ADD CONSTRAINT ranking_live_FK_3 FOREIGN KEY (game_type_id) REFERENCES virtual_table (id);