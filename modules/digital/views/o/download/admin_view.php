<?php
/**
 * Digital Downloads (digital-downloads)
 * @var $this DownloadController
 * @var $model DigitalDownloads
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (ommu.co)
 * @created date 8 January 2017, 20:54 WIB
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Digital Downloads'=>array('manage'),
		$model->download_id,
	);
?>

<div class="dialog-content">
	<?php $this->widget('application.components.system.FDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array(
				'name'=>'download_id',
				'value'=>$model->download_id,
				//'value'=>$model->download_id != '' ? $model->download_id : '-',
			),
			array(
				'name'=>'file_id',
				'value'=>$model->file_id,
				//'value'=>$model->file_id != '' ? $model->file_id : '-',
			),
			array(
				'name'=>'user_id',
				'value'=>$model->user_id,
				//'value'=>$model->user_id != '' ? $model->user_id : '-',
			),
			array(
				'name'=>'downloads',
				'value'=>$model->downloads,
				//'value'=>$model->downloads != '' ? $model->downloads : '-',
			),
			array(
				'name'=>'download_date',
				'value'=>!in_array($model->download_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->download_date, true) : '-',
			),
			array(
				'name'=>'download_ip',
				'value'=>$model->download_ip,
				//'value'=>$model->download_ip != '' ? $model->download_ip : '-',
			),
		),
	)); ?>
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
