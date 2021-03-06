<?php

/**
 * This is the model base class for the table "slug".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Slug".
 *
 * Columns in table "slug" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $slug
 * @property string $path
 *
 */
abstract class BaseSlug extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'slug';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Slug|Slugs', $n);
    }

    public static function representingColumn() {
        return 'slug';
    }

    public function rules() {
        return array(
            array('slug, path, enabled', 'required'),
            array('enabled', 'numerical', 'integerOnly' => true),
            array('slug, path', 'length', 'max' => 100),
            array('id, slug, path,enabled', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'path' => Yii::t('app', 'Path'),
            'enabled' => Yii::t('app', 'Enabled'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('path', $this->path, true);
        $criteria->compare('enabled', $this->enabled, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}