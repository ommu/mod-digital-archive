<?php
/**
 * MediaController
 * @var $this MediaController
 * Reference start
 *
 * TOC :
 *	Index
 *	Cover
 *	File
 *	Download
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/mod-digital-archive
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
		$permission = DigitalSetting::getInfo('permission');
		if($permission == 1 || ($permission == 0 && !Yii::app()->user->isGuest)) {
			$arrThemes = Utility::getCurrentTemplate('public');
			Yii::app()->theme = $arrThemes['folder'];
			$this->layout = $arrThemes['layout'];
			Utility::applyViewPath(__dir__);
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
				'actions'=>array('index','cover','file','download'),
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
		$size = $_GET['size'];
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'digital_path, cover_view_size',
		));
		$cover_view_size = unserialize($setting->cover_view_size);
		
		$model = DigitalCover::model()->findByPk($id);
		
		$digital_path = $model->digital->digital_path;	
		if($digital_path == '') {
			$pathUnique = $model->digital->view->uniquepath;
			if($setting != null)
				$digital_path = $setting->digital_path.'/'.$pathUnique;
			else
				$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathUnique;
		}
		
		$cover = $digital_path.'/'.$model->cover_filename;
		if(isset($size))
			$coverGET = $digital_path.'/'.strtolower($size).'_'.$model->cover_filename;
		
		if($model->md5coverpath == $path && $model->cover_filename != '' && file_exists($cover)) {
			Yii::import('ext.phpthumb.PhpThumbFactory');
			foreach($cover_view_size as $key => $val) {
				$coverConvert = $digital_path.'/'.$key.'_'.$model->cover_filename;
				if(!file_exists($coverConvert)) {
					$resizeCover = PhpThumbFactory::create($cover, array('jpegQuality' => 90, 'correctPermissions' => true));
					if($val['height'] == 0)
						$resizeCover->resize($val['width']);
					else
						$resizeCover->adaptiveResize($val['width'], $val['height']);
					$resizeCover->save($coverConvert);
				}
			}
			Yii::app()->getRequest()->sendFile(time().$model->digital->view->md5path.'.'.strtolower(pathinfo($model->cover_filename, PATHINFO_EXTENSION)), @file_get_contents(isset($size) ? $coverGET : $cover));
		} else
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
			
		//echo $model->digital->digital_path.'/'.$model->cover_filename;
	}
	
	/**
	 * Lists all models.
	 */
	public function actionFile($id) 
	{
		$path = $_GET['abc'];
		$size = $_GET['size'];
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'digital_path, cover_view_size, cover_file_type',
		));
		$cover_view_size = unserialize($setting->cover_view_size);
		$cover_file_type = unserialize($setting->cover_file_type);
		
		$model = DigitalFile::model()->findByPk($id);
		
		$digital_path = $model->digital->digital_path;		
		if($digital_path == '') {
			$pathUnique = $model->digital->view->uniquepath;
			if($setting != null)
				$digital_path = $setting->digital_path.'/'.$pathUnique;
			else
				$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathUnique;
		}
		
		$condition = 0;		
		$file = $digital_path.'/'.$model->digital_filename;
		if(isset($size))
			$fileGET = $digital_path.'/'.strtolower($size).'_'.$model->digital_filename;
		
		if($model->md5filepath == $path && $model->digital_filename != '' && file_exists($file)) {
			$extension = pathinfo($model->digital_filename, PATHINFO_EXTENSION);
			if(in_array(strtolower($extension), $cover_file_type)) {
				$condition = 1;
				Yii::import('ext.phpthumb.PhpThumbFactory');
				foreach($cover_view_size as $key => $val) {
					$fileConvert = $digital_path.'/'.$key.'_'.$model->digital_filename;
					if(!file_exists($fileConvert)) {
						$resizeFile = PhpThumbFactory::create($file, array('jpegQuality' => 90, 'correctPermissions' => true));
						if($val['height'] == 0)
							$resizeFile->resize($val['width']);
						else
							$resizeFile->adaptiveResize($val['width'], $val['height']);
						$resizeFile->save($fileConvert);
					}
				}
			}
			//DigitalDownloads::insertDownload($id, '0');
			Yii::app()->getRequest()->sendFile(time().$model->digital->view->md5path.'.'.strtolower(pathinfo($model->digital_filename, PATHINFO_EXTENSION)), @file_get_contents(isset($size) && $condition == 1 ? $fileGET : $file));
			
		} else
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
		
		//echo $model->digital->digital_path.'/'.$model->digital_filename;
	}
	
	/**
	 * Lists all models.
	 */
	public function actionDownload($id) 
	{
		$path = $_GET['abc'];
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'digital_path',
		));
		$model = DigitalFile::model()->findByPk($id);
		
		$digital_path = $model->digital->digital_path;		
		if($digital_path == '') {
			$pathUnique = $model->digital->view->uniquepath;
			if($setting != null)
				$digital_path = $setting->digital_path.'/'.$pathUnique;
			else
				$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathUnique;
		}

		$file = $digital_path.'/'.$model->digital_filename;
		
		if($model->md5filepath == $path && $model->digital_filename != '' && file_exists($file)) {
			DigitalDownloads::insertDownload($id, '1');
			$this->redirect(Yii::app()->request->baseUrl.'/public/digital/'.$model->digital->view->uniquepath.'/'.$model->digital_filename);
			//Yii::app()->getRequest()->sendFile(time().$model->digital->view->md5path.'.'.strtolower(pathinfo($model->digital_filename, PATHINFO_EXTENSION)), @file_get_contents($file));
			
		} else
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
		
		//echo $model->digital->digital_path.'/'.$model->digital_filename;
	}
	
}
