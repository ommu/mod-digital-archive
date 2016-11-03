<?php
/**
 * View Digital Tags (view-digital-tag)
 * @var $this TagController
 * @var $model ViewDigitalTag
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 3 November 2016, 16:42 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'View Digital Tags'=>array('manage'),
		$model->tag_id=>array('view','id'=>$model->tag_id),
		'Update',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
