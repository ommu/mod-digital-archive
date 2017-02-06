<?php
/**
 * MediaController
 * @var $this MediaController
 * version: 0.0.1
 * Reference start
 *
 * TOC :
 *	Index
 *	Cover
 *	File
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 *----------------------------------------------------------------------------------------------------------
 */

class MediaController extends Controller
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
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['folder'];
		$this->layout = $arrThemes['layout'];
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
				'actions'=>array('index','cover','file'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level)',
				//'expression'=>'isset(Yii::app()->user->level) && (Yii::app()->user->level != 1)',
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
		throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionCover($id) 
	{
		$path = $_GET['abc'];
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'digital_path',
		));
		$model = DigitalCover::model()->findByPk($id);
		
		$pathUnique = Digitals::getUniqueDirectory($model->digital_id, $model->digital->salt, $model->digital->view->md5path);
		if($setting != null)
			$digital_path = $setting->digital_path.'/'.$pathUnique;
		else
			$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathUnique;
		
		$cover = $model->digital->digital_path.'/'.$model->cover_filename;
		
		if($model->md5coverpath == $path && $model->cover_filename != '' && file_exists($cover))
			Yii::app()->getRequest()->sendFile(time().$model->digital->view->md5path.'.'.strtolower(pathinfo($model->cover_filename, PATHINFO_EXTENSION)), @file_get_contents($cover));
		else
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
			
		//echo $model->digital->digital_path.'/'.$model->cover_filename;
	}
	
	/**
	 * Lists all models.
	 */
	public function actionFile($id) 
	{
		$path = $_GET['abc'];
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'digital_path',
		));
		$model = DigitalFile::model()->findByPk($id);
		
		$pathUnique = Digitals::getUniqueDirectory($model->digital_id, $model->digital->salt, $model->digital->view->md5path);
		if($setting != null)
			$digital_path = $setting->digital_path.'/'.$pathUnique;
		else
			$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathUnique;	

		$file = $model->digital->digital_path.'/'.$model->digital_filename;
		
		if($model->md5filepath == $path && $model->digital_filename != '' && file_exists($file))
			Yii::app()->getRequest()->sendFile(time().$model->digital->view->md5path.'.'.strtolower(pathinfo($model->digital_filename, PATHINFO_EXTENSION)), @file_get_contents($file));
		else
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
		
		//echo $model->digital->digital_path.'/'.$model->digital_filename;
	}
	
}
