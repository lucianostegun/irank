ALTER TABLE user_site ADD COLUMN beta_tester BOOLEAN DEFAULT FALSE;

ALTER TABLE club_player ADD COLUMN rating INTEGER DEFAULT NULL;



CREATE OR REPLACE FUNCTION get_club_rating(clubId INTEGER) RETURNS FLOAT AS '
DECLARE
    votes INTEGER;
    ratingSum INTEGER;
BEGIN

  SELECT COALESCE(SUM(rating), 0) INTO ratingSum FROM club_player WHERE club_id = clubId;
  SELECT COUNT(1) INTO votes FROM club_player WHERE club_id = clubId AND rating IS NOT NULL;

  IF votes=0 THEN
    RETURN 0;
  END IF;

  RETURN ratingSum/votes;
END'
LANGUAGE plpgsql;