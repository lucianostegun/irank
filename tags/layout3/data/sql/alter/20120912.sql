CREATE OR REPLACE FUNCTION check_lock_send(emailAddress VARCHAR, emailTemplate VARCHAR) RETURNS BOOLEAN AS
'
DECLARE
  lockSend BOOLEAN:= FALSE;
BEGIN
	
    SELECT
        lock_send INTO lockSend
    FROM
        email_option
        INNER JOIN email_template ON email_option.EMAIL_TEMPLATE_ID = email_template.ID
    WHERE
        lower(email_option.EMAIL_ADDRESS) = lower(emailAddress)
        AND email_template.TAG_NAME = emailTemplate
        AND lock_send;

   IF lockSend IS NULL THEN
    lockSend := FALSE;
   END IF;

   RETURN lockSend;
END
'
LANGUAGE 'plpgsql';

SELECT check_lock_send('lucianostegun@gmail.com', 'eventChangeNotify');