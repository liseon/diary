<?php

/**
 * This is the model class for table "{{doings}}".
 *
 * The followings are the available columns in table '{{doings}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $reason_id
 * @property string $text
 * @property string $public_time
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Reasons $reason
 */
class Doings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{doings}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, reason_id, text, public_time', 'required'),
			array('user_id, reason_id, active', 'numerical', 'integerOnly'=>true),
			array('text', 'length', 'max'=>255),
			array('public_time','timeFormat'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, reason_id, text, public_time, active', 'safe', 'on'=>'search'),
		);
	}
	
	public function timeFormat($attribute,$params)
	{
		$this->public_time=date("Y-m-d h:i:s",strtotime($this->public_time));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'reason' => array(self::BELONGS_TO, 'Reasons', 'reason_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'reason_id' => 'Выберите причину:',
			'text' => 'Что Вы сделали?',
			'public_time' => 'Время действия:',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('reason_id',$this->reason_id);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('public_time',$this->public_time,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Doings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
