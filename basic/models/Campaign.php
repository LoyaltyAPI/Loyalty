<?php
namespace app\models;

use yii\base\Model;

class Campaign extends Model{
	//add new campaign
	public $campaign_type;
	public $campaign_name;
	public $points_ratio;
	//campagins report
	public $date_start;
	public $date_end;
	public $selected_campaigns;
	//customer report
	public $date_start1;
	public $date_end1;
	public $selected_campaigns1;
	//update campaigns
	public $name;
	//set depreciation
	public $depreciation_type;
	public $depreciation_interval;
	public $campaign_id;
	//set promotion
	public $promo_operation;
	public $promo_amount;
	public $promo_description;

	public function rules(){

		return [
			[['campaign_type','campaign_name','points_ratio'],'required'],
			[['date_start1','date_end1','selected_campaigns1'],'required'],
			[['date_start','date_end','selected_campaigns','name',],'required'],//必填项
			[['depreciation_type','depreciation_interval'],'required'],
			[['promo_operation','promo_amount','promo_description'],'required'],
			[['depreciation_interval','points_ratio','promo_amount'],'match','pattern'=>'/^\d{0,20}$/','message'=>"This filed must be a number."]
		];
	}
}