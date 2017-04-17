<?php
/**
 * Digitals
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 20 October 2016, 10:11 WIB
 * @link https://github.com/ommu/Digital-Archive
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
 * @property integer $headline
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
 * @property string $pages
 * @property string $series
 * @property string $salt
 * @property string $content_verified
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 * @property string $headline_date
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
	public $cover_input;
	public $cover_old_input;
	public $digital_file_input;
	public $multiple_file_input;
	public $author_input;
	public $subject_input;
	public $tag_input;
	public $editor_choice_input;
	
	// Variable Search
	public $publisher_search;
	public $cover_search;
	public $file_search;
	public $like_search;
	public $view_search;
	public $choice_search;
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
				'columns' => array('digital_title'),
				'unique' => true,
				'update' => true,
			),
		);
	}

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
			array('publish, headline, digital_title, digital_intro, content_verified', 'required'),
			array('cat_id, language_id', 'required', 'on'=>'standardForm'),
			array('publish, headline, cat_id, language_id, opac_id, content_verified', 'numerical', 'integerOnly'=>true),
			array('publisher_id, creation_id, modified_id', 'length', 'max'=>11),
			array('digital_code', 'length', 'max'=>16),
			array('publish_year', 'length', 'max'=>4),
			array('isbn, salt', 'length', 'max'=>32),
			array('pages', 'length', 'max'=>5),
			array('publisher_id, opac_id, digital_code, digital_path, publish_year, publish_location, isbn, pages, series, salt,
				cover_input, cover_old_input, digital_file_input, multiple_file_input, author_input, subject_input, tag_input', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('digital_id, publish, headline, cat_id, publisher_id, language_id, opac_id, digital_code, digital_title, digital_intro, digital_path, publish_year, publish_location, isbn, pages, series, salt, content_verified, creation_date, creation_id, modified_date, modified_id, headline_date,
				editor_choice_input, 
				publisher_search, cover_search, file_search, like_search, view_search, choice_search, creation_search, modified_search', 'safe', 'on'=>'search'),
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
			'view' => array(self::BELONGS_TO, 'ViewDigitals', 'digital_id'),
			'category' => array(self::BELONGS_TO, 'DigitalCategory', 'cat_id'),
			'language' => array(self::BELONGS_TO, 'DigitalLanguage', 'language_id'),
			'publisher' => array(self::BELONGS_TO, 'DigitalPublisher', 'publisher_id'),
			'creation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
			'authors' => array(self::HAS_MANY, 'DigitalAuthors', 'digital_id'),
			'choices' => array(self::HAS_MANY, 'DigitalChoice', 'digital_id'),
			'covers' => array(self::HAS_MANY, 'DigitalCover', 'digital_id', 'on'=>'covers.publish=1'),
			'files' => array(self::HAS_MANY, 'DigitalFile', 'digital_id', 'on'=>'files.publish=1'),
			'history_prints' => array(self::HAS_MANY, 'DigitalHistoryPrint', 'digital_id'),
			'likes' => array(self::HAS_MANY, 'DigitalLikes', 'digital_id'),	
			'subjects' => array(self::HAS_MANY, 'DigitalSubjects', 'digital_id'),
			'tags' => array(self::HAS_MANY, 'DigitalTags', 'digital_id'),
			'views' => array(self::HAS_MANY, 'DigitalViews', 'digital_id'),
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
			'headline' => Yii::t('attribute', 'Headline'),
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
			'isbn' => Yii::t('attribute', 'ISBN/ISSN/ISMN'),
			'pages' => Yii::t('attribute', 'Pages'),
			'series' => Yii::t('attribute', 'Series'),
			'salt' => Yii::t('attribute', 'Salt'),
			'content_verified' => Yii::t('attribute', 'Verified'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'headline_date' => Yii::t('attribute', 'Headline Date'),
			'cover_input' => Yii::t('attribute', 'Cover (Photo)'),
			'cover_old_input' => Yii::t('attribute', 'Old Cover (Photo)'),
			'digital_file_input' => Yii::t('attribute', 'Digital File'),
			'multiple_file_input' => Yii::t('attribute', 'Multiple File'),
			'author_input' => Yii::t('attribute', 'Authors'),
			'subject_input' => Yii::t('attribute', 'Subjects'),
			'tag_input' => Yii::t('attribute', 'Tags'),
			'editor_choice_input' => Yii::t('attribute', 'Editor Choice'),
			'publisher_search' => Yii::t('attribute', 'Publisher'),
			'cover_search' => Yii::t('attribute', 'Covers'),
			'file_search' => Yii::t('attribute', 'Files'),
			'like_search' => Yii::t('attribute', 'Likes'),
			'view_search' => Yii::t('attribute', 'Views'),
			'choice_search' => Yii::t('attribute', 'Choices'),
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
		
		// Custom Search
		$criteria->with = array(
			'publisher' => array(
				'alias'=>'publisher',
				'select'=>'publisher_name',
			),
			'view' => array(
				'alias'=>'view',
				'select'=>'covers, files, likes, views, choices',
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
		$criteria->compare('t.headline',$this->headline);
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
		$criteria->compare('t.pages',strtolower($this->pages),true);
		$criteria->compare('t.series',strtolower($this->series),true);
		$criteria->compare('t.salt',strtolower($this->salt),true);
		$criteria->compare('t.content_verified',$this->content_verified);
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
		if($this->headline_date != null && !in_array($this->headline_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.headline_date)',date('Y-m-d', strtotime($this->headline_date)));
		$criteria->compare('t.editor_choice_input',$this->editor_choice_input);
		
		$criteria->compare('publisher.publisher_name',strtolower($this->publisher_search), true);
		$criteria->compare('view.covers',$this->cover_search);
		$criteria->compare('view.files',$this->file_search);
		$criteria->compare('view.likes',$this->like_search);
		$criteria->compare('view.views',$this->view_search);
		$criteria->compare('view.choices',$this->choice_search);
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
			$this->defaultColumns[] = 'headline';
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
			$this->defaultColumns[] = 'pages';
			$this->defaultColumns[] = 'series';
			$this->defaultColumns[] = 'salt';
			$this->defaultColumns[] = 'content_verified';
			$this->defaultColumns[] = 'creation_date';
			$this->defaultColumns[] = 'creation_id';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = 'modified_id';
			$this->defaultColumns[] = 'headline_date';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'headline, form_standard, form_custom_field, editor_choice_status, editor_choice_userlevel, content_verified',
		));
		$form_custom_field = unserialize($setting->form_custom_field);		
		if(empty($form_custom_field))
			$form_custom_field = array();
		$editor_choice_userlevel = unserialize($setting->editor_choice_userlevel);
		
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
			//$this->defaultColumns[] = 'digital_code';
			if(!isset($_GET['category']) && ($setting->form_standard == 1 || ($setting->form_standard == 0 && in_array('cat_id', $form_custom_field)))) {
				$this->defaultColumns[] = array(
					'name' => 'cat_id',
					'value' => '$data->category->cat_title',
					'filter' => DigitalCategory::getCategory(),
				);
			}
			$this->defaultColumns[] = 'digital_title';
			if(!isset($_GET['publisher']) && ($setting->form_standard == 1 || ($setting->form_standard == 0 && in_array('publisher_id', $form_custom_field)))) {
				$this->defaultColumns[] = array(
					'name' => 'publisher_search',
					'value' => '$data->publisher->publisher_name',
				);
			}
			if(!isset($_GET['language']) && ($setting->form_standard == 1 || ($setting->form_standard == 0 && in_array('language_id', $form_custom_field)))) {
				$this->defaultColumns[] = array(
					'name' => 'language_id',
					'value' => '$data->language->language_name',
					'filter' => DigitalLanguage::getLanguage(),
				);
			}
			if($setting->form_standard == 1 || ($setting->form_standard == 0 && in_array('opac_id', $form_custom_field))) {
				$this->defaultColumns[] = array(
					'name' => 'opac_id',
					'value' => '$data->opac_id != 0 ? $data->opac_id : \'-\'',
				);				
			}
			if($setting->form_standard == 1 || ($setting->form_standard == 0 && in_array('publish_year', $form_custom_field))) {
				$this->defaultColumns[] = array(
					'name' => 'publish_year',
					'value' => '!in_array($data->publish_year, array(\'0000\', \'1970\')) ? $data->publish_year : "-"',
				);
			}
			if($setting->form_standard == 0) {
				$this->defaultColumns[] = array(
					'name' => 'cover_search',
					'value' => 'CHtml::link($data->view->covers != null ? $data->view->covers : "0", Yii::app()->controller->createUrl("o/cover/manage",array(\'digital\'=>$data->digital_id,\'publish\'=>1)))',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'type' => 'raw',
				);
			}
			$this->defaultColumns[] = array(
				'name' => 'file_search',
				'value' => 'CHtml::link($data->view->files != null ? $data->view->files : "0", Yii::app()->controller->createUrl("o/file/manage",array(\'digital\'=>$data->digital_id,\'publish\'=>1)))',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			if($setting->form_standard == 0) {
				$this->defaultColumns[] = array(
					'name' => 'like_search',
					'value' => 'CHtml::link($data->view->likes != null ? $data->view->likes : "0", Yii::app()->controller->createUrl("o/likes/manage",array(\'digital\'=>$data->digital_id,\'publish\'=>1)))',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'type' => 'raw',
				);
			}
			if($setting->form_standard == 0) {
				$this->defaultColumns[] = array(
					'name' => 'view_search',
					'value' => 'CHtml::link($data->view->views != null ? $data->view->views : "0", Yii::app()->controller->createUrl("o/views/manage",array(\'digital\'=>$data->digital_id,\'publish\'=>1)))',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'type' => 'raw',
				);
			}
			if($setting->form_standard == 0) {
				$this->defaultColumns[] = array(
					'name' => 'choice_search',
					'value' => 'CHtml::link($data->view->choices != null ? $data->view->choices : "0", Yii::app()->controller->createUrl("o/choice/manage",array(\'digital\'=>$data->digital_id,\'publish\'=>1)))',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'type' => 'raw',
				);
			}
			if($setting->form_standard == 1) {
				$this->defaultColumns[] = array(
					'name' => 'creation_date',
					'value' => 'Utility::dateFormat($data->creation_date)',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'filter' => Yii::app()->controller->widget('application.components.system.CJuiDatePicker', array(
						'model'=>$this,
						'attribute'=>'creation_date',
						'language' => 'en',
						'i18nScriptFile' => 'jquery-ui-i18n.min.js',
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
			}				
			if($setting->content_verified == 1) {
				$this->defaultColumns[] = array(
					'name' => 'content_verified',
					'value' => '$data->content_verified == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
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
			if($setting->editor_choice_status == 1 && in_array(Yii::app()->user->level, $editor_choice_userlevel)) {
				$this->defaultColumns[] = array(
					'header' => Yii::t('phrase', 'Choice'),
					//'name' => 'editor_choice_input',
					'value' => '$data->editor_choice_input != 2 ? Utility::getPublish(Yii::app()->controller->createUrl("choice",array("id"=>$data->digital_id)), $data->editor_choice_input, Yii::t(\'phrase\', \'Choice\').\',\'.Yii::t(\'phrase\', \'Unchoice\')) : "-"',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'type' => 'raw',
				);
			}
			if($setting->headline == 1) {
				$this->defaultColumns[] = array(
					'name' => 'headline',
					'value' => 'in_array($data->cat_id, DigitalSetting::getHeadlineCategory()) ? ($data->headline == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Utility::getPublish(Yii::app()->controller->createUrl("headline",array("id"=>$data->digital_id)), $data->headline, 9)) : \'-\'',
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
	 * Digital Unique Directory
	 */
	public static function getSalt() {
		$chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		srand((double)microtime()*1000000);
		$i = 0;
		$salt = '' ;

		while ($i <= 15) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 2);
			$salt = $salt . $tmp; 
			$i++;
		}

		return $salt;
	}

	/**
	 * Digital Unique Directory
	 */
	public static function getUniqueDirectory($id, $salt, $md5path) 
	{
		return $salt.$id.$md5path;
	}

	/**
	 * Articles get information
	 */
	public static function getHeadline()
	{
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'headline_limit, headline_category',
		));
		$headline_category = unserialize($setting->headline_category);
					
		$criteria=new CDbCriteria;
		$criteria->compare('t.publish', 1);
		$criteria->compare('t.headline', 1);
		$criteria->addInCondition('t.cat_id', $headline_category);
		$criteria->order = 't.headline_date DESC';
		
		$model = self::model()->findAll($criteria);
		
		$headline = array();
		if(!empty($model)) {
			$i=0;
			foreach($model as $key => $val) {
				$i++;
				if($i <= $setting->headline_limit)
					$headline[] = $val->digital_id;
			}
		}
		
		return $headline;
	}
	
	protected function afterFind() {
		$this->editor_choice_input = DigitalChoice::getChoiceUser($this->digital_id);
		
		parent::afterFind();		
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {	
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'digital_global_file_type, cover_file_type, digital_file_type, form_standard, form_custom_field, content_verified',
		));
		$cover_file_type = unserialize($setting->cover_file_type);
		$digital_file_type = unserialize($setting->digital_file_type);
		$form_custom_field = unserialize($setting->form_custom_field);
		if(empty($form_custom_field))
			$form_custom_field = array();
		if($setting->digital_global_file_type == 0 && ($setting->form_standard == 1 || ($setting->form_standard == 0 && in_array('cat_id', $form_custom_field))))
			$digital_file_type = unserialize($this->category->cat_file_type);
		array_push($digital_file_type, 'zip');
		
		if(parent::beforeValidate()) {
			if($this->isNewRecord)
				$this->creation_id = Yii::app()->user->id;
			else
				$this->modified_id = Yii::app()->user->id;
			
			if($setting->content_verified == 1 && $this->headline == 1 && $this->content_verified == 0)
				$this->addError('content_verified', Yii::t('phrase', 'Content digital belum dalam kondisi terverifikasi.'));
			
			if($this->headline == 1 && $this->publish == 0)
				$this->addError('publish', Yii::t('phrase', 'Content digital belum dalam kondisi publish.'));
			
			$cover_input = CUploadedFile::getInstance($this, 'cover_input');
			if($cover_input != null) {
				$extension = pathinfo($cover_input->name, PATHINFO_EXTENSION);
				if(!in_array(strtolower($extension), $cover_file_type))
					$this->addError('cover_input', Yii::t('phrase', 'The file {name} cannot be uploaded. Only files with these extensions are allowed: {extensions}.', array(
						'{name}'=>$cover_input->name,
						'{extensions}'=>Utility::formatFileType($cover_file_type, false),
					)));
			}
			
			$digital_file_input = CUploadedFile::getInstance($this, 'digital_file_input');
			if($digital_file_input != null) {
				$extension = pathinfo($digital_file_input->name, PATHINFO_EXTENSION);
				if(!in_array(strtolower($extension), $digital_file_type))
					$this->addError('digital_file_input', Yii::t('phrase', 'The file {name} cannot be uploaded. Only files with these extensions are allowed: {extensions}.', array(
						'{name}'=>$digital_file_input->name,
						'{extensions}'=>Utility::formatFileType($digital_file_type, false),
					)));
					
				if(strtolower($extension) != 'zip' && $this->multiple_file_input == 1)
					$this->addError('digital_file_input', Yii::t('phrase', 'The file {name} cannot be uploaded. File bukan termasuk multiple format.', array(
						'{name}'=>$digital_file_input->name,
					)));
					
			}
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord)
				$this->salt = self::getSalt();
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
			'select' => 'digital_global_file_type, cover_limit, cover_resize, cover_resize_size, cover_file_type, digital_file_type, digital_path, form_standard, form_custom_field, headline',
		));
		$cover_resize_size = unserialize($setting->cover_resize_size);
		$digital_file_type = unserialize($setting->digital_file_type);
		$form_custom_field = unserialize($setting->form_custom_field);
		if(empty($form_custom_field))
			$form_custom_field = array();
		if($setting->digital_global_file_type == 0 && ($setting->form_standard == 1 || ($setting->form_standard == 0 && in_array('cat_id', $form_custom_field))))
			$digital_file_type = unserialize($this->category->cat_file_type);
		
		if($this->isNewRecord) {
			// Add directory
			$pathUnique = self::getUniqueDirectory($this->digital_id, $this->salt, $this->view->md5path);
			if($setting != null)
				$digital_path = $setting->digital_path.'/'.$pathUnique;
			else
				$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathUnique;
		
			if(!file_exists($digital_path)) {
				@mkdir($digital_path, 0755, true);

				// Add file in directory (index.php)
				$newFile = $digital_path.'/index.php';
				$FileHandle = fopen($newFile, 'w');
			} else
				@chmod($digital_path, 0755, true);
			
			self::model()->updateByPk($this->digital_id, array('digital_path'=>$digital_path));
			
			//input author
			if(trim($this->author_input) != '') {
				$author_input = Utility::formatFileType($this->author_input, true, '#');
				if(!empty($author_input)) {
					foreach($author_input as $key => $val) {
						$author = new DigitalAuthors;
						$author->digital_id = $this->digital_id;
						$author->author_id = 0;
						$author->author_input = $val;
						$author->save();
					}
				}
			}
			
			//input subject
			if(trim($this->subject_input) != '') {
				$subject_input = Utility::formatFileType($this->subject_input);
				if(!empty($subject_input)) {
					foreach($subject_input as $key => $val) {
						$subject = new DigitalSubjects;
						$subject->digital_id = $this->digital_id;
						$subject->tag_id = 0;
						$subject->tag_input = $val;
						$subject->save();
					}
				}
			}
			
			//input tag			
			if(trim($this->tag_input) != '')
				$tag_input = Utility::formatFileType($this->tag_input);
			else
				$tag_input = array();
			
			$category_tag = $this->category->tags;
			if(!empty($category_tag)) {
				foreach($category_tag as $key => $val) {
					$tag_input[] = $val->tag->body;
				}
			}
			if(!empty($tag_input)) {
				$tag_input = array_unique($tag_input);
				foreach($tag_input as $key => $val) {
					$tag = new DigitalTags;
					$tag->digital_id = $this->digital_id;
					$tag->tag_id = 0;
					$tag->tag_input = $val;
					$tag->save();
				}
			}
			
		} else
			$digital_path = $this->digital_path;
		
		$this->cover_input = CUploadedFile::getInstance($this, 'cover_input');
		if($this->cover_input != null && ($this->isNewRecord || (!$this->isNewRecord && $setting->cover_limit == 1))) {
			if($this->cover_input instanceOf CUploadedFile) {
				$fileName = time().'_'.$this->digital_id.'_'.Utility::getUrlTitle($this->digital_title).'.'.strtolower($this->cover_input->extensionName);
				if($this->cover_input->saveAs($digital_path.'/'.$fileName)) {
					if($this->isNewRecord || (!$this->isNewRecord && $this->covers == null)) {
						$cover = new DigitalCover;
						$cover->digital_id = $this->digital_id;
						$cover->status = 1;
						$cover->cover_filename = $fileName;
						$cover->save();
					} else {
						if($this->cover_old_input != '' && file_exists($digital_path.'/'.$this->cover_old_input))
							rename($digital_path.'/'.$this->cover_old_input, 'public/digital/verwijderen/'.$this->digital_id.'_'.$this->cover_old_input);
						$covers = $this->covers;
						if(DigitalCover::model()->updateByPk($covers[0]->cover_id, array('cover_filename'=>$fileName))) {
							if($setting->cover_resize == 1)
								DigitalCover::resizeCover($digital_path.'/'.$fileName, $cover_resize_size);
						}
					}
				}
			}
		}
		
		$this->digital_file_input = CUploadedFile::getInstance($this, 'digital_file_input');
		if($this->digital_file_input != null && ($this->isNewRecord || (!$this->isNewRecord && $action == 'upload'))) {
			if($this->digital_file_input instanceOf CUploadedFile) {
				$fileName = time().'_'.$this->digital_id.'_'.Utility::getUrlTitle($this->digital_title).'.'.strtolower($this->digital_file_input->extensionName);
				if($this->digital_file_input->saveAs($digital_path.'/'.$fileName)) {
					if($this->multiple_file_input == 0) {
						$file = new DigitalFile;
						$file->digital_id = $this->digital_id;
						$file->digital_filename = $fileName;
						$file->save();
						
					} else {
						$zip = new ZipArchive;
						$open = $zip->open($digital_path.'/'.$fileName);
						if($open === true) {
							//print_r($zip);
							for($i = 0; $i < $zip->numFiles; $i++) {
								$filename = $zip->getNameIndex($i);
								$fileinfo = pathinfo($filename);
								$extension = pathinfo($filename, PATHINFO_EXTENSION);
								if(in_array(strtolower($extension), $digital_file_type)) {
									if(copy('zip://'.$digital_path.'/'.$fileName.'#'.$filename, $digital_path.'/'.$fileinfo['basename'])) {
										$fileNameOnZip = time().'_'.$this->digital_id.'_'.$i.'_'.Utility::getUrlTitle($this->digital_title).'.'.strtolower($fileinfo['extension']);
										rename($digital_path.'/'.$fileinfo['basename'], $digital_path.'/'.$fileNameOnZip);
										
										$file = new DigitalFile;
										$file->digital_id = $this->digital_id;
										$file->digital_filename = $fileNameOnZip;
										$file->save();
									}
								}
								//echo $filename.'<br/>';
								//echo print_r($fileinfo).'<br/>';								
							}
							//exit();
						}
					}
				}
			}				
		}
		
		// Reset headline
		if($setting->headline == 1 && $this->headline == 1) {
			$headline = self::getHeadline();
			
			$criteria=new CDbCriteria;
			$criteria->addNotInCondition('digital_id', $headline);
			self::model()->updateAll(array('headline'=>0), $criteria);
		}
	}

	/**
	 * Before delete attributes
	 */
	protected function beforeDelete() {
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'digital_path',
		));
		if(parent::beforeDelete()) {
			$digital_path = $this->digital_path;
			if($this->digital_path == '') {
				$pathUnique = self::getUniqueDirectory($this->digital_id, $this->salt, $this->view->md5path);
				if($setting != null)
					$digital_path = $setting->digital_path.'/'.$pathUnique;
				else
					$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathUnique;
			}
			
			//delete digital covers
			$covers = $this->covers;
			if(!empty($covers)) {
				foreach($covers as $val) {
					if($val->cover_filename != '' && file_exists($digital_path.'/'.$val->cover_filename))
						rename($digital_path.'/'.$val->cover_filename, 'public/digital/verwijderen/'.$val->digital_id.'_'.$val->cover_filename);
				}
			}
			
			//delete digital files
			$files = $this->files;
			if(!empty($files)) {
				foreach($files as $val) {
					if($val->digital_filename != '' && file_exists($digital_path.'/'.$val->digital_filename))
						rename($digital_path.'/'.$val->digital_filename, 'public/digital/verwijderen/'.$val->digital_id.'_'.$val->digital_filename);					
				}				
			}
		}
		return true;
	}

	/**
	 * After delete attributes
	 */
	protected function afterDelete() {
		parent::afterDelete();
		
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'digital_path',
		));
		//delete digital directory
		$digital_path = $this->digital_path;
		if($this->digital_path == '') {
			$pathUnique = self::getUniqueDirectory($this->digital_id, $this->salt, $this->view->md5path);
			if($setting != null)
				$digital_path = $setting->digital_path.'/'.$pathUnique;
			else
				$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathUnique;
		}
		Utility::deleteFolder($digital_path);		
	}

}