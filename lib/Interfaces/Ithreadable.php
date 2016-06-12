<?php
namespace Wilsonshop\Interfaces;

interface Ithreadable{
    public function getSubject();
    public function getCreationDate();
    public function getStatus();
    public function deliverMsg(Ithreadable $msg);
    /*public function setSubject();
    public function setCreationDate();
    public function setStatus();
    */
}

?>