ALTER TABLE user_site ADD COLUMN bankroll_tutorial_home INTEGER DEFAULT 0;
UPDATE user_site SET bankroll_tutorial_home = 0;