<?php 

namespace Hcode;

use Rain\Tpl;

class Mailer {

	const USERNAME = "godoiprogrammer@gmail.com";
	const PASSWORD = 'gixxpktuncjnbftj';
	const NAME_FROM = "Godoi Store";

	private $mail;

	public function __construct($toAddress, $toName, $subject, $tplName, $data = array())
	{

		

		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/email/",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false
	    );

		Tpl::configure( $config );

		$tpl = new Tpl;

		foreach ($data as $key => $value) {
			$tpl->assign($key, $value);
		}

		$html = $tpl->draw($tplName, true);

		$this->mail = new \PHPMailer;

	    //Server settings

	    $this->mail->SMTPDebug = 0;                  //Enable verbose debug output

	    $this->mail->isSMTP();                                            //Send using SMTP

	    $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through

	    $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication

	    $this->mail->Username   = Mailer::USERNAME;                     //SMTP username

	    $this->mail->Password   = Mailer::PASSWORD;                               //SMTP password

	    $this->mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption

	    $this->mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


	    //Recipients

	    $this->mail->setFrom(Mailer::USERNAME, Mailer::NAME_FROM);

	    $this->mail->addAddress($toAddress, $toName);     //Add a recipient

	  //  $mail->addAddress('ellen@example.com');               //Name is optional

	    //$mail->addReplyTo('info@example.com', 'Information');

	  //  $mail->addCC('cc@example.com');

	   // $mail->addBCC('bcc@example.com');



	    //Attachments

	    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments

	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name



	    //Content

	    //$this->mail->isHTML(true);                                  //Set email format to HTML

	    $this->mail->Subject = $subject;

	    $this->mail->msgHTML($html);

	    //$mail->Body    = 'Ola estudande de PHP7 da Hcode na plataforma Udemy';

	    $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    
	}

	public function send()
	{

		return $this->mail->send();

	}

}

 ?>