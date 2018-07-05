<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 */

	$this->breadcrumbs=array(
		'Digitals'=>array('manage'),
		'Create',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('_form', array(
		'model'=>$model,
		'publisher'=>$publisher,
		'setting'=>$setting,
		'cover_file_type'=>$cover_file_type,
		'digital_file_type'=>$digital_file_type,
		'form_custom_field'=>$form_custom_field,
	)); ?>
</div>
