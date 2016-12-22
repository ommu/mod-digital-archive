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
 * @property string $pages
 * @property string $series
 * @property string $salt
 * @property string $content_verified
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
			array('publish, digital_title, digital_intro, content_verified', 'required'),
			array('cat_id, language_id', 'required', 'on'=>'standardForm'),
			array('publish, cat_id, language_id, opac_id, content_verified', 'numerical', 'integerOnly'=>true),
			array('publisher_id, creation_id, modified_id', 'length', 'max'=>11),
			array('digital_code', 'length', 'max'=>16),
			array('publish_year', 'length', 'max'=>4),
			array('isbn, salt', 'length', 'max'=>32),
			array('pages', 'length', 'max'=>5),
			array('publisher_id, opac_id, digital_code, digital_path, publish_year, publish_location, isbn, pages, series, salt,
				digital_file_input, multiple_file_input, author_input, subject_input, tag_input', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('digital_id, publish, cat_id, publisher_id, language_id, opac_id, digital_code, digital_title, digital_intro, digital_path, publish_year, publish_location, isbn, pages, series, salt, content_verified, creation_date, creation_id, modified_date, modified_id,
				editor_choice_input, 
				publisher_search, cover_search, file_search, like_search, view_search, creation_search, modified_search', 'safe', 'on'=>'search'),
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
			'covers' => array(self::HAS_MANY, 'DigitalCover', 'digital_id'),
			'files' => array(self::HAS_MANY, 'DigitalFile', 'digital_id'),
			'authors' => array(self::HAS_MANY, 'DigitalAuthors', 'digital_id'),
			'tags' => array(self::HAS_MANY, 'DigitalTags', 'digital_id'),
			'history_prints' => array(self::HAS_MANY, 'DigitalHistoryPrint', 'digital_id'),
			'subjects' => array(self::HAS_MANY, 'DigitalSubjects', 'digital_id'),
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
			'isbn' => Yii::t('attribute', 'ISBN/ISSN/ISMN'),
			'pages' => Yii::t('attribute', 'Pages'),
			'series' => Yii::t('attribute', 'Series'),
			'salt' => Yii::t('attribute', 'Salt'),
			'content_verified' => Yii::t('attribute', 'Verified'),
			'digital_file_input' => Yii::t('attribute', 'Digital File'),
			'multiple_file_input' => Yii::t('attribute', 'Multiple File'),
			'author_input' => Yii::t('attribute', 'Authors'),
			'subject_input' => Yii::t('attribute', 'Subjects'),
			'tag_input' => Yii::t('attribute', 'Tags'),
			'editor_choice_input' => Yii::t('attribute', 'Editor Choice'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'publisher_search' => Yii::t('attribute', 'Publisher'),
			'cover_search' => Yii::t('attribute', 'Covers'),
			'file_search' => Yii::t('attribute', 'Files'),
			'like_search' => Yii::t('attribute', 'Likes'),
			'view_search' => Yii::t('attribute', 'Views'),
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
				'select'=>'covers, files, likes, views',
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
		$criteria->compare('t.editor_choice_input',$this->editor_choice_input);
		
		$criteria->compare('publisher.publisher_name',strtolower($this->publisher_search), true);
		$criteria->compare('view.covers',$this->cover_search);
		$criteria->compare('view.files',$this->file_search);
		$criteria->compare('view.likes',$this->like_search);
		$criteria->compare('view.views',$this->view_search);
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
			$this->defaultColumns[] = 'pages';
			$this->defaultColumns[] = 'series';
			$this->defaultColumns[] = 'salt';
			$this->defaultColumns[] = 'content_verified';
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
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'form_standard, form_custom_field, editor_choice_status, editor_choice_userlevel, content_verified',
		));
		$form_custom_field = unserialize($setting->form_custom_field);
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
					'value' => '$data->view->covers',
					'htmlOptions' => array(
						'class' => 'center',
					),
				);
			}
			$this->defaultColumns[] = array(
				'name' => 'file_search',
				'value' => '$data->view->files',
				'htmlOptions' => array(
					'class' => 'center',
				),
			);
			if($setting->form_standard == 0) {
				$this->defaultColumns[] = array(
					'name' => 'like_search',
					'value' => '$data->view->likes',
					'htmlOptions' => array(
						'class' => 'center',
					),
				);
			}
			if($setting->form_standard == 0) {
				$this->defaultColumns[] = array(
					'name' => 'view_search',
					'value' => '$data->view->views != null ? $data->view->views : "0"',
					'htmlOptions' => array(
						'class' => 'center',
					),
				);		
			}
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
	
	protected function afterFind() {
		$this->editor_choice_input = DigitalChoice::getChoiceUser($this->digital_id);
		
		parent::afterFind();		
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		$controller = strtolower(Yii::app()->controller->id);			
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'cover_file_type, digital_file_type',
		));
		$cover_file_type = unserialize($setting->cover_file_type);
		$digital_file_type = unserialize($setting->digital_file_type);
		
		if(parent::beforeValidate()) {
			if($this->isNewRecord)
				$this->creation_id = Yii::app()->user->id;
			else
				$this->modified_id = Yii::app()->user->id;
			
			$digital_file_input = CUploadedFile::getInstance($this, 'digital_file_input');
			if($digital_file_input->name != '') {
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
			'select' => 'cover_limit, cover_resize, cover_resize_size, digital_path, cover_file_type, digital_file_type',
		));
		$digital_file_type = unserialize($setting->digital_file_type);
		
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
			if(trim($this->tag_input) != '') {
				$tag_input = Utility::formatFileType($this->tag_input);
				if(!empty($tag_input)) {
					foreach($tag_input as $key => $val) {
						$tag = new DigitalTags;
						$tag->digital_id = $this->digital_id;
						$tag->tag_id = 0;
						$tag->tag_input = $val;
						$tag->save();
					}
				}
			}
			
		} else
			$digital_path = $this->digital_path;
		
		if($this->isNewRecord || (!$this->isNewRecord && $action == 'upload')) {
			$this->digital_file_input = CUploadedFile::getInstance($this, 'digital_file_input');
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
	}

	/**
	 * Before delete attributes
	 */
	protected function beforeDelete() {
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'digital_path',
		));
		if(parent::beforeDelete()) {			
			$pathUnique = self::getUniqueDirectory($this->digital_id, $this->salt, $this->view->md5path);
			if($setting != null)
				$digital_path = $setting->digital_path.'/'.$pathUnique;
			else
				$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathUnique;
			
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
		$pathUnique = self::getUniqueDirectory($this->digital_id, $this->salt, $this->view->md5path);
		if($setting != null)
			$digital_path = $setting->digital_path.'/'.$pathUnique;
		else
			$digital_path = YiiBase::getPathOfAlias('webroot.public.digital').'/'.$pathUnique;
		Utility::deleteFolder($digital_path);		
	}

}