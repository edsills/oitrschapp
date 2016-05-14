<?php

namespace app\models;
use Yii;
use yii\base\Model;

class PI extends Model {
      public $firstname;
      public $lastname;
      public $department_id;
      public $institution_id;
      public $email;
      public $pi_id;

      public function attributeLables()
      {
	return [
	       'firstname' => 'First Name',
	       'lastname' => 'Last Name',
	       'department_id' => 'Departmnet',
	       'institution_id' => 'Institution',
	       'email' => 'Email',
	       'pi_id' => 'ID Number'
	       ];
      }
      
      public function rules()
      {
	return [
	       ['firstname', 'string', 'max' => 20],
	       ['lastname', 'string', 'max' => 20],
	       ['department_id', 'integer', 'min' => 0],
	       ['institution_id', 'integer', 'min' => 0],
	       ['email', 'email'],
	       ['pi_id', 'integer', 'min' => 0]
	       ];
      }
}

