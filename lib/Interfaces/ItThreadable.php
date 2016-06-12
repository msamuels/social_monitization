<?php
namespace Wilsonshop\Interfaces;

interface ItThreadable{
    public function getSubject();
    public function getCreationDate();
    public function getStatus();
    public function deliverMsg(ItThreadable $msg);
    /*public function setSubject();
    public function setCreationDate();
    public function setStatus();
    */
}

?>