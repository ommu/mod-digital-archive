<?php
/**
 * ViewDigitalFile
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 2 February 2017, 12:05 WIB
 * @link https://github.com/ommu/mod-digital-archive
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
 * This is the model class for table "_view_digital_file".
 *
 * The followings are the available columns in table '_view_digital_file':
 * @property string $file_id
 * @property string $digital_id
 * @property string $downloads
 * @property string $download_backend
 * @property string $download_all
 */
class ViewDigitalFile extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewDigitalFile the static model class
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
		return '_view_digital_file';
	}

	/**
	 * @return string the primarykey column
	 */
	public function primaryKey()
	{
		return 'file_id';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_id, digital_id', 'length', 'max'=>11),
			array('downloads, download_backend, download_all', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('file_id, digital_id, downloads, download_backend, download_all', 'safe', 'on'=>'search'),
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
			'file_id' => Yii::t('attribute', 'File'),
			'digital_id' => Yii::t('attribute', 'Digital'),
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

		$criteria->compare('t.file_id',strtolower($this->file_id),true);
		$criteria->compare('t.digital_id',strtolower($this->digital_id),true);
		$criteria->compare('t.downloads',strtolower($this->downloads),true);
		$criteria->compare('t.download_backend',strtolower($this->download_backend),true);
		$criteria->compare('t.download_all',strtolower($this->download_all),true);

		if(!isset($_GET['ViewDigitalFile_sort']))
			$criteria->order = 't.file_id DESC';

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
			$this->defaultColumns[] = 'file_id';
			$this->defaultColumns[] = 'digital_id';
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
			$this->defaultColumns[] = 'file_id';
			$this->defaultColumns[] = 'digital_id';
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