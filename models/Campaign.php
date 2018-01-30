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

    public function isIncludeIgnore($parent_producer_id) {
        $filter = array('conditions' => array("parent_producer_id" => $parent_producer_id,
                "campaign_id" => $this->campaign_id));
        $incude_preference = Include_member_campaign::all($filter);

        if (count($incude_preference) == 0) {
            return "NO";
        } else {
            return $incude_preference[0]->include;
        }
    }
 }
