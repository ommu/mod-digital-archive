<?php
/**
 * Digital Covers (digital-cover)
 * @var $this CoverController
 * @var $model DigitalCover
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 7 November 2016, 09:56 WIB
 * @link https://github.com/ommu/Digital-Archive
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Covers'=>array('manage'),
		$model->cover_id=>array('view','id'=>$model->cover_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model, 
	'setting'=>$setting,
	'cover_file_type'=>$cover_file_type,
)); ?>