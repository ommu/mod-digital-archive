<?php
/**
 * CoverController
 * @var $this CoverController
 * @var $model DigitalCover
 * @var $form CActiveForm
 *
 * Reference start
 * TOC :
 *	Index
 *	Manage
 *	Add
 *	Edit
 *	View
 *	RunAction
 *	Delete
 *	Publish
 *	Setcover
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 7 November 2016, 09:56 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 *----------------------------------------------------------------------------------------------------------
 */

class CoverController extends Controller
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
				$arrThemes = $this->currentTemplate('admin');
				Yii::app()->theme = $arrThemes['folder'];
				$this->layout = $arrThemes['layout'];
			}
		} else
			$this->redirect(Yii::app()->createUrl('site/login'));
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
				'actions'=>array('manage','add','edit','view','runaction','delete','publish','setcover'),
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
		$id = Yii::app()->getRequest()->getParam('digital');
		$digital_title = '';
		if(isset($id) && $id != '') {
			$digital = Digitals::model()->findByPk($id);
			if($digital != null)
				$digital_title = ': '.$digital->digital_title;
		}
		
		$model=new DigitalCover('search');
		$model->unsetAttributes();	// clear any default values
		if(isset($_GET['DigitalCover'])) {
			$model->attributes=$_GET['DigitalCover'];
		}

		$columns = $model->getGridColumn($this->gridColumnTemp());

		$this->pageTitle = Yii::t('phrase', 'Digital Covers Manage').$digital_title;
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_manage', array(
			'model'=>$model,
			'columns' => $columns,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAdd() 
	{
		$id = Yii::app()->getRequest()->getParam('id');
		$digital_title = '';
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'cover_limit, cover_file_type',
		));
		$cover_file_type = unserialize($setting->cover_file_type);	
		if(empty($cover_file_type))
			$cover_file_type = array();
		
		if(isset($id) && $id != '') {
			$digital = Digitals::model()->findByPk($id);
			if($digital != null)
				$digital_title = ': '.$digital->digital_title;
		}
		
		$model=new DigitalCover;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['DigitalCover'])) {
			$model->attributes=$_POST['DigitalCover'];
			if($digital == null)
				$model->scenario = 'formCoverInsert';
			
			if($digital != null)
				$model->digital_id = $digital->digital_id;
			
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('phrase', 'DigitalCover success updated.'));
				//$this->redirect(array('view','id'=>$model->cover_id));
				$this->redirect(array('manage'));
			}
		}
		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
		$this->dialogWidth = 600;
		
		$this->pageTitle = Yii::t('phrase', 'Create Digital Covers').$digital_title;
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_add', array(
			'model'=>$model,
			'digital'=>$digital,
			'setting'=>$setting,
			'cover_file_type'=>$cover_file_type,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($id) 
	{
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'cover_limit, cover_file_type',
		));
		$cover_file_type = unserialize($setting->cover_file_type);
		if(empty($cover_file_type))
			$cover_file_type = array();
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['DigitalCover'])) {
			$model->attributes=$_POST['DigitalCover'];
			
			if($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t('phrase', 'DigitalCover success updated.'));
				//$this->redirect(array('view','id'=>$model->cover_id));
				$this->redirect(array('manage'));
			}
		}
		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
		$this->dialogWidth = 600;

		$this->pageTitle = Yii::t('phrase', 'Update Digital Covers');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_edit', array(
			'model'=>$model,
			'setting'=>$setting,
			'cover_file_type'=>$cover_file_type,
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) 
	{
		$model=$this->loadModel($id);
		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
		$this->dialogWidth = 600;

		$this->pageTitle = Yii::t('phrase', 'View Digital Covers');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_view', array(
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
		$actions  = Yii::app()->getRequest()->getParam('action');

		if(count($id) > 0) {
			$criteria = new CDbCriteria;
			$criteria->addInCondition('cover_id', $id);

			if($actions == 'publish') {
				DigitalCover::model()->updateAll(array(
					'publish' => 1,
				),$criteria);
			} elseif($actions == 'unpublish') {
				DigitalCover::model()->updateAll(array(
					'publish' => 0,
				),$criteria);
			} elseif($actions == 'trash') {
				DigitalCover::model()->updateAll(array(
					'publish' => 2,
				),$criteria);
			} elseif($actions == 'delete') {
				DigitalCover::model()->deleteAll($criteria);
			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!Yii::app()->getRequest()->getParam('ajax')) {
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
			$model->publish = 2;
			$model->modified_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : null;
			
			if($model->update()) {
				if(isset($_GET['hook']) && $_GET['hook'] == 'admin') {
					$url = Yii::app()->controller->createUrl('o/admin/getcover', array('id'=>$model->digital_id,'replace'=>'true'));
					echo CJSON::encode(array(
						'type' => 2,
						'id' => 'media-render',
						'get' => $url,
					));					
				} else {
					echo CJSON::encode(array(
						'type' => 5,
						'get' => Yii::app()->controller->createUrl('manage'),
						'id' => 'partial-digital-cover',
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'DigitalCover success deleted.').'</strong></div>',
					));					
				}
			}
			Yii::app()->end();
		}

		if(isset($_GET['hook']) && $_GET['hook'] == 'admin')
			$dialogGroundUrl = Yii::app()->controller->createUrl('o/admin/edit', array('id'=>$model->digital_id));
		else 
			$dialogGroundUrl = Yii::app()->controller->createUrl('manage');				
		$this->dialogDetail = true;
		$this->dialogGroundUrl = $dialogGroundUrl;
		$this->dialogWidth = 350;

		$this->pageTitle = Yii::t('phrase', 'DigitalCover Delete.');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_delete');
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionPublish($id) 
	{
		$model=$this->loadModel($id);
		
		$title = $model->publish == 1 ? Yii::t('phrase', 'Unpublish') : Yii::t('phrase', 'Publish');
		$replace = $model->publish == 1 ? 0 : 1;

		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			//change value active or publish
			$model->publish = $replace;
			$model->modified_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : null;

			if($model->update()) {
				echo CJSON::encode(array(
					'type' => 5,
					'get' => Yii::app()->controller->createUrl('manage'),
					'id' => 'partial-digital-cover',
					'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'DigitalCover success updated.').'</strong></div>',
				));
			}
			Yii::app()->end();
		}

		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
		$this->dialogWidth = 350;

		$this->pageTitle = $title;
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_publish', array(
			'title'=>$title,
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionSetcover($id) 
	{
		$model = $this->loadModel($id);
		
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$model->status = 1;
			$model->modified_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : null;
			
			if($model->update()) {
				if(isset($_GET['hook']) && $_GET['hook'] == 'admin') {
					$url = Yii::app()->controller->createUrl('o/admin/getcover', array('id'=>$model->digital_id,'replace'=>'true'));
					echo CJSON::encode(array(
						'type' => 2,
						'id' => 'media-render',
						'get' => $url,
					));						
				} else {
					echo CJSON::encode(array(
						'type' => 5,
						'get' => Yii::app()->controller->createUrl('manage'),
						'id' => 'partial-digital-cover',
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'DigitalCover success updated.').'</strong></div>',
					));							
				}
			}
			Yii::app()->end();
		}

		if(isset($_GET['hook']) && $_GET['hook'] == 'admin')
			$dialogGroundUrl = Yii::app()->controller->createUrl('o/admin/edit', array('id'=>$model->digital_id));
		else 
			$dialogGroundUrl = Yii::app()->controller->createUrl('manage');		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = $dialogGroundUrl;
		$this->dialogWidth = 350;

		$this->pageTitle = Yii::t('phrase', 'Cover Photo');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_cover');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) 
	{
		$model = DigitalCover::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='digital-cover-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
