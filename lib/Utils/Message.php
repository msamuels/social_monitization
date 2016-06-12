<?php

namespace Wilsonshop\Utils;


class Message implements ItThreadable{
    public $id;
    public $threadId=null;
    public $userid;
    public $sender;
    public $msgfrom;
    public $msgto;
    public $msgsubject;
    public $msgbody;
    public $msgopens;
    public $msgcreationdate;
    public $msgsenddate;
    public $msgtype; //1) external email 2) internal email
    public $isread=0;

    /**********************************
     *implemented methods from ITthreadable
     **********************************/
    public function getSubject(){
        return $this->msgsubject;
    }
    public function getCreationDate(){
        return $this->getMsgsenddate();
    }
    public function getStatus(){
        return 1;
    }
    public function deliverMsg(ItThreadable $msg){

        $rs = $this->sendMsg($msg);

        return $rs;
    }
    /**********************************
     * finish implementing methods  from ITthreadable
     *********************************/

    function getId(){
        return $this->id;
    }
    function setId($id){
        $this->id=$id;
    }

    function getUserid(){
        return $this->userid;
    }
    function setUserid($userid){
        $this->userid=$userid;
    }

    function getMsgfrom(){
        return $msgfrom;
    }
    function setMsgfrom($msgfrom){
        $this->msgfrom=$msgfrom;
    }

    function getMsgto(){
        return $this->msgto;
    }
    function setMsgto($msgto){
        $this->msgto=$msgto;
    }

    function getMsgsubject(){
        return $msgsubject;
    }
    function setMsgsubject($msgsubject){
        $this->msgsubject=$msgsubject;
    }

    function getMsgbody(){
        return $this->msgbody;
    }
    function setMsgbody($msgbody){
        $this->msgbody=$msgbody;
    }

    function getMsgopens(){
        return $this->msgopens;
    }
    function setMsgopens($msgopens){
        $this->msgopens=$msgopens;
    }

    function getMsgcreationdate(){
        return $this->msgcreationdate;
    }
    function setMsgcreationdate($msgcreationdate){
        $this->msgcreationdate=$msgcreationdate;
    }

    function getMsgsenddate(){
        return $this->msgsenddate;
    }
    function setMsgsenddate($msgsenddate){
        $this->msgsenddate=$msgsenddate;
    }

    function sendMsg(Message $obj_msg){

        $sql="INSERT INTO message (threadid,userid,msgfrom,msgto,msgsubject,msgbody,msgcreationdate,msgsenddate,msgtype) ";
        $sql .= " VALUES($obj_msg->threadId,$obj_msg->userid,$obj_msg->msgfrom,'','$obj_msg->msgsubject','$obj_msg->msgbody','$obj_msg->msgcreationdate','$obj_msg->msgsenddate',$obj_msg->msgtype);";
        $query=new SQL();
        //echo $sql;

        $rsMsg =$query->execute($sql);
        $user = new User();

        $sender = $user->getUser($obj_msg->userid);

        $msgthread = new MessageThread();
        $msgRecipients = $msgthread->getThreadRecipients($obj_msg->threadId);

        $recipientOfMsg=array();
        for($x=0;$x<count($msgRecipients);$x++){
            $currentAddress = $msgRecipients[$x]->profile->getEmailAddress();
            //if its not the person sending the email then send a message letting user know theyve been sent a message
            if($currentAddress!=$sender->username){
                $recipientOfMsg[] = $msgRecipients[$x]->profile->getEmailAddress();
            }

        }
        $uniqueRecipients = array_unique($recipientOfMsg);
        //if the message was successfully sent send user a message

        if($rsMsg==1){
            //$subject = $obj_msg->msgfrom." sent you a message";
            $subject = $sender->profile->name." sent you a message at nuubs.com";
            $msgBody = "To view or reply log in to nuubs.com and click 'Inbox' ";
            //use $obj_msg->msgto to find the username of user and send message to that user's inbox


            //$recipientOfMsg = $msgRecipients[$x]->profile->getEmailAddress();
            $listEmail = new Email($uniqueRecipients,$msgBody,$subject,"no-reply@nuubs.com");
            $listEmail->boolIsList=true;
            $listEmail->sendEmail();
            //}

            //reset to unread
            $msgthread->updateThreadStatus($msgthread->threadId,0);

        }
        return $rsMsg;
    }
    function reply(Message $obj_msg){

    }
    function updatemessage(Message $obj_msg){
        $creationDate = date(DATE_FORMAT);
        $sql="Update message SET msgto='".$obj_msg->msgto."',
	msgsubject='".$obj_msg->msgsubject."',
	msgbody='".$obj_msg->msgbody."',
	msgcreationdate='".$creationDate."'
	WHERE id=$obj_msg->id";
        $query=new SQL();
        $msg = $query->execute($sql);
    }

    function saveMessage(Message $obj_msg){
        $creationDate = date(DATE_FORMAT);
        $col[0]="id";
        $val[0]=$obj_msg->id;

        if(!DbUtil::existsInTable("message",$col,$val)){
            $sql="INSERT INTO message (threadid,userid,msgsubject,msgbody,msgcreationdate,msgtype)
		 VALUES($obj_msg->threadId,'$obj_msg->userid','$obj_msg->msgsubject','$obj_msg->msgbody','$creationDate','$obj_msg->msgtype')";
            $query=new SQL();
            $msg = $query->execute($sql);
        }else{
            $msg = $this->updatemessage($obj_msg);
        }
        //echo $sql;

        return $msg;
    }

    function getMessage($groupBy=null){
        $sql="SELECT * FROM message WHERE msgtype=".$this->msgtype;
        if($this->userid!=""||$this->userid!=null){
            $sql .=" AND userid=".$this->userid;
        }
        if($this->id!=""||$this->id!=null){
            $sql .=" AND id=".$this->id;
        }
        if($this->msgto!=""||$this->msgto!=null){
            $sql .=" AND msgto=".$this->msgto;
        }
        if($groupBy!=null){
            $sql .=" ORDER BY msgcreationdate DESC GROUP BY threadid";
        }

        $query=new SQL();
        $query->execute($sql);
        //echo $sql;
        $i=0;
        while($row=mysql_fetch_array($query->result)){
            $msg[$i]= new Message();
            $msg[$i]->id=$row['id'];
            $msg[$i]->threadId=$row['threadid'];
            $msg[$i]->msgsubject=$row['msgsubject'];
            $msg[$i]->msgbody=$row['msgbody'];
            $msg[$i]->msgcreationdate=date('F j, Y, g:i a',strtotime($row['msgcreationdate']));
            $i++;
        }
        return $msg;
    }
}
?>