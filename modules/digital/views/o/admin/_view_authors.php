<?php
/**
 * Digitals (digitals)
 * @var $this AdminController
 * @var $model Digitals
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:14 WIB
 * @link https://github.com/ommu/Digital-Archive
 * @contact (+62)856-299-4114
 *
 */
?>

<?php 
$count = count($authors);
$i=0;
foreach($authors as $key => $val) {
	$i++;
	if($count != $i) {?>
		<a href="<?php echo Yii::app()->controller->createUrl('o/authors/manage',array('author'=>$val->author_id));?>" title="<?php echo $val->author->author_name?>"><?php echo $val->author->author_name?></a>, 
	<?php } else {?>
		<a href="<?php echo Yii::app()->controller->createUrl('o/authors/manage',array('author'=>$val->author_id));?>" title="<?php echo $val->author->author_name?>"><?php echo $val->author->author_name?></a>	
<?php }
}?>