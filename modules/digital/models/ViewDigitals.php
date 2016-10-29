<?php
/**
 * ViewDigitals
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 28 October 2016, 19:45 WIB
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
 * This is the model class for table "_view_digitals".
 *
 * The followings are the available columns in table '_view_digitals':
 * @property string $digital_id
 * @property string $md5path
 * @property string $uniquepath
 * @property string $covers
 * @property string $files
 * @property string $authors
 * @property string $tags
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
			array('md5path, uniquepath, covers, files, authors, tags', 'length', 'max'=>21),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('digital_id, md5path, uniquepath, covers, files, authors, tags', 'safe', 'on'=>'search'),
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
			'covers' => Yii::t('attribute', 'Covers'),
			'files' => Yii::t('attribute', 'Files'),
			'authors' => Yii::t('attribute', 'Authors'),
			'tags' => Yii::t('attribute', 'Tags'),
		);
		/*
			'Digital' => 'Digital',
			'Covers' => 'Covers',
			'Files' => 'Files',
			'Authors' => 'Authors',
			'Tags' => 'Tags',
		
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
		$criteria->compare('t.md5path',strtolower($this->md5path),true);
		$criteria->compare('t.uniquepath',strtolower($this->uniquepath),true);
		$criteria->compare('t.covers',strtolower($this->covers),true);
		$criteria->compare('t.files',strtolower($this->files),true);
		$criteria->compare('t.authors',strtolower($this->authors),true);
		$criteria->compare('t.tags',strtolower($this->tags),true);

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
			$this->defaultColumns[] = 'covers';
			$this->defaultColumns[] = 'files';
			$this->defaultColumns[] = 'authors';
			$this->defaultColumns[] = 'tags';
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
			$this->defaultColumns[] = 'covers';
			$this->defaultColumns[] = 'files';
			$this->defaultColumns[] = 'authors';
			$this->defaultColumns[] = 'tags';
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