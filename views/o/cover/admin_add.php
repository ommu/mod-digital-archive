<?php
/**
 * Digital Covers (digital-cover)
 * @var $this CoverController
 * @var $model DigitalCover
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 7 November 2016, 09:56 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 */

	$this->breadcrumbs=array(
		'Digital Covers'=>array('manage'),
		Yii::t('phrase', 'Create'),
	);
?>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model, 
	'digital'=>$digital,
	'setting'=>$setting,
	'cover_file_type'=>$cover_file_type,
)); ?>