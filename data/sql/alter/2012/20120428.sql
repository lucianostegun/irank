CREATE FUNCTION get_ranking_live_new_players(INTEGER) RETURNS SETOF INTEGER AS '
    
    SELECT
        event_live_player.PEOPLE_ID
    FROM
        event_live_player
        INNER JOIN event_live ON event_live_player.EVENT_LIVE_ID=event_live.ID
        INNER JOIN ranking_live ON event_live.RANKING_LIVE_ID=ranking_live.ID
        LEFT JOIN ranking_live_player ON ranking_live_player.PEOPLE_ID=event_live_player.PEOPLE_ID
    WHERE
        ranking_live.ID = $1
        AND ranking_live_player.PEOPLE_ID IS NULL;
'
LANGUAGE 'sql';

UPDATE event_photo SET people_id = (SELECT people_id FROM user_site INNER JOIN ranking ON ranking.USER_SITE_ID=user_site.ID INNER JOIN event ON event.RANKING_ID=ranking.ID WHERE event.ID=event_photo.EVENT_ID) WHERE people_id IS NULL;