<?php

namespace app\models;

/*
** created by Chris at Chengdu office
** on June 2th,2016
*/
use yii;
use \yii\base\Model;
class Customer extends Model
{ 
	//LookupCustomer form fields
	public $keyword;
    //AddNewCustomer form fields
	public $firstname;
	public $lastname;
	public $email;
	public $mobile;
	public $phone;
	public $code;
	public $gender;
	public $address1;
	public $address2;
	public $address3;
	public $country;
	public $campaign_id;
	//CustomerAccount form (new activity) fields
	public $amount;
	public $promo_id;
	//CustomerAccount form (rewards available) fields
	public $points_to_redeem;

	public function rules(){
		return [
		    // ['keyword','required'],		    
            [['firstname','lastname','email','mobile','phone','gender','address1','country','campaign_id'],'required'],
            ['email','email'],
            // [['mobile','phone'],'match','pattern'=>'/^\d{6,13}$/','message'=>'please fill in number'],
            ['phone','match','pattern'=>'/^\d{6}$/','message'=>'please fill it with correct format'],
            ['mobile','match','pattern'=>'/^1[3|5|7|8][1-9]\d{8}$/','message'=>'please fill it with correct format'],
            [['amount','promo_id','points_to_redeem'],'required'],
            [['amount','points_to_redeem'],'match','pattern'=>'/^\d{0,20}$/']
		];
	}

}