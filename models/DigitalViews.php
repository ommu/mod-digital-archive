<?php
/**
 * DigitalViews
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (www.ommu.co)
 * @created date 7 November 2016, 06:20 WIB
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
 * This is the model class for table "ommu_digital_views".
 *
 * The followings are the available columns in table 'ommu_digital_views':
 * @property string $view_id
 * @property integer $publish
 * @property string $digital_id
 * @property string $user_id
 * @property integer $views
 * @property string $view_date
 * @property string $view_ip
 * @property string $deleted_date
 *
 * The followings are the available model relations:
 * @property Digitals $digital
 */
class DigitalViews extends CActiveRecord
{
	use GridViewTrait;

	public $defaultColumns = array();
	
	// Variable Search
	public $digital_search;
	public $user_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DigitalViews the static model class
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
		return 'ommu_digital_views';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('publish, digital_id, user_id', 'required'),
			array('publish, views', 'numerical', 'integerOnly'=>true),
			array('digital_id, user_id, views', 'length', 'max'=>11),
			array('view_ip', 'length', 'max'=>20),
			array('', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('view_id, publish, digital_id, user_id, views, view_date, view_ip, deleted_date,
				digital_search, user_search', 'safe', 'on'=>'search'),
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
			'digital' => array(self::BELONGS_TO, 'Digitals', 'digital_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'view_id' => Yii::t('attribute', 'View'),
			'publish' => Yii::t('attribute', 'Publish'),
			'digital_id' => Yii::t('attribute', 'Digital'),
			'user_id' => Yii::t('attribute', 'User'),
			'views' => Yii::t('attribute', 'Views'),
			'view_date' => Yii::t('attribute', 'View Date'),
			'view_ip' => Yii::t('attribute', 'View Ip'),
			'deleted_date' => Yii::t('attribute', 'Deleted Date'),
			'digital_search' => Yii::t('attribute', 'Digital'),
			'user_search' => Yii::t('attribute', 'User'),
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
			'digital' => array(
				'alias' => 'digital',
				'select' => 'publish, digital_title',
			),
			'user' => array(
				'alias' => 'user',
				'select' => 'displayname',
			),
		);

		$criteria->compare('t.view_id', strtolower($this->view_id), true);
		if(Yii::app()->getRequest()->getParam('type') == 'publish')
			$criteria->compare('t.publish', 1);
		elseif(Yii::app()->getRequest()->getParam('type') == 'unpublish')
			$criteria->compare('t.publish', 0);
		elseif(Yii::app()->getRequest()->getParam('type') == 'trash')
			$criteria->compare('t.publish', 2);
		else {
			$criteria->addInCondition('t.publish', array(0,1));
			$criteria->compare('t.publish', $this->publish);
		}
		if(Yii::app()->getRequest()->getParam('digital'))
			$criteria->compare('t.digital_id', Yii::app()->getRequest()->getParam('digital'));
		else
			$criteria->compare('t.digital_id', $this->digital_id);
		if(Yii::app()->getRequest()->getParam('user'))
			$criteria->compare('t.user_id', Yii::app()->getRequest()->getParam('user'));
		else
			$criteria->compare('t.user_id', $this->user_id);
		$criteria->compare('t.views', $this->views);
		if($this->view_date != null && !in_array($this->view_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')))
			$criteria->compare('date(t.view_date)', date('Y-m-d', strtotime($this->view_date)));
		$criteria->compare('t.view_ip', strtolower($this->view_ip), true);
		if($this->deleted_date != null && !in_array($this->deleted_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')))
			$criteria->compare('date(t.deleted_date)', date('Y-m-d', strtotime($this->deleted_date)));
		
		$criteria->compare('digital.digital_title', strtolower($this->digital_search), true);
		if(Yii::app()->getRequest()->getParam('digital') && Yii::app()->getRequest()->getParam('publish'))
			$criteria->compare('digital.publish', Yii::app()->getRequest()->getParam('publish'));
		$criteria->compare('user.displayname', strtolower($this->user_search), true);

		if(!Yii::app()->getRequest()->getParam('DigitalViews_sort'))
			$criteria->order = 't.view_id DESC';

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
			//$this->defaultColumns[] = 'view_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'digital_id';
			$this->defaultColumns[] = 'user_id';
			$this->defaultColumns[] = 'views';
			$this->defaultColumns[] = 'view_date';
			$this->defaultColumns[] = 'view_ip';
			$this->defaultColumns[] = 'deleted_date';
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
			if(!Yii::app()->getRequest()->getParam('digital')) {
				$this->defaultColumns[] = array(
					'name' => 'digital_search',
					'value' => '$data->digital->digital_title',
				);
			}
			if(!Yii::app()->getRequest()->getParam('user')) {
				$this->defaultColumns[] = array(
					'name' => 'user_search',
					'value' => '$data->user_id != 0 ? $data->user->displayname : \'-\'',
				);
			}
			$this->defaultColumns[] = array(
				'name' => 'views',
				'value' => 'CHtml::link($data->views != null ? $data->views : "0", Yii::app()->controller->createUrl("o/viewdetail/manage", array(\'view\'=>$data->view_id)))',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'view_date',
				'value' => 'Yii::app()->dateFormatter->formatDateTime($data->view_date, \'medium\', false)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => $this->filterDatepicker($this, 'view_date'),
			);
			$this->defaultColumns[] = array(
				'name' => 'view_ip',
				'value' => '$data->view_ip',
				'htmlOptions' => array(
					'class' => 'center',
				),
			);
			$this->defaultColumns[] = array(
				'name' => 'deleted_date',
				'value' => 'Yii::app()->dateFormatter->formatDateTime($data->deleted_date, \'medium\', false)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => $this->filterDatepicker($this, 'deleted_date'),
			);
			if(!Yii::app()->getRequest()->getParam('type')) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl(\'publish\', array(\'id\'=>$data->view_id)), $data->publish, 1)',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'filter' => $this->filterYesNo(),
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

	/**
	 * User get information
	 */
	public static function insertView($digital_id)
	{
		$criteria=new CDbCriteria;
		$criteria->select = 'view_id, publish, digital_id, user_id, views';
		$criteria->compare('publish', 1);
		$criteria->compare('digital_id', $digital_id);
		$criteria->compare('user_id', !Yii::app()->user->isGuest ? Yii::app()->user->id : '0');
		$findView = self::model()->find($criteria);
		
		if($findView != null)
			self::model()->updateByPk($findView->view_id, array('views'=>$findView->views + 1));
		
		else {
			$view=new DigitalViews;
			$view->digital_id = $digital_id;
			$view->save();
		}
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			if($this->isNewRecord)
				$this->user_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : null;
			
			$this->view_ip = $_SERVER['REMOTE_ADDR'];
		}
		return true;
	}
}