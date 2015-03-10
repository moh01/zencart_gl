<?php

define('EN',   1);
define('FR',    2);
define('BL',    3);
define ('STYLE', '' );

class EMAIL
{
    var $email_language = EN;

    var $sender_email_address = "contact@243149.net";

    var $sender_name = array();
    var $receiver_email_address = "f_varon@hotmail.com";

    var $receiver_name;
    var $receiver_id;

    var $email_title = array();
    var $email_content = array();


    /*   gestion des caractères de substitution  */


    // {{{ constructor
    function EMAIL()
    {
     $this->sender_name[EN] = "Online questionnaires.";
     $this->sender_name[FR] = "Questionnaires en ligne.";
     $this->receiver_name = "";

     $this->email_title[EN] = "";
     $this->email_title[FR] = "";

     $this->email_content[EN] = "";
     $this->email_content[FR] = "";

    }

    // }}}
    // {{{ destructor

    /**
     * Destructor (the emulated type of...).  Does nothing right now,
     * but is included for forward compatibility, so subclass
     * destructors should always call it.
     *
     * See the note in the class desciption about output from
     * destructors.
     *
     * @access public
     * @return void
     */
    function _EMAIL()
    {
    }

    // }}}
    // {{{ GetEmailHeader()
    function get_email_header()
    {

$headers = "From: \"".$this->sender_name[$this->email_language]."\" <".$this->sender_email_address.">\n";
// $headers .= "To:  <".$email_send_to.">\n";
// $headers .= "return-path: <".$this->sender_email_address.">\n";

// $headers .= 'Cc: contact@cyber-sphinx.com' . "\r\n";

$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/HTML; charset=ISO-8859-1\n";


/*
      $headers = "MIME-Version: 1.0\r \n";
      $headers .= "Content-type: text/html; charset=iso-8859-1\r \n";
      $headers .= "From:". $this->sender_name[$this->email_language] ."<".$this->sender_email_address.">\r \n";
      $headers .= 'Cc: contact@cyber-sphinx.com' . "\r\n";
      $headers .= "Reply-To:". $this->sender_name[$this->email_language] ."<".$this->sender_email_address.">\r \n";
      $headers .= "X-Priority: 3\r \n";

//      $headers .= "X-MSMail-Priority: High\r \n";
//      $headers .= "X-Mailer:". $this->sender_name[$this->email_language];

      $headers .= "X-Mailer: PHP\n"; // mailer
      $headers .= "Return-Path: <frederic.varon@cyber-sphinx.com>\n";

*/
      return $headers;
    }
    // {{{ get_email_title()
    function get_email_title()
    {
      $title = $this->email_title[$this->email_language];

      return $title;
    }

    function get_email_content()
    {
      $content = $this->email_content[$this->email_language];
      $content = str_replace('[EMAIL]',$this->receiver_email_address , $content);
      $content = str_replace('[ID]',$this->receiver_id, $content);


      return $content;
    }
    function send_email()
    {
      $email_send_to = '<'. $this->receiver_email_address."> \r \n";
//echo 	 '$email_send_to.'.$email_send_to.'$email_send_to.'; exit;
// Return-Path: me <me@mine.com>\r\n
//     mail($email_send_to, $this->get_email_title() , $this->get_email_content() , $this->get_email_header() ,  '-f  Return-Path: frederic.varon@cyber-sphinx.com  \r\n'  );
       mail($email_send_to, $this->get_email_title() , $this->get_email_content() , $this->get_email_header()  );

    }
    function set_email_language($p_language)
    {
      $this->email_language=$p_language; 
    }
    function set_email_content($p_content , $p_language )
    {
      $this->email_content[$p_language] = STYLE . "<BODY>". $p_content. "</BODY>"; 
    }
    function set_email_title($p_title , $p_language )
    {
      $this->email_title[$p_language] = $p_title; 
    }
    function set_receiver_email_address($p_receiver_email_address)
    {
      $this->receiver_email_address=$p_receiver_email_address; 
    }    
    function set_receiver_name($p_receiver_name)
    {
      $this->receiver_name=$p_receiver_name; 
    } 
    function set_receiver_id($p_receiver_id)
    {
      $this->receiver_id=$p_receiver_id; 
    }   
    function set_sender_email_address($p_sender_email_address)
    {
      $this->sender_email_address=$p_sender_email_address; 
    }
    function set_sender_name($p_sender_name , $p_language )
    {
      $this->sender_name[$p_language] = $p_sender_name; 
    }
}
?>