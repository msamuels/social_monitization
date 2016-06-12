<?php
namespace Wilsonshop\Utils;

use Wilsonshop\Utils\Message;
//require_once(ClSS_PATH.'com/web/messages/Message.class');

class Email extends Message {
    var $headers;
    var $operationMsg;
    var $addrSeperator;
    var $boolIsTrackable;
    var $boolIsList;
    var $userid;

    /**
    @params String $to - email address its being sent to
    @params String $body - body of the email
    @params String $subject - subject of email
    @params String $from - who email is from
     **/
    function Email($to,$body,$subject,$from){
        $this->msgto=$to;
        $this->msgbody=$body;
        $this->msgsubject=$subject;
        $this->msgfrom=$from;
        $this->addrSeperator=",";
        $this->headers='MIME-Version: 1.0' . "\r\n";
        $this->headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $this->headers .= 'From: '.$this->msgfrom;
    }

    /** Sends email to recipients.
     * @return string - whether the operation was successful or not
     */
    function sendEmail(){
        //if we want this email to be tracked then add image to it
        //track address, message id
        //$msg = $this->body;
        $operation="";
        if($this->boolIsList){
            if(is_array($this->msgto)){
                $emailList=$this->msgto;
            }else{
                $emailList  = explode($this->addrSeperator,$this->msgto);
            }


            foreach($emailList as $emailAddr){
                $msg = $this->msgbody.'<br /><img src="'.SERVER_PATH.'/track/hittrack.php?catid=3&addr='.$emailAddr.'&msgid=1234&uid='. $_SESSION['userid'].' " height="1" width="1" />';
                //mail(to,subject,msg,header)
                if(mail($emailAddr,$this->msgsubject,$msg,$this->headers)){
                    $operation = true;
                }else{
                    $operation = false;
                }
            }
        }
        /***********************************
         * Not an array so just send the one email
         **********************************/
        else{
            if(mail($this->msgto,$this->msgsubject,$this->msgbody,$this->headers)){
                $operation = true;
            }else{
                $operation = false;
            }

        }
        return $operation;
    }//end sendMail

}

