<?php
/**
 * DigitalChoice
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2016 Ommu Platform (opensource.ommu.co)
 * @created date 22 December 2016, 10:28 WIB
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
 * This is the model class for table "ommu_digital_choice".
 *
 * The followings are the available columns in table 'ommu_digital_choice':
 * @property string $choice_id
 * @property string $digital_id
 * @property string $user_id
 * @property string $choice_date
 * @property string $choice_ip
 *
 * The followings are the available model relations:
 * @property Digitals $digital
 */
class DigitalChoice extends CActiveRecord
{
	public $defaultColumns = array();
	
	// Variable Search
	public $digital_search;
	public $user_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DigitalChoice the static model class
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
		return 'ommu_digital_choice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('digital_id, user_id', 'required'),
			array('digital_id, user_id', 'length', 'max'=>11),
			array('choice_ip', 'length', 'max'=>20),
			array('', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('choice_id, digital_id, user_id, choice_date, choice_ip,
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
			'choice_id' => Yii::t('attribute', 'Choice'),
			'digital_id' => Yii::t('attribute', 'Digital'),
			'user_id' => Yii::t('attribute', 'User'),
			'choice_date' => Yii::t('attribute', 'Choice Date'),
			'choice_ip' => Yii::t('attribute', 'Choice Ip'),
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
				'alias'=>'digital',
				'select'=>'publish, digital_title',
			),
			'user' => array(
				'alias'=>'user',
				'select'=>'displayname',
			),
		);

		$criteria->compare('t.choice_id',strtolower($this->choice_id),true);
		if(isset($_GET['digital']))
			$criteria->compare('t.digital_id',$_GET['digital']);
		else
			$criteria->compare('t.digital_id',$this->digital_id);
		if(isset($_GET['user']))
			$criteria->compare('t.user_id',$_GET['user']);
		else
			$criteria->compare('t.user_id',$this->user_id);
		if($this->choice_date != null && !in_array($this->choice_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.choice_date)',date('Y-m-d', strtotime($this->choice_date)));
		$criteria->compare('t.choice_ip',strtolower($this->choice_ip),true);
		
		$criteria->compare('digital.digital_title',strtolower($this->digital_search), true);
		if(isset($_GET['digital']) && isset($_GET['publish']))
			$criteria->compare('digital.publish',$_GET['publish']);
		$criteria->compare('user.displayname',strtolower($this->user_search), true);

		if(!isset($_GET['DigitalChoice_sort']))
			$criteria->order = 't.choice_id DESC';

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
			//$this->defaultColumns[] = 'choice_id';
			$this->defaultColumns[] = 'digital_id';
			$this->defaultColumns[] = 'user_id';
			$this->defaultColumns[] = 'choice_date';
			$this->defaultColumns[] = 'choice_ip';
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
			if(!isset($_GET['digital'])) {
				$this->defaultColumns[] = array(
					'name' => 'digital_search',
					'value' => '$data->digital->digital_title',
				);
			}
			if(!isset($_GET['user'])) {
				$this->defaultColumns[] = array(
					'name' => 'user_search',
					'value' => '$data->user->displayname',
				);
			}
			$this->defaultColumns[] = array(
				'name' => 'choice_date',
				'value' => 'Utility::dateFormat($data->choice_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('application.libraries.core.components.system.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'choice_date',
					'language' => 'en',
					'i18nScriptFile' => 'jquery-ui-i18n.min.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'choice_date_filter',
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
				'name' => 'choice_ip',
				'value' => '$data->choice_ip',
				'htmlOptions' => array(
					'class' => 'center',
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
	 * User get information
	 * 0=choice up
	 * 1=choice down
	 * 2=permission error
	 */
	public static function getChoiceUser($id)
	{
		if(Yii::app()->user->isGuest) 
			return false;
		
		$setting = DigitalSetting::model()->findByPk(1, array(
			'select' => 'editor_choice_status, editor_choice_userlevel, editor_choice_limit',
		));
		$editor_choice_userlevel = unserialize($setting->editor_choice_userlevel);
			
		$choiceLimit = ViewDigitalChoiceUser::model()->find(array(
			'select'    => 'user_id, choices',
			'condition' => 'user_id = :user',
			'params'    => array(
				':user' => Yii::app()->user->id,
			),
		));
		
		$return = 2;
		if($setting->editor_choice_status == 1 && in_array(Yii::app()->user->level, $editor_choice_userlevel)) {
			$choice = DigitalChoice::model()->find(array(
				'select'    => 'choice_id',
				'condition' => 'digital_id = :digital AND user_id = :user',
				'params'    => array(
					':digital' => $id,
					':user' => Yii::app()->user->id,
				),
			));
			if($choice == null)
				$return = 0;
			else
				$return = 1;
			if($choice == null && ($choiceLimit != null && $choiceLimit->choices >= $setting->editor_choice_limit))
				$return = 2;
		} else
			$return = 2;
		
		return $return;
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				$this->user_id = Yii::app()->user->id;
				$this->choice_ip = $_SERVER['REMOTE_ADDR'];
			}
		}
		return true;
	}
}