<?php
/**
 * Digital Files (digital-file)
 * @var $this FileController
 * @var $model DigitalFile
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 7 November 2016, 09:56 WIB
 * @link https://github.com/ommu/Digital-Archive
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Files'=>array('manage'),
		$model->file_id=>array('view','id'=>$model->file_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model, 
	'setting'=>$setting,
	'digital_file_type'=>$digital_file_type,
)); ?>