<?php
/**
 * DigitalSetting
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 20 October 2016, 10:10 WIB
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
 * This is the model class for table "ommu_digital_setting".
 *
 * The followings are the available columns in table 'ommu_digital_setting':
 * @property integer $id
 * @property string $license
 * @property integer $permission
 * @property string $meta_keyword
 * @property string $meta_description
 * @property integer $cover_limit
 * @property integer $cover_resize
 * @property string $cover_resize_size
 * @property string $cover_view_size
 * @property string $cover_file_type
 * @property string $digital_file_type
 * @property string $digital_path
 * @property string $digital_sync_path
 * @property integer $form_standard
 * @property string $form_custom_field
 * @property integer $editor_choice_status
 * @property string $editor_choice_userlevel
 * @property integer $editor_choice_limit
 * @property integer $content_verified
 * @property string $modified_date
 * @property string $modified_id
 */
class DigitalSetting extends CActiveRecord
{
	public $defaultColumns = array();
	public $cover_unlimit_input;
	
	// Variable Search
	public $modified_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DigitalSetting the static model class
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
		return 'ommu_digital_setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('license, permission, meta_keyword, meta_description, cover_limit, cover_resize, cover_file_type, digital_path, digital_sync_path, form_standard, editor_choice_status, content_verified,
				cover_unlimit_input', 'required'),
			array('permission, cover_limit, cover_resize, form_standard, editor_choice_status, editor_choice_limit, content_verified,
				cover_unlimit_input', 'numerical', 'integerOnly'=>true),
			array('license', 'length', 'max'=>32),
			array('modified_id', 'length', 'max'=>11),
			array('cover_limit, editor_choice_limit', 'length', 'max'=>2),
			array('cover_resize_size, cover_view_size, digital_file_type, form_custom_field, editor_choice_userlevel', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, license, permission, meta_keyword, meta_description, cover_limit, cover_resize, cover_resize_size, cover_view_size, cover_file_type, digital_file_type, digital_path, digital_sync_path, form_standard, form_custom_field, editor_choice_status, editor_choice_userlevel, editor_choice_limit, content_verified, modified_date, modified_id,
				modified_search', 'safe', 'on'=>'search'),
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
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('attribute', 'ID'),
			'license' => Yii::t('attribute', 'License'),
			'permission' => Yii::t('attribute', 'Permission'),
			'meta_keyword' => Yii::t('attribute', 'Meta Keyword'),
			'meta_description' => Yii::t('attribute', 'Meta Description'),
			'cover_limit' => Yii::t('attribute', 'Cover Limit'),
			'cover_resize' => Yii::t('attribute', 'Cover Resize'),
			'cover_resize_size' => Yii::t('attribute', 'Cover Resize Size'),
			'cover_view_size' => Yii::t('attribute', 'Cover View Size'),
			'cover_file_type' => Yii::t('attribute', 'Cover File Type'),
			'digital_file_type' => Yii::t('attribute', 'Digital File Type'),
			'digital_path' => Yii::t('attribute', 'Digital Directory'),
			'digital_sync_path' => Yii::t('attribute', 'Digital Sync Directory'),
			'form_standard' => Yii::t('attribute', 'Form Field'),
			'form_custom_field' => Yii::t('attribute', 'Custom Field Form'),
			'editor_choice_status' => Yii::t('attribute', 'Editor Choice'),
			'editor_choice_userlevel' => Yii::t('attribute', 'Editor Choice User Level'),
			'editor_choice_limit' => Yii::t('attribute', 'Editor Choice Limit'),
			'content_verified' => Yii::t('attribute', 'Verified Content'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'modified_search' => Yii::t('attribute', 'Modified'),
			'cover_unlimit_input' => Yii::t('attribute', 'Unlimited Cover'),
		);
		/*
			'ID' => 'ID',
			'License' => 'License',
			'Permission' => 'Permission',
			'Meta Keyword' => 'Meta Keyword',
			'Meta Description' => 'Meta Description',
			'Cover Limit' => 'Cover Limit',
			'Cover Resize' => 'Cover Resize',
			'Cover Resize Size' => 'Cover Resize Size',
			'Cover View Size' => 'Cover View Size',
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
			'modified' => array(
				'alias'=>'modified',
				'select'=>'displayname'
			),
		);

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.license',strtolower($this->license),true);
		$criteria->compare('t.permission',$this->permission);
		$criteria->compare('t.meta_keyword',strtolower($this->meta_keyword),true);
		$criteria->compare('t.meta_description',strtolower($this->meta_description),true);
		$criteria->compare('t.cover_limit',$this->cover_limit);
		$criteria->compare('t.cover_resize',$this->cover_resize);
		$criteria->compare('t.cover_resize_size',strtolower($this->cover_resize_size),true);
		$criteria->compare('t.cover_view_size',strtolower($this->cover_view_size),true);
		$criteria->compare('t.cover_file_type',strtolower($this->cover_file_type),true);
		$criteria->compare('t.digital_file_type',strtolower($this->digital_file_type),true);
		$criteria->compare('t.digital_path',strtolower($this->digital_path),true);
		$criteria->compare('t.digital_sync_path',strtolower($this->digital_sync_path),true);
		$criteria->compare('t.form_standard',$this->form_standard);
		$criteria->compare('t.form_custom_field',strtolower($this->form_custom_field),true);
		$criteria->compare('t.editor_choice_status',$this->editor_choice_status);
		$criteria->compare('t.editor_choice_userlevel',strtolower($this->editor_choice_userlevel),true);
		$criteria->compare('t.editor_choice_limit',$this->editor_choice_limit);
		$criteria->compare('t.content_verified',$this->content_verified);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		if(isset($_GET['modified']))
			$criteria->compare('t.modified_id',$_GET['modified']);
		else
			$criteria->compare('t.modified_id',$this->modified_id);
		
		$criteria->compare('modified.displayname',strtolower($this->modified_search), true);

		if(!isset($_GET['DigitalSetting_sort']))
			$criteria->order = 't.id DESC';

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
			//$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'license';
			$this->defaultColumns[] = 'permission';
			$this->defaultColumns[] = 'meta_keyword';
			$this->defaultColumns[] = 'meta_description';
			$this->defaultColumns[] = 'cover_limit';
			$this->defaultColumns[] = 'cover_resize';
			$this->defaultColumns[] = 'cover_resize_size';
			$this->defaultColumns[] = 'cover_view_size';
			$this->defaultColumns[] = 'cover_file_type';
			$this->defaultColumns[] = 'digital_file_type';
			$this->defaultColumns[] = 'digital_path';
			$this->defaultColumns[] = 'digital_sync_path';
			$this->defaultColumns[] = 'form_standard';
			$this->defaultColumns[] = 'form_custom_field';
			$this->defaultColumns[] = 'editor_choice_status';
			$this->defaultColumns[] = 'editor_choice_userlevel';
			$this->defaultColumns[] = 'editor_choice_limit';
			$this->defaultColumns[] = 'content_verified';
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
			$this->defaultColumns[] = 'license';
			$this->defaultColumns[] = 'permission';
			$this->defaultColumns[] = 'meta_keyword';
			$this->defaultColumns[] = 'meta_description';
			$this->defaultColumns[] = 'cover_limit';
			$this->defaultColumns[] = 'cover_resize';
			$this->defaultColumns[] = 'cover_resize_size';
			$this->defaultColumns[] = 'cover_view_size';
			$this->defaultColumns[] = 'cover_file_type';
			$this->defaultColumns[] = 'digital_file_type';
			$this->defaultColumns[] = 'digital_path';
			$this->defaultColumns[] = 'digital_sync_path';
			$this->defaultColumns[] = 'form_standard';
			$this->defaultColumns[] = 'form_custom_field';
			$this->defaultColumns[] = 'editor_choice_status';
			$this->defaultColumns[] = 'editor_choice_userlevel';
			$this->defaultColumns[] = 'editor_choice_limit';
			$this->defaultColumns[] = 'content_verified';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = array(
				'name' => 'modified_search',
				'value' => '$data->modified->displayname',
			);
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
	 * get Module License
	 */
	public static function getLicense($source='1234567890', $length=16, $char=4)
	{
		$mod = $length%$char;
		if($mod == 0)
			$sep = ($length/$char);
		else
			$sep = (int)($length/$char)+1;
		
		$sourceLength = strlen($source);
		$random = '';
		for ($i = 0; $i < $length; $i++)
			$random .= $source[rand(0, $sourceLength - 1)];
		
		$license = '';
		for ($i = 0; $i < $sep; $i++) {
			if($i != $sep-1)
				$license .= substr($random,($i*$char),$char).'-';
			else
				$license .= substr($random,($i*$char),$char);
		}

		return $license;
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			if($this->cover_unlimit_input == 1)
				$this->cover_limit = 0;
			
			if($this->cover_unlimit_input == 0 && $this->cover_limit != '' && $this->cover_limit <= 0)
				$this->addError('cover_limit', Yii::t('phrase', 'Photo Limit lebih besar dari 0'));
			
			if($this->cover_resize == 1 && ($this->cover_resize_size['width'] == '' || $this->cover_resize_size['height'] == ''))
				$this->addError('cover_resize_size', Yii::t('phrase', 'Media Resize cannot be blank.'));
			
			if($this->cover_view_size['large']['width'] == '' || $this->cover_view_size['large']['height'] == '')
				$this->addError('cover_view_size[large]', Yii::t('phrase', 'Large Size cannot be blank.'));
			
			if($this->cover_view_size['medium']['width'] == '' || $this->cover_view_size['medium']['height'] == '')
				$this->addError('cover_view_size[medium]', Yii::t('phrase', 'Medium Size cannot be blank.'));
			
			if($this->cover_view_size['small']['width'] == '' || $this->cover_view_size['small']['height'] == '')
				$this->addError('cover_view_size[small]', Yii::t('phrase', 'Small Size cannot be blank.'));
			
			$this->modified_id = Yii::app()->user->id;
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			$this->cover_resize_size = serialize($this->cover_resize_size);
			$this->cover_view_size = serialize($this->cover_view_size);
			$this->cover_file_type = serialize(Utility::formatFileType($this->cover_file_type));
			if($this->digital_global_file_type == 1)
				$this->digital_file_type = serialize(Utility::formatFileType($this->digital_file_type));
			$this->form_custom_field = serialize($this->form_custom_field);
			$this->editor_choice_userlevel = serialize($this->editor_choice_userlevel);
		}
		return true;
	}

}