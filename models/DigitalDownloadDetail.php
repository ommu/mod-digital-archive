<?php
/**
 * DigitalDownloadDetail
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 8 January 2017, 23:04 WIB
 * @link https://github.com/ommu/mod-digital-archive
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
 * This is the model class for table "ommu_digital_download_detail".
 *
 * The followings are the available columns in table 'ommu_digital_download_detail':
 * @property string $id
 * @property string $download_id
 * @property string $download_date
 * @property string $download_ip
 *
 * The followings are the available model relations:
 * @property DigitalDownloads $download
 */
class DigitalDownloadDetail extends CActiveRecord
{
	use GridViewTrait;

	public $defaultColumns = array();
	
	// Variable Search
	public $file_search;
	public $digital_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DigitalDownloadDetail the static model class
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
		return 'ommu_digital_download_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('download_id, download_ip', 'required'),
			array('download_id', 'length', 'max'=>11),
			array('download_ip', 'length', 'max'=>20),
			array('download_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, download_id, download_date, download_ip,
				file_search, digital_search', 'safe', 'on'=>'search'),
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
			'download' => array(self::BELONGS_TO, 'DigitalDownloads', 'download_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('attribute', 'ID'),
			'download_id' => Yii::t('attribute', 'Download'),
			'download_date' => Yii::t('attribute', 'Download Date'),
			'download_ip' => Yii::t('attribute', 'Download Ip'),
			'file_search' => Yii::t('attribute', 'File'),
			'digital_search' => Yii::t('attribute', 'Digital'),
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
		
		// Custom Search
		$criteria->with = array(
			'download' => array(
				'alias'=>'download',
			),
			'download.file' => array(
				'alias'=>'file',
				'select'=>'digital_id, digital_filename'
			),
			'download.file.digital' => array(
				'alias'=>'digital',
				'select'=>'digital_title'
			),
		);

		$criteria->compare('t.id', strtolower($this->id), true);
		if(Yii::app()->getRequest()->getParam('download'))
			$criteria->compare('t.download_id', Yii::app()->getRequest()->getParam('download'));
		else
			$criteria->compare('t.download_id', $this->download_id);
		if($this->download_date != null && !in_array($this->download_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')))
			$criteria->compare('date(t.download_date)', date('Y-m-d', strtotime($this->download_date)));
		$criteria->compare('t.download_ip', strtolower($this->download_ip), true);

		$criteria->compare('file.digital_filename', strtolower($this->file_search), true);
		$criteria->compare('digital.digital_title', strtolower($this->digital_search), true);

		if(!Yii::app()->getRequest()->getParam('DigitalDownloadDetail_sort'))
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
			$this->defaultColumns[] = 'download_id';
			$this->defaultColumns[] = 'download_date';
			$this->defaultColumns[] = 'download_ip';
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
			if(!Yii::app()->getRequest()->getParam('download')) {
				$this->defaultColumns[] = array(
					'name' => 'file_search',
					'value' => '$data->download->file->digital_filename',
				);
				$this->defaultColumns[] = array(
					'name' => 'digital_search',
					'value' => '$data->download->file->digital->digital_title',
				);
			}
			$this->defaultColumns[] = array(
				'name' => 'download_date',
				'value' => 'Yii::app()->dateFormatter->formatDateTime($data->download_date, \'medium\', false)',
				'htmlOptions' => array(
					//'class' => 'center',
				),
				'filter' => $this->filterDatepicker($this, 'download_date'),
			);
			$this->defaultColumns[] = array(
				'name' => 'download_ip',
				'value' => '$data->download_ip',
				'htmlOptions' => array(
					//'class' => 'center',
				),
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
			$model = self::model()->findByPk($id, array(
				'select' => $column,
			));
 			if(count(explode(',', $column)) == 1)
 				return $model->$column;
 			else
 				return $model;
			
		} else {
			$model = self::model()->findByPk($id);
			return $model;
		}
	}

}