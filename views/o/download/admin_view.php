<?php
/**
 * Digital Downloads (digital-downloads)
 * @var $this DownloadController
 * @var $model DigitalDownloads
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 8 January 2017, 20:54 WIB
 * @link https://github.com/ommu/ommu-digital-archive
 *
 */

	$this->breadcrumbs=array(
		'Digital Downloads'=>array('manage'),
		$model->download_id,
	);
?>

<div class="dialog-content">
	<?php $this->widget('application.libraries.core.components.system.FDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'name'=>'download_id',
				'value'=>$model->download_id,
			),
			array(
				'name'=>'file_id',
				'value'=>CHtml::link($model->file->digital_filename, Yii::app()->controller->createUrl('media/file',array('id'=>$model->file_id,'abc'=>$model->file->md5filepath))),
				'type'=>'raw',
			),
			array(
				'name'=>'digital',
				'value'=>$model->file->digital->digital_title,
			),
			array(
				'name'=>'user_id',
				'value'=>$model->user_id != 0 ? $model->user->displayname : '-',
			),
			array(
				'name'=>'downloads',
				'value'=>$model->downloads != 0 ? CHtml::link($model->downloads, Yii::app()->controller->createUrl('o/downloaddetail/manage',array('download'=>$model->download_id))) : '-',
				'type'=>'raw',
			),
			array(
				'name'=>'download_date',
				'value'=>!in_array($model->download_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->download_date, true) : '-',
			),
			array(
				'name'=>'download_ip',
				'value'=>$model->download_ip != '' ? $model->download_ip : '-',
			),
		),
	)); ?>
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>