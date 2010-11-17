UPDATE 
    ranking_member 
SET 
    events = (SELECT 
                COUNT(1) 
              FROM 
                event_member, ranking, event 
              WHERE 
                event_member.ENABLED 
                AND event_member.EVENT_ID=event.ID 
                AND ranking.ID=event.RANKING_ID 
                AND event_member.PEOPLE_ID=ranking_member.PEOPLE_ID);