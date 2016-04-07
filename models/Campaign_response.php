<?php
class Campaign_response extends ActiveRecord\Model
 {
    static $table_name = 'campaign_response';

    public $campaign;

    public function setCampaign(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function getCampaign()
    {
        return $this->campaign;
    }
 }
