<?php
/**
 * Digital Choices (digital-choice)
 * @var $this ChoiceController
 * @var $model DigitalChoice
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 22 December 2016, 10:35 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Choices'=>array('manage'),
		$model->choice_id=>array('view','id'=>$model->choice_id),
		'Update',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
