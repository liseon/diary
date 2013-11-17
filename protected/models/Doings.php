<?php

/**
 * This is the model class for table "{{doings}}".
 *
 * The followings are the available columns in table '{{doings}}':
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $reason_id
 * @property string $text
 * @property string $action_time
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
    public function tableName() {
        return '{{doings}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, reason_id, text, action_time', 'required'),
            array('user_id, reason_id, active', 'numerical', 'integerOnly' => true),
            array('text', 'length', 'max' => 255),
            array('action_time', 'timeFormat'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, reason_id, text, action_time, active', 'safe', 'on' => 'search'),
        );
    }

    public function timeFormat($attribute, $params) {
        $this->action_time = date("Y-m-d h:i:s", strtotime($this->action_time));
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
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
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'reason_id' => 'Выберите причину:',
            'text' => 'Что Вы сделали?',
            'action_time' => 'Время действия:',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('reason_id', $this->reason_id);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('action_time', $this->action_time, true);
        $criteria->compare('active', $this->active);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return CDbExpression
     */
    public static function dateFormat() {
        return new CDbExpression("DATE_FORMAT(t.action_time,'%d.%m.%Y') AS action_time");
    }

    /**
     * Генерируем дата провайдер для индексной страницы или для корзины (список действий)
     * @param $active=1
     * @return CActiveDataProvider
     */
    public static function dataProvider_gen($active = 1) {
        return new CActiveDataProvider('Doings', array(
            'criteria' => array(
                'select' => array(
                    'id',
                    'user_id',
                    'reason_id',
                    'text',
                    'active',
                    self::dateFormat(),
                    'action_time as act_time_order'
                ),
                'order' => 'act_time_order DESC',
                'condition' => 't.active =:active',
                'params' => array(':active' => $active),
                'with' => array(
                    'user' => array(
                        'select' => false,
                        'joinType' => 'INNER JOIN',
                        'condition' => 'user.id=:userID',
                        'params' => array(':userID' => Yii::app()->user->getId()),

                    ),
                    'reason' => array(
                        'select' => array('reason.type as type', 'reason.name as name'),
                        'joinType' => 'INNER JOIN'
                    )
                ),
            ),
            'pagination' => array(
                'pagesize' => 50,
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     * @return Doings the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Генерируем массив значений по дням для графиков
     * @param type
     * @return array
     */
    public static function genReports() {
        $connection = Yii::app()->db;
        //Подготовим структуру
        $structure =array();
        for ($time = strtotime("2013-09-20"); $time <= time()+3600*24; $time += 3600*24) {
            $date = date("Y-m-d", $time);
            $structure[$date] = array((int)$time*1000, 0);
        }
        $result=array(
            "1"=>$structure,
            "2"=>$structure,
            "3"=>$structure,
        );
        $sql = "
                SELECT
                    r.type,
                    DATE_FORMAT(d.action_time,'%Y-%m-%d') AS act_time,
		            COUNT(d.id) AS kol
                FROM
	                {{doings}} d
                JOIN
	                {{reasons}} r
                    ON
                        r.id=d.reason_id
                WHERE
                    d.active='1'
                GROUP BY
	                act_time, r.type
                ";
        $params = array();
        $dataReader = $connection->createCommand($sql)->bindValues($params)->query();
        foreach ($dataReader as $row) {
          //  $result[$row['type']][$row['act_time']] = array(((int)strtotime($row['act_time']))*1000, (int)$row['kol']);
            $result[$row['type']][$row['act_time']][1]  = (int)$row['kol'];
        }
        //приведем хэш к простому массиву [$key,$val]
        foreach ($result as $type=>$row){
            $result[$type] = array_values($row);
        }

        return $result;
    }
}
