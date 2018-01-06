<?php
/**
 * ViewDigitals
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 28 October 2016, 19:45 WIB
 * @link https://github.com/ommu/ommu-digital-archive
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
 * This is the model class for table "_view_digitals".
 *
 * The followings are the available columns in table '_view_digitals':
 * @property string $digital_id
 * @property string $md5path
 * @property string $uniquepath
 * @property string $cover_id
 * @property string $md5coverpath
 * @property string $cover_filename
 * @property string $cover_caption
 * @property string $covers
 * @property string $cover_all
 * @property string $files
 * @property string $file_all
 * @property string $authors
 * @property string $subjects
 * @property string $tags
 * @property string $likes
 * @property string $like_all
 * @property string $views
 * @property string $view_all
 * @property string $choices
 * @property string $downloads
 * @property string $download_backend
 * @property string $download_all
 */
class ViewDigitals extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewDigitals the static model class
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
		return '_view_digitals';
	}

	/**
	 * @return string the primarykey column
	 */
	public function primaryKey()
	{
		return 'digital_id';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('digital_id', 'length', 'max'=>11),
			array('md5path, uniquepath, cover_id, md5coverpath, cover_filename, cover_caption, covers, cover_all, files, file_all, authors, subjects, tags, likes, like_all, views, view_all, choices, downloads, download_backend, download_all', 'length', 'max'=>21),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('digital_id, md5path, uniquepath, cover_id, md5coverpath, cover_filename, cover_caption, covers, cover_all, files, file_all, authors, subjects, tags, likes, like_all, views, view_all, choices, downloads, download_backend, download_all', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'digital_id' => Yii::t('attribute', 'Digital'),
			'md5path' => Yii::t('attribute', 'MD5 Path'),
			'uniquepath' => Yii::t('attribute', 'Unique Path'),
			'cover_id' => Yii::t('attribute', 'Cover'),
			'md5coverpath' => Yii::t('attribute', 'Cover Path'),
			'cover_filename' => Yii::t('attribute', 'Cover Filename'),
			'cover_caption' => Yii::t('attribute', 'Cover Caption'),
			'covers' => Yii::t('attribute', 'Covers'),
			'cover_all' => Yii::t('attribute', 'Cover All'),
			'files' => Yii::t('attribute', 'Files'),
			'file_all' => Yii::t('attribute', 'File All'),
			'authors' => Yii::t('attribute', 'Authors'),
			'subjects' => Yii::t('attribute', 'Subjects'),
			'tags' => Yii::t('attribute', 'Tags'),
			'likes' => Yii::t('attribute', 'Likes'),
			'like_all' => Yii::t('attribute', 'Like All'),
			'views' => Yii::t('attribute', 'Views'),
			'view_all' => Yii::t('attribute', 'View All'),
			'choices' => Yii::t('attribute', 'Choices'),
			'downloads' => Yii::t('attribute', 'Downloads'),
			'download_backend' => Yii::t('attribute', 'Download Backend'),
			'download_all' => Yii::t('attribute', 'Download All'),
		);
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
		$criteria->compare('t.md5path',strtolower($this->md5path),true);
		$criteria->compare('t.uniquepath',strtolower($this->uniquepath),true);
		$criteria->compare('t.cover_id',strtolower($this->cover_id),true);
		$criteria->compare('t.md5coverpath',strtolower($this->md5coverpath),true);
		$criteria->compare('t.cover_filename',strtolower($this->cover_filename),true);
		$criteria->compare('t.cover_caption',strtolower($this->cover_caption),true);
		$criteria->compare('t.covers',strtolower($this->covers),true);
		$criteria->compare('t.cover_all',strtolower($this->cover_all),true);
		$criteria->compare('t.files',strtolower($this->files),true);
		$criteria->compare('t.file_all',strtolower($this->file_all),true);
		$criteria->compare('t.authors',strtolower($this->authors),true);
		$criteria->compare('t.subjects',strtolower($this->subjects),true);
		$criteria->compare('t.tags',strtolower($this->tags),true);
		$criteria->compare('t.likes',strtolower($this->likes),true);
		$criteria->compare('t.like_all',strtolower($this->like_all),true);
		$criteria->compare('t.views',strtolower($this->views),true);
		$criteria->compare('t.view_all',strtolower($this->view_all),true);
		$criteria->compare('t.choices',strtolower($this->choices),true);
		$criteria->compare('t.downloads',strtolower($this->downloads),true);
		$criteria->compare('t.download_backend',strtolower($this->download_backend),true);
		$criteria->compare('t.download_all',strtolower($this->download_all),true);

		if(!isset($_GET['ViewDigitals_sort']))
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
			$this->defaultColumns[] = 'digital_id';
			$this->defaultColumns[] = 'md5path';
			$this->defaultColumns[] = 'uniquepath';
			$this->defaultColumns[] = 'cover_id';
			$this->defaultColumns[] = 'md5coverpath';
			$this->defaultColumns[] = 'cover_filename';
			$this->defaultColumns[] = 'cover_caption';
			$this->defaultColumns[] = 'covers';
			$this->defaultColumns[] = 'cover_all';
			$this->defaultColumns[] = 'files';
			$this->defaultColumns[] = 'file_all';
			$this->defaultColumns[] = 'authors';
			$this->defaultColumns[] = 'subjects';
			$this->defaultColumns[] = 'tags';
			$this->defaultColumns[] = 'likes';
			$this->defaultColumns[] = 'like_all';
			$this->defaultColumns[] = 'views';
			$this->defaultColumns[] = 'view_all';
			$this->defaultColumns[] = 'choices';
			$this->defaultColumns[] = 'downloads';
			$this->defaultColumns[] = 'download_backend';
			$this->defaultColumns[] = 'download_all';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			//$this->defaultColumns[] = 'digital_id';
			$this->defaultColumns[] = 'md5path';
			$this->defaultColumns[] = 'uniquepath';
			$this->defaultColumns[] = 'cover_id';
			$this->defaultColumns[] = 'md5coverpath';
			$this->defaultColumns[] = 'cover_filename';
			$this->defaultColumns[] = 'cover_caption';
			$this->defaultColumns[] = 'covers';
			$this->defaultColumns[] = 'cover_all';
			$this->defaultColumns[] = 'files';
			$this->defaultColumns[] = 'file_all';
			$this->defaultColumns[] = 'authors';
			$this->defaultColumns[] = 'subjects';
			$this->defaultColumns[] = 'tags';
			$this->defaultColumns[] = 'likes';
			$this->defaultColumns[] = 'like_all';
			$this->defaultColumns[] = 'views';
			$this->defaultColumns[] = 'view_all';
			$this->defaultColumns[] = 'choices';
			$this->defaultColumns[] = 'downloads';
			$this->defaultColumns[] = 'download_backend';
			$this->defaultColumns[] = 'download_all';
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

}