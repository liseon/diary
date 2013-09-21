<?php

class DoingsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	private static function dateFormat()
	{
		return new CDbExpression("DATE_FORMAT(t.public_time,'%d.%m.%Y') AS public_time"); 
	}
	
	private static function dataProvider_gen($active=1)
	{
		return new CActiveDataProvider('Doings',array(
			'criteria'=>array(
				'select'=>array('id','user_id','reason_id','text','active',self::dateFormat()),
				'order'=>'public_time DESC',
				'condition'=>'t.active = '.$active,
				'with'=>array('user'=>array(
						'select'=>false,
						'joinType'=>'INNER JOIN',
						'condition'=>'user.id='. Yii::app()->user->getId() 
						),
						'reason'=>array(
						'select'=>'reason.type as type',
						'joinType'=>'INNER JOIN'
						)
						),
											)));
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','basket'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	// public function actionView($id)
	// {
		// $this->render('view',array(
			// 'model'=>$this->loadModel($id),
		// ));
	// }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Doings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Doings']))
		{
			$model->attributes=$_POST['Doings'];
			$model->user_id = Yii::app()->user->getId();
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Doings']))
		{
			$model->reason_id=$_POST['Doings']['reason_id'];
			$model->text=$_POST['Doings']['text'];
			$model->public_time=$_POST['Doings']['public_time'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->render('index',array(
			'dataProvider'=>self::dataProvider_gen(),
		));
	}
	/* Корзина */
	public function actionBasket()
	{
		$this->render('index',array(
			'dataProvider'=>self::dataProvider_gen(0),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Doings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Doings']))
			$model->attributes=$_GET['Doings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Doings the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{

		$model=Doings::model()->with(array(
						'user'=>array(
						'select'=>false,
						'joinType'=>'INNER JOIN',
						'condition'=>'user.id='. Yii::app()->user->getId() 
						)))->find(array(
						'select'=>array('id','user_id','reason_id','text','active',self::dateFormat()),
						'condition'=>"t.id = $id",
						'limit'=>1,
						));

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Doings $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='doings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
