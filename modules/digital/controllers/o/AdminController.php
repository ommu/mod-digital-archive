<?php
/**
 * AdminController
 * @var $this AdminController
 * @var $model Digitals
 * @var $form CActiveForm
 * version: 0.0.1
 * Reference start
 *
 * TOC :
 *	Index
 *	Manage
 *	Upload
 *	Add
 *	Edit
 *	View
 *	RunAction
 *	Delete
 *	Publish
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 *----------------------------------------------------------------------------------------------------------
 */

class AdminController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $defaultAction = 'index';

	/**
	 * Initialize admin page theme
	 */
	public function init() 
	{
		if(!Yii::app()->user->isGuest) {
			if(in_array(Yii::app()->user->level, array(1,2))) {
				$arrThemes = Utility::getCurrentTemplate('admin');
				Yii::app()->theme = $arrThemes['folder'];
				$this->layout = $arrThemes['layout'];
			} else {
				$this->redirect(Yii::app()->createUrl('site/login'));
			}
		} else {
			$this->redirect(Yii::app()->createUrl('site/login'));
		}
	}

	/**
	 * @return array action filters
	 */
	public function filters() 
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level)',
				//'expression'=>'isset(Yii::app()->user->level) && (Yii::app()->user->level != 1)',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('manage','upload','add','edit','view','runaction','delete','publish'),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level) && in_array(Yii::app()->user->level, array(1,2))',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() 
	{
		$this->redirect(array('manage'));
	}

	/**
	 * Manages all models.
	 */
	public function actionManage() 
	{
		$model=new Digitals('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Digitals'])) {
			$model->attributes=$_GET['Digitals'];
		}

		$columnTemp = array();
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn($columnTemp);

		$this->pageTitle = Yii::t('phrase', 'Digitals Manage');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_manage',array(
			'model'=>$model,
			'columns' => $columns,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpload($id) 
	{
		$setting = DigitalSetting::model()->findByPk(1,array(
			'select' => 'digital_file_type',
		));
		
		$model=$this->loadModel($id);
		if($model != null) {
			// Uncomment the following line if AJAX validation is needed
			$this->performAjaxValidation($model);

			if(isset($_POST['Digitals'])) {
				$model->attributes=$_POST['Digitals'];
				
				if($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('phrase', 'Digitals success uploaded.'));
					$this->redirect(array('edit','id'=>$model->digital_id));
				}
			}
			
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('edit', array('id'=>$model->digital_id));
			$this->dialogWidth = 600;

			$this->pageTitle = Yii::t('phrase', 'Create Digital Categories');
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_upload',array(
				'model'=>$model,
				'setting'=>$setting,
			));
			
		} else
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd() 
	{
		$setting = DigitalSetting::model()->findByPk(1,array(
			'select' => 'cover_file_type, digital_file_type',
		));
		
		$model=new Digitals;
		$publisher=new DigitalPublisher;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$this->performAjaxValidation($publisher);

		if(isset($_POST['Digitals'])) {
			$model->attributes=$_POST['Digitals'];
			$publisher->attributes=$_POST['DigitalPublisher'];
			
			$publisher->validate();
			
			if($model->validate() && $publisher->validate()) {
				//if($model->publisher_id != '' && $model->publisher_id != 0) {
					$publisherFind = DigitalPublisher::model()->find(array(
						'select' => 'publisher_id, publisher_id',
						'condition' => 'publisher_name = :publisher',
						'params' => array(
							':publisher' => $publisher->publisher_name,
						),
					));
					if($publisherFind != null)
						$model->publisher_id = $publisherFind->publisher_id;
					else {
						if($publisher->save())
							$model->publisher_id = $publisher->publisher_id;
					}
				//}			
				if($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('phrase', 'Digitals success created.'));
					$this->redirect(array('edit','id'=>$model->digital_id));
				}				
			}
		}

		$this->pageTitle = Yii::t('phrase', 'Create Digitals');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_add',array(
			'model'=>$model,
			'publisher'=>$publisher,
			'setting'=>$setting,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($id) 
	{
		$model=$this->loadModel($id);
		$publisher = DigitalPublisher::model()->findByPk($model->publisher_id);
		if($model->publisher_id == null)
			$publisher=new DigitalPublisher;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$this->performAjaxValidation($publisher);
			
		if(!$model->getErrors()) {
			$publisher_id = $model->publisher_id;
			$publisher_name = $publisher->publisher_name;
		}

		if(isset($_POST['Digitals'])) {
			$model->attributes=$_POST['Digitals'];
			$publisher->attributes=$_POST['DigitalPublisher'];
			$publisher->validate();
			
			if($model->validate() && $publisher->validate()) {
				if($publisher_id != $model->publisher_id || $publisher_name != $publisher->publisher_name) {
					//if($model->publisher_id != '' && $model->publisher_id != 0) {
						$publisherFind = DigitalPublisher::model()->find(array(
							'select' => 'publisher_id, publisher_name',
							'condition' => 'publisher_name = :publisher',
							'params' => array(
								':publisher' => $publisher->publisher_name,
							),
						));
						if($publisherFind != null)
							$model->publisher_id = $publisherFind->publisher_id;
						else {
							$publishers=new DigitalPublisher;
							$publishers->publisher_name = $publisher->publisher_name;
							if($publishers->save())
								$model->publisher_id = $publishers->publisher_id;
						}
					//}
				}
				
				if($model->save()) {
					Yii::app()->user->setFlash('success', Yii::t('phrase', 'Digitals success updated.'));
					$this->redirect(array('edit','id'=>$model->digital_id));
				}
			}
		}

		$this->pageTitle = Yii::t('phrase', 'Update Digitals');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_edit',array(
			'model'=>$model,
			'publisher'=>$publisher,
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) 
	{
		$model=$this->loadModel($id);

		$this->pageTitle = Yii::t('phrase', 'View Digitals');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_view',array(
			'model'=>$model,
		));
	}	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionRunAction() {
		$id       = $_POST['trash_id'];
		$criteria = null;
		$actions  = $_GET['action'];

		if(count($id) > 0) {
			$criteria = new CDbCriteria;
			$criteria->addInCondition('id', $id);

			if($actions == 'publish') {
				Digitals::model()->updateAll(array(
					'publish' => 1,
				),$criteria);
			} elseif($actions == 'unpublish') {
				Digitals::model()->updateAll(array(
					'publish' => 0,
				),$criteria);
			} elseif($actions == 'trash') {
				Digitals::model()->updateAll(array(
					'publish' => 2,
				),$criteria);
			} elseif($actions == 'delete') {
				Digitals::model()->deleteAll($criteria);
			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manage'));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) 
	{
		$model=$this->loadModel($id);
		
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				if($model->delete()) {
					echo CJSON::encode(array(
						'type' => 5,
						'get' => Yii::app()->controller->createUrl('manage'),
						'id' => 'partial-digitals',
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'Digitals success deleted.').'</strong></div>',
					));
				}
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = Yii::t('phrase', 'Digitals Delete.');
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_delete');
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionPublish($id) 
	{
		$model=$this->loadModel($id);
		
		if($model->publish == 1) {
			$title = Yii::t('phrase', 'Unpublish');
			$replace = 0;
		} else {
			$title = Yii::t('phrase', 'Publish');
			$replace = 1;
		}

		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				//change value active or publish
				$model->publish = $replace;

				if($model->update()) {
					echo CJSON::encode(array(
						'type' => 5,
						'get' => Yii::app()->controller->createUrl('manage'),
						'id' => 'partial-digitals',
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'Digitals success updated.').'</strong></div>',
					));
				}
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = $title;
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_publish',array(
				'title'=>$title,
				'model'=>$model,
			));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) 
	{
		$model = Digitals::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) 
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='digitals-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
