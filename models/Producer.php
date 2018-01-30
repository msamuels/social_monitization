<?php
class Producer extends ActiveRecord\Model
 {
    static $table_name = 'producers';

    public function isMember($member_producer_id) {

        $filter = array('conditions' => array("parent_producer_id" => $this->id_producer,
                "member_producer_id" => $member_producer_id));

        $member = Member_producers::all($filter);

        if (count($member) == 0) {
            return "NO";
        } else {
            return "YES";
        }

    }
 }
