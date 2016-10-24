<?php
/**
 * Digitals
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:11 WIB
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
 * This is the model class for table "ommu_digitals".
 *
 * The followings are the available columns in table 'ommu_digitals':
 * @property string $digital_id
 * @property integer $publish
 * @property integer $cat_id
 * @property string $publisher_id
 * @property integer $language_id
 * @property integer $opac_id
 * @property string $digital_code
 * @property string $digital_title
 * @property string $digital_intro
 * @property string $digital_path
 * @property string $publish_year
 * @property string $publish_location
 * @property string $isbn
 * @property string $subjects
 * @property string $pages
 * @property string $series
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property OmmuDigitalAuthors[] $ommuDigitalAuthors
 * @property OmmuDigitalHistoryPrint[] $ommuDigitalHistoryPrints
 * @property OmmuDigitalTag[] $ommuDigitalTags
 * @property OmmuDigitalCategory $cat
 * @property OmmuDigitalLanguage $language
 * @property OmmuDigitalPublisher $publisher
 */
class Digitals extends CActiveRecord
{
	public $defaultColumns = array();
	public $digital_file_input;
	public $multiple_file_input;
	
	// Variable Search
	public $publisher_search;
	public $creation_search;
	public $modified_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Digitals the static model class
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
		return 'ommu_digitals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_id, publish, language_id, digital_title, digital_intro, subjects', 'required'),
			array('publish, cat_id, language_id, opac_id', 'numerical', 'integerOnly'=>true),
			array('publisher_id, creation_id, modified_id', 'length', 'max'=>11),
			array('digital_code', 'length', 'max'=>16),
			array('publish_year', 'length', 'max'=>4),
			array('isbn', 'length', 'max'=>32),
			array('pages', 'length', 'max'=>5),
			array('publisher_id, opac_id, digital_code, digital_path, publish_year, publish_location, isbn, subjects, pages, series,
				digital_file_input, multiple_file_input', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('digital_id, publish, cat_id, publisher_id, language_id, opac_id, digital_code, digital_title, digital_intro, digital_path, publish_year, publish_location, isbn, subjects, pages, series, creation_date, creation_id, modified_date, modified_id,
				publisher_search, creation_search, modified_search', 'safe', 'on'=>'search'),
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
			'authors' => array(self::HAS_MANY, 'DigitalAuthors', 'digital_id'),
			'history_prints' => array(self::HAS_MANY, 'DigitalHistoryPrint', 'digital_id'),
			'tags' => array(self::HAS_MANY, 'DigitalTag', 'digital_id'),
			'category' => array(self::BELONGS_TO, 'DigitalCategory', 'cat_id'),
			'language' => array(self::BELONGS_TO, 'DigitalLanguage', 'language_id'),
			'publisher' => array(self::BELONGS_TO, 'DigitalPublisher', 'publisher_id'),
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
			'digital_id' => Yii::t('attribute', 'Digital'),
			'publish' => Yii::t('attribute', 'Publish'),
			'cat_id' => Yii::t('attribute', 'Category'),
			'publisher_id' => Yii::t('attribute', 'Publisher'),
			'language_id' => Yii::t('attribute', 'Language'),
			'opac_id' => Yii::t('attribute', 'OPAC'),
			'digital_code' => Yii::t('attribute', 'Code'),
			'digital_title' => Yii::t('attribute', 'Title'),
			'digital_intro' => Yii::t('attribute', 'Introduction'),
			'digital_path' => Yii::t('attribute', 'Directory'),
			'publish_year' => Yii::t('attribute', 'Publish Year'),
			'publish_location' => Yii::t('attribute', 'Publish Location'),
			'isbn' => Yii::t('attribute', 'Isbn'),
			'subjects' => Yii::t('attribute', 'Subjects'),
			'pages' => Yii::t('attribute', 'Pages'),
			'series' => Yii::t('attribute', 'Series'),
			'digital_file_input' => Yii::t('attribute', 'Digital File'),
			'multiple_file_input' => Yii::t('attribute', 'Multiple File'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'publisher_search' => Yii::t('attribute', 'Publisher'),
			'creation_search' => Yii::t('attribute', 'Creation'),
			'modified_search' => Yii::t('attribute', 'Modified'),
		);
		/*
			'Digital' => 'Digital',
			'Publish' => 'Publish',
			'Cat' => 'Cat',
			'Publisher' => 'Publisher',
			'Language' => 'Language',
			'Opac' => 'Opac',
			'Digital Code' => 'Digital Code',
			'Digital Title' => 'Digital Title',
			'Digital Intro' => 'Digital Intro',
			'Digital Cover' => 'Digital Cover',
			'Publish Year' => 'Publish Year',
			'Publish Location' => 'Publish Location',
			'Isbn' => 'Isbn',
			'Subjects' => 'Subjects',
			'Pages' => 'Pages',
			'Series' => 'Series',
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

		$criteria->compare('t.digital_id',strtolower($this->digital_id),true);
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
		if(isset($_GET['category']))
			$criteria->compare('t.cat_id',$_GET['category']);
		else
			$criteria->compare('t.cat_id',$this->cat_id);
		if(isset($_GET['publisher']))
			$criteria->compare('t.publisher_id',$_GET['publisher']);
		else
			$criteria->compare('t.publisher_id',$this->publisher_id);
		if(isset($_GET['language']))
			$criteria->compare('t.language_id',$_GET['language']);
		else
			$criteria->compare('t.language_id',$this->language_id);
		$criteria->compare('t.opac_id',$this->opac_id);
		$criteria->compare('t.digital_code',strtolower($this->digital_code),true);
		$criteria->compare('t.digital_title',strtolower($this->digital_title),true);
		$criteria->compare('t.digital_intro',strtolower($this->digital_intro),true);
		$criteria->compare('t.digital_path',strtolower($this->digital_path),true);
		$criteria->compare('t.publish_year',strtolower($this->publish_year),true);
		$criteria->compare('t.publish_location',strtolower($this->publish_location),true);
		$criteria->compare('t.isbn',strtolower($this->isbn),true);
		$criteria->compare('t.subjects',strtolower($this->subjects),true);
		$criteria->compare('t.pages',strtolower($this->pages),true);
		$criteria->compare('t.series',strtolower($this->series),true);
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
		
		// Custom Search
		$criteria->with = array(
			'publisher' => array(
				'alias'=>'publisher',
				'select'=>'publisher_name',
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
		$criteria->compare('publisher.publisher_name',strtolower($this->publisher_search), true);
		$criteria->compare('creation.displayname',strtolower($this->creation_search), true);
		$criteria->compare('modified.displayname',strtolower($this->modified_search), true);

		if(!isset($_GET['Digitals_sort']))
			$criteria->order = 't.digital_id DESC';

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
			//$this->defaultColumns[] = 'digital_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'cat_id';
			$this->defaultColumns[] = 'publisher_id';
			$this->defaultColumns[] = 'language_id';
			$this->defaultColumns[] = 'opac_id';
			$this->defaultColumns[] = 'digital_code';
			$this->defaultColumns[] = 'digital_title';
			$this->defaultColumns[] = 'digital_intro';
			$this->defaultColumns[] = 'digital_path';
			$this->defaultColumns[] = 'publish_year';
			$this->defaultColumns[] = 'publish_location';
			$this->defaultColumns[] = 'isbn';
			$this->defaultColumns[] = 'subjects';
			$this->defaultColumns[] = 'pages';
			$this->defaultColumns[] = 'series';
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
			$this->defaultColumns[] = 'digital_code';
			if(!isset($_GET['category'])) {
				$this->defaultColumns[] = array(
					'name' => 'cat_id',
					'value' => '$data->category->cat_title',
					'filter' => DigitalCategory::getCategory(),
				);
			}
			$this->defaultColumns[] = 'digital_title';
			if(!isset($_GET['publisher'])) {
				$this->defaultColumns[] = array(
					'name' => 'publisher_search',
					'value' => '$data->publisher->publisher_name',
				);
			}
			if(!isset($_GET['category'])) {
				$this->defaultColumns[] = array(
					'name' => 'language_id',
					'value' => '$data->language->language_name',
					'filter' => DigitalLanguage::getLanguage(),
				);
			}
			$this->defaultColumns[] = array(
				'name' => 'opac_id',
				'value' => '$data->opac_id != 0 ? $data->opac_id : \'-\'',
			);
			$this->defaultColumns[] = array(
				'name' => 'publish_year',
				'value' => '!in_array($data->publish_year, array(\'0000\', \'1970\')) ? $data->publish_year : "-"',
			);
			$this->defaultColumns[] = array(
				'name' => 'creation_date',
				'value' => 'Utility::dateFormat($data->creation_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'creation_date',
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
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
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->digital_id)), $data->publish, 1)',
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
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
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
			$this->subjects = serialize($this->subjects);
		}
		return true;
	}
	
	/**
	 * After save attributes
	 */
	protected function afterSave() {
		parent::afterSave();
		$action = strtolower(Yii::app()->controller->action->id);
			
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'cover_limit, cover_resize, cover_resize_size, cover_file_type, digital_path, digital_file_type',
		));
		
		// Add directory
		if($model->isNewRecord) {
			$pathTitle = Utility::getUrlTitle($this->digital_id.' '.$this->digital_title);
			if($setting != null)
				$digital_path = $setting->digital_path.'/'.$pathTitle;
			else
				$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathTitle;
		
			if(!file_exists($digital_path)) {
				@mkdir($digital_path, 0755, true);

				// Add file in directory (index.php)
				$newFile = $digital_path.'/index.php';
				$FileHandle = fopen($newFile, 'w');
			}
			self::model()->updateByPk($this->digital_id, array('digital_path'=>$digital_path));
			
		} else
			$digital_path = $this->digital_path;
		
		if(!$model->isNewRecord && $action == 'upload') {
			$this->digital_file_input = CUploadedFile::getInstance($this, 'digital_file_input');
			if($this->digital_file_input instanceOf CUploadedFile) {
				$fileName = time().'_'.$this->digital_id.'_'.Utility::getUrlTitle($this->digital_title).'.'.strtolower($this->digital_file_input->extensionName);
				if($this->digital_file_input->saveAs($digital_path.'/'.$fileName)) {
					if($this->multiple_file_input == 0) {
						$digital = new DigitalFile;
						$digital->digital_id = $this->digital_id;
						$digital->digital_filename = $fileName;
						$digital->save();
						
					} else {
						echo 'upload compress file';
					}
				}
			}
			
		}
		
	}

}