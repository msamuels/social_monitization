<?php
class Campaign extends ActiveRecord\Model
 {
    static $table_name = 'campaigns';
    public $producer;

    public function getProducer(){
        $prod_account = Account::find_by_campaign_id($this->campaign_id);
        $producer = Producer::find_by_id_producer($prod_account->id_producer);
        return $producer;
    }
 }
