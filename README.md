# vikvc
Basic PHP framework Developed by Me ,very long ago...still want to upload to share


BASIC CODE CALLING STRUCTURE

//Use of database abstract class .
//User query to get first value.
//Use queryAll get all value.
// use findvalue to constact query.


       $val=DbConfig::connection()->query("select * from test1");
       print_r($val);exit;
       $val=  DbConfig::connection()->findValue("All","test1",
               array('fields' => array('c.*', 'u.*'),
                     'order' => 'c.date DESC',
                     'group'=>' c.date'
                    ),
               array(
                    'joins' => array(
                       array(
                            'table' => 'users',
                            'alias' => 'u',
                            'type' => 'INNER',
                            'conditions'=> array('u.id = Comment.uid')
                            ),
                        array(
                            'table' => 'Comment',
                            'alias' => 'c',
                            'type' => 'inner',
                            'conditions'=> array('u1.id = Comment.uid')
                            ),
                         ),
                            'conditions' => array(
                                'Comment.uid'=>1,
                                'Comment.bid'=>1
        ))
               );
        print_r($val);exit;


/*
 * Php Mailer Documentation.
 */
/*
 * 
$mail=New PHPMailer();
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'user@example.com';                 // SMTP username
$mail->Password = 'secret';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'from@example.com';
$mail->FromName = 'Mailer';
$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
 * This is the example how to use Phpmailer in vikvc framework
 */

/**
To import a model class just use given below syntax.
Vik::import("app.models.new.NewClass");
**/
