<?php

/**
 * This is the model class for table "{{reasons}}".
 *
 * The followings are the available columns in table '{{reasons}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Doings[] $doings
 * @property Users $user
 */
class Reasons extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{reasons}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, type, name', 'required'),
			array('user_id, type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, type, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'doings' => array(self::HAS_MANY, 'Doings', 'reason_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
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
			'type' => 'Тип:',
			'name' => 'Название:',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reasons the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	private static function types()
	{
		return array(
				"1"=>array("name"=>"Обязанности","style"=>"red"),
				"2"=>array("name"=>"Досуг","style"=>"blue"),
				"3"=>array("name"=>"Цель","style"=>"green"),
				);
	}


	
	public static function get_type($id=false)
	{	
		if (!$id){
		$types = self::types();
				$new_types=array();
				foreach ($types as $k=>$row)
					$new_types[$k]=$row['name'];
				return  $new_types;
			}
			else { 
			$types = self::types();
			return  $types[$id]['name'];
			}
	}
	
	public static function get_type_style($id)
	{	
		$types = self::types();
		return  $types[$id]['style'];
	}
	
	public static function get_list()
	{
		$id =  Yii::app()->user->getId();
		$list = self::model()->findAll("user_id = $id");
		$list_ar=array();
		foreach ($list as $row)
			$list_ar[$row['id']] = $row['name'];
		return $list_ar;
	}
	
	
}
