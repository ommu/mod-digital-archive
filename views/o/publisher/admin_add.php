<?php
/**
 * Digital Publishers (digital-publisher)
 * @var $this PublisherController
 * @var $model DigitalPublisher
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 20 October 2016, 10:13 WIB
 * @link https://github.com/ommu/mod-digital-archive
 *
 */

	$this->breadcrumbs=array(
		'Digital Publishers'=>array('manage'),
		'Create',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>