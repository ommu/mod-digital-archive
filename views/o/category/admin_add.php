<?php
/**
 * Digital Categories (digital-category)
 * @var $this CategoryController
 * @var $model DigitalCategory
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:13 WIB
 * @link https://github.com/ommu/ommu-digital-archive
 *
 */

	$this->breadcrumbs=array(
		'Digital Categories'=>array('manage'),
		'Create',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
