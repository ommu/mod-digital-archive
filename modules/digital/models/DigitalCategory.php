<?php
/**
 * DigitalCategory
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:09 WIB
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 *
 * --------------------------------------------------------------------------------------
 *
 * This is the model class for table "ommu_digital_category".
 *
 * The followings are the available columns in table 'ommu_digital_category':
 * @property integer $cat_id
 * @property integer $publish
 * @property string $cat_title
 * @property string $cat_desc
 * @property string $cat_code
 * @property string $cat_icon
 * @property string $cat_icon_image
 * @property string $cat_cover
 * @property string $cat_file_type
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property OmmuDigitals[] $ommuDigitals
 */
class DigitalCategory extends CActiveRecord
{
	public $defaultColumns = array();
	public $tag_input;
	public $old_cat_icon_image_input;
	public $old_cat_cover_input;
	
	// Variable Search
	public $creation_search;
	public $modified_search;

	/**
	 * Behaviors for this model
	 */
	public function behaviors() 
	{
		return array(
			'sluggable' => array(
				'class'=>'ext.yii-behavior-sluggable.SluggableBehavior',
				'columns' => array('cat_title'),
				'unique' => true,
				'update' => true,
			),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DigitalCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ommu_digital_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('publish, cat_title, cat_code, cat_file_type', 'required'),
			array('publish', 'numerical', 'integerOnly'=>true),
			array('cat_title, cat_icon', 'length', 'max'=>32),
			array('creation_id, modified_id', 'length', 'max'=>11),
			array('cat_code', 'length', 'max'=>6),
			array('cat_desc, cat_icon, cat_icon_image, cat_cover,
				old_cat_icon_image_input, old_cat_cover_input, tag_input', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cat_id, publish, cat_title, cat_desc, cat_code, cat_file_type, cat_icon, cat_icon_image, cat_cover, creation_date, creation_id, modified_date, modified_id,
				tag_input, creation_search, modified_search', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'view' => array(self::BELONGS_TO, 'ViewDigitalCategory', 'cat_id'),
			'digitals' => array(self::HAS_MANY, 'Digitals', 'cat_id'),
			'tags' => array(self::HAS_MANY, 'DigitalCategoryTag', 'cat_id'),
			'creation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cat_id' => Yii::t('attribute', 'Category'),
			'publish' => Yii::t('attribute', 'Publish'),
			'cat_title' => Yii::t('attribute', 'Category'),
			'cat_desc' => Yii::t('attribute', 'Description'),
			'cat_code' => Yii::t('attribute', 'Code'),
			'cat_icon' => Yii::t('attribute', 'Icon'),
			'cat_icon_image' => Yii::t('attribute', 'Icon Image'),
			'cat_cover' => Yii::t('attribute', 'Cover'),
			'cat_file_type' => Yii::t('attribute', 'File Type'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'tag_input' => Yii::t('attribute', 'Tags'),
			'old_cat_icon_image_input' => Yii::t('attribute', 'Old Cover'),
			'old_cat_cover_input' => Yii::t('attribute', 'Old Cover'),
			'creation_search' => Yii::t('attribute', 'Creation'),
			'modified_search' => Yii::t('attribute', 'Modified'),
		);
		/*
			'Cat' => 'Cat',
			'Publish' => 'Publish',
			'Cat Title' => 'Cat Title',
			'Cat Desc' => 'Cat Desc',
			'Creation Date' => 'Creation Date',
			'Creation' => 'Creation',
			'Modified Date' => 'Modified Date',
			'Modified' => 'Modified',
		
		*/
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		// Custom Search
		$criteria->with = array(
			'view' => array(
				'alias'=>'view',
			),
			'creation' => array(
				'alias'=>'creation',
				'select'=>'displayname',
			),
			'modified' => array(
				'alias'=>'modified',
				'select'=>'displayname',
			),
		);

		$criteria->compare('t.cat_id',$this->cat_id);
		if(isset($_GET['type']) && $_GET['type'] == 'publish')
			$criteria->compare('t.publish',1);
		elseif(isset($_GET['type']) && $_GET['type'] == 'unpublish')
			$criteria->compare('t.publish',0);
		elseif(isset($_GET['type']) && $_GET['type'] == 'trash')
			$criteria->compare('t.publish',2);
		else {
			$criteria->addInCondition('t.publish',array(0,1));
			$criteria->compare('t.publish',$this->publish);
		}
		$criteria->compare('t.cat_title',strtolower($this->cat_title),true);
		$criteria->compare('t.cat_desc',strtolower($this->cat_desc),true);
		$criteria->compare('t.cat_code',strtolower($this->cat_code),true);
		$criteria->compare('t.cat_icon',strtolower($this->cat_icon),true);
		$criteria->compare('t.cat_icon_image',strtolower($this->cat_icon_image),true);
		$criteria->compare('t.cat_cover',strtolower($this->cat_cover),true);
		$criteria->compare('t.cat_file_type',strtolower($this->cat_file_type),true);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		if(isset($_GET['creation']))
			$criteria->compare('t.creation_id',$_GET['creation']);
		else
			$criteria->compare('t.creation_id',$this->creation_id);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		if(isset($_GET['modified']))
			$criteria->compare('t.modified_id',$_GET['modified']);
		else
			$criteria->compare('t.modified_id',$this->modified_id);
		
		$criteria->compare('view.tags',strtolower($this->tag_input), true);
		$criteria->compare('creation.displayname',strtolower($this->creation_search), true);
		$criteria->compare('modified.displayname',strtolower($this->modified_search), true);

		if(!isset($_GET['DigitalCategory_sort']))
			$criteria->order = 't.cat_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>30,
			),
		));
	}


	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		} else {
			//$this->defaultColumns[] = 'cat_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'cat_title';
			$this->defaultColumns[] = 'cat_desc';
			$this->defaultColumns[] = 'cat_code';
			$this->defaultColumns[] = 'cat_icon';
			$this->defaultColumns[] = 'cat_icon_image';
			$this->defaultColumns[] = 'cat_cover';
			$this->defaultColumns[] = 'cat_file_type';
			$this->defaultColumns[] = 'creation_date';
			$this->defaultColumns[] = 'creation_id';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = 'modified_id';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			/*
			$this->defaultColumns[] = array(
				'class' => 'CCheckBoxColumn',
				'name' => 'id',
				'selectableRows' => 2,
				'checkBoxHtmlOptions' => array('name' => 'trash_id[]')
			);
			*/
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = array(
				'name' => 'cat_code',
				'value' => '$data->cat_code',
			);
			$this->defaultColumns[] = 'cat_title';
			$this->defaultColumns[] = 'cat_desc';
			$this->defaultColumns[] = array(
				'name' => 'tag_input',
				'value' => 'CHtml::link($data->view->tags, Yii::app()->controller->createUrl("o/categorytag/manage",array(\'category\'=>$data->cat_id)))',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'header' => Yii::t('phrase', 'Digitals'),
				'value' => 'CHtml::link($data->view->digitals, Yii::app()->controller->createUrl("o/admin/manage",array(\'category\'=>$data->cat_id, \'type\'=>\'publish\')))',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			/*
			$this->defaultColumns[] = array(
				'name' => 'creation_search',
				'value' => '$data->creation->displayname',
			);
			*/
			$this->defaultColumns[] = array(
				'name' => 'creation_date',
				'value' => 'Utility::dateFormat($data->creation_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'creation_date',
					'language' => 'en',
					'i18nScriptFile' => 'jquery-ui-i18n.min.js'
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'creation_date_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			$this->defaultColumns[] = array(
				'name' => 'cat_icon_image',
				'value' => '$data->cat_icon_image != \'\' ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'cat_cover',
				'value' => '$data->cat_cover != \'\' ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'cat_file_type',
				'value' => '$data->cat_file_type != \'\' ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->cat_id)), $data->publish, 1)',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'filter'=>array(
						1=>Yii::t('phrase', 'Yes'),
						0=>Yii::t('phrase', 'No'),
					),
					'type' => 'raw',
				);
			}
		}
		parent::afterConstruct();
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
		if($column != null) {
			$model = self::model()->findByPk($id,array(
				'select' => $column
			));
			return $model->$column;
			
		} else {
			$model = self::model()->findByPk($id);
			return $model;			
		}
	}

	/**
	 * Get category
	 * 0 = unpublish
	 * 1 = publish
	 */
	public static function getCategory($publish=null, $code=false) 
	{		
		$criteria=new CDbCriteria;
		if($publish != null)
			$criteria->compare('t.publish',$publish);
		
		$model = self::model()->findAll($criteria);

		$items = array();
		if($model != null) {
			foreach($model as $key => $val) {
				if($code == true && $val->cat_code != '')
					$items[$val->cat_id] = $val->cat_title.' ('.$val->cat_code.')';
				else
					$items[$val->cat_id] = $val->cat_title;
			}
			return $items;
			
		} else 
			return false;
	}

	/**
	 * Resize Category Cover
	 */
	public static function resizeCategoryCover($cover, $size) {
		Yii::import('ext.phpthumb.PhpThumbFactory');
		$categoryCover = PhpThumbFactory::create($cover, array('jpegQuality' => 90, 'correctPermissions' => true));
		$resizeSize = explode(',', $size);
		$categoryCover->adaptiveResize($resizeSize[0], $resizeSize[1]);					
		$categoryCover->save($cover);
		
		return true;
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'cover_file_type',
		));
		$cover_file_type = unserialize($setting->cover_file_type);
		
		if(parent::beforeValidate()) {
			$cat_icon_image = CUploadedFile::getInstance($this, 'cat_icon_image');
			if($cat_icon_image != null) {
				$extension = pathinfo($cat_icon_image->name, PATHINFO_EXTENSION);
				if(!in_array(strtolower($extension), $cover_file_type))
					$this->addError('cat_icon_image', Yii::t('phrase', 'The file {name} cannot be uploaded. Only files with these extensions are allowed: {extensions}.', array(
						'{name}'=>$cat_icon_image->name,
						'{extensions}'=>Utility::formatFileType($cover_file_type, false),
					)));
			}
			
			$cat_cover = CUploadedFile::getInstance($this, 'cat_cover');
			if($cat_cover != null) {
				$extension = pathinfo($cat_cover->name, PATHINFO_EXTENSION);
				if(!in_array(strtolower($extension), $cover_file_type))
					$this->addError('cat_cover', Yii::t('phrase', 'The file {name} cannot be uploaded. Only files with these extensions are allowed: {extensions}.', array(
						'{name}'=>$cat_cover->name,
						'{extensions}'=>Utility::formatFileType($cover_file_type, false),
					)));
			}
			
			if($this->isNewRecord)
				$this->creation_id = Yii::app()->user->id;
			else
				$this->modified_id = Yii::app()->user->id;
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {		
		if(parent::beforeSave()) {
			if(!$this->isNewRecord) {
				//digital photo location
				$digital_path = "public/digital";
				
				// Add digital directory
				if(!file_exists($digital_path)) {
					@mkdir($digital_path, 0777, true);

					// Add file in digital directory (index.php)
					$newFile = $digital_path.'/index.php';
					$FileHandle = fopen($newFile, 'w');
				} else
					@chmod($digital_path, 0755, true);
				
				$this->cat_icon_image = CUploadedFile::getInstance($this, 'cat_icon_image');
				if($this->cat_icon_image != null) {
					if($this->cat_icon_image instanceOf CUploadedFile) {
						$fileName = time().'_'.$this->cat_id.'_'.Utility::getUrlTitle($this->cat_title).'.'.strtolower($this->cat_icon_image->extensionName);
						if($this->cat_icon_image->saveAs($digital_path.'/'.$fileName)) {
							self::resizeCategoryCover($digital_path.'/'.$fileName, '300,300');
							if($this->old_cat_icon_image_input != '' && file_exists($digital_path.'/'.$this->old_cat_icon_image_input))
								rename($digital_path.'/'.$this->old_cat_icon_image_input, 'public/digital/verwijderen/'.$this->old_cat_icon_image_input);
							$this->cat_icon_image = $fileName;
						}
					}
				} else {
					if($this->cat_icon_image == '')
						$this->cat_icon_image = $this->old_cat_icon_image_input;					
				}
				
				$this->cat_cover = CUploadedFile::getInstance($this, 'cat_cover');
				if($this->cat_cover != null) {
					if($this->cat_cover instanceOf CUploadedFile) {
						$fileName = $this->cat_id.'_'.time().'_'.Utility::getUrlTitle($this->cat_title).'.'.strtolower($this->cat_cover->extensionName);
						if($this->cat_cover->saveAs($digital_path.'/'.$fileName)) {
							self::resizeCategoryCover($digital_path.'/'.$fileName, '360,380');
							if($this->old_cat_cover_input != '' && file_exists($digital_path.'/'.$this->old_cat_cover_input))
								rename($digital_path.'/'.$this->old_cat_cover_input, 'public/digital/verwijderen/'.$this->old_cat_cover_input);
							$this->cat_cover = $fileName;
						}
					}
				} else {
					if($this->cat_cover == '')
						$this->cat_cover = $this->old_cat_cover_input;					
				}				
			}
			$this->cat_code = strtoupper($this->cat_code);	
			$this->cat_file_type = serialize(Utility::formatFileType($this->cat_file_type));
		}
		return true;
	}
	
	/**
	 * After save attributes
	 */
	protected function afterSave() {
		parent::afterSave();
		
		if($this->isNewRecord) {
			//digital photo location
			$digital_path = "public/digital";
			
			// Add digital directory
			if(!file_exists($digital_path)) {
				@mkdir($digital_path, 0777, true);

				// Add file in digital directory (index.php)
				$newFile = $digital_path.'/index.php';
				$FileHandle = fopen($newFile, 'w');
			} else
				@chmod($digital_path, 0755, true);
			
			$this->cat_icon_image = CUploadedFile::getInstance($this, 'cat_icon_image');
			if($this->cat_icon_image != null) {
				if($this->cat_icon_image instanceOf CUploadedFile) {
					$fileName = time().'_'.$this->cat_id.'_'.Utility::getUrlTitle($this->cat_title).'.'.strtolower($this->cat_icon_image->extensionName);
					if($this->cat_icon_image->saveAs($digital_path.'/'.$fileName)) {
						self::resizeCategoryCover($digital_path.'/'.$fileName, '300,300');
						self::model()->updateByPk($this->cat_id, array('cat_icon_image'=>$fileName));
					}
				}
			}
			
			$this->cat_cover = CUploadedFile::getInstance($this, 'cat_cover');
			if($this->cat_cover != null) {
				if($this->cat_cover instanceOf CUploadedFile) {
					$fileName = time().'_'.$this->cat_id.'_'.Utility::getUrlTitle($this->cat_title).'.'.strtolower($this->cat_cover->extensionName);
					if($this->cat_cover->saveAs($digital_path.'/'.$fileName)) {
						self::resizeCategoryCover($digital_path.'/'.$fileName, '360,380');
						self::model()->updateByPk($this->cat_id, array('cat_cover'=>$fileName));
					}
				}
			}
			
			//input tag
			if(trim($this->tag_input) != '') {
				$tag_input = Utility::formatFileType($this->tag_input);
				if(!empty($tag_input)) {
					foreach($tag_input as $key => $val) {
						$tag = new DigitalCategoryTag;
						$tag->cat_id = $this->cat_id;
						$tag->tag_id = 0;
						$tag->tag_input = $val;
						$tag->save();
					}
				}
			}
		}
	}

	/**
	 * After delete attributes
	 */
	protected function afterDelete() {
		parent::afterDelete();
		//delete digital location image
		$digital_path = "public/digital";
		
		if($this->cat_icon_image != '' && file_exists($digital_path.'/'.$this->cat_icon_image))
			rename($digital_path.'/'.$this->cat_icon_image, 'public/digital/verwijderen/'.$this->cat_icon_image);
		
		if($this->cat_cover != '' && file_exists($digital_path.'/'.$this->cat_cover))
			rename($digital_path.'/'.$this->cat_cover, 'public/digital/verwijderen/'.$this->cat_cover);
	}

}