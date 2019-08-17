DROP PROCEDURE IF EXISTS next_event_date;
CREATE PROCEDURE IF NOT EXISTS next_event_date(IN ev_id INT, IN ev_type INT)
BEGIN
DECLARE Evnt_id INT;
DECLARE starttime TIME;
DECLARE nextdate DATETIME;
SELECT e.id, e.start_time,CASE ep.repeat_type
         WHEN 1 THEN TIMESTAMP(DATE_ADD(e.start_date, INTERVAL ep.interval_sep DAY),IFNULL(e.start_time, "00:00:00"))
         WHEN 2 THEN TIMESTAMP(DATE_ADD(e.start_date, INTERVAL ep.interval_sep WEEK),IFNULL(e.start_time, "00:00:00"))
         WHEN 3 THEN TIMESTAMP(DATE_ADD(e.start_date, INTERVAL ep.interval_sep MONTH),IFNULL(e.start_time, "00:00:00"))
         WHEN 4 THEN TIMESTAMP(DATE_ADD(e.start_date, INTERVAL ep.interval_sep YEAR),IFNULL(e.start_time, "00:00:00"))
         ELSE "This event is not repeating"
        END INTO Evnt_id, starttime,nextdate FROM Ev_events as e 
        LEFT JOIN Ev_repeat_pattern as ep ON ep.event_id=e.id 
        WHERE e.id=ev_id AND ep.repeat_type=ev_type;
SELECT Evnt_id,starttime,nextdate;
END;

CALL next_event_date(41,2);

 
 SELECT e.id,e.is_recurring,e.event_name, ep.occurencies,e.end_date,
        CASE ep.repeat_type
         WHEN 1 THEN TIMESTAMP(DATE_ADD(e.start_date, INTERVAL ep.interval_sep DAY),IFNULL(e.start_time, "00:00:00"))
         WHEN 2 THEN TIMESTAMP(DATE_ADD(e.start_date, INTERVAL ep.interval_sep WEEK),IFNULL(e.start_time, "00:00:00"))
         WHEN 3 THEN TIMESTAMP(DATE_ADD(e.start_date, INTERVAL ep.interval_sep MONTH),IFNULL(e.start_time, "00:00:00"))
         WHEN 4 THEN TIMESTAMP(DATE_ADD(e.start_date, INTERVAL ep.interval_sep YEAR),IFNULL(e.start_time, "00:00:00"))
         ELSE "This event is not repeating"
        END AS result
             FROM `Ev_events` as e
             LEFT JOIN Ev_repeat_pattern as ep
             ON ep.event_id=e.id
             LEFT JOIN Ev_repeat_type
             ON Ev_repeat_type.id=ep.repeat_type
             WHERE
             NOT DATE(e.end_date)<CURDATE() or NOT TIMESTAMP(e.end_date,e.end_time)<CURRENT_TIMESTAMP() or end_date IS NULL ORDER BY e.end_date DESC
