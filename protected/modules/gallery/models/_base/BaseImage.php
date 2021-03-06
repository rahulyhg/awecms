<?php

/**
 * This is the model base class for the table "image".
 *
 * Columns in table "image" available as properties of the model:

 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $album_id
 * @property string $file
 * @property string $mime_type
 * @property string $size
 * @property string $name
 *
 * Relations of table "image" available as properties of the model:
 * @property Album[] $albums
 * @property Album $album
 */
abstract class BaseImage extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'image';
    }

    public function rules() {
        return array(
            array('file', 'required'),
            array('file', 'file', 'types' => 'jpg, jpeg, gif, png', 'maxSize' => 5 * 1024 * 1024), //5 MB max size
            array('title, description, album_id, mime_type, size, name', 'default', 'setOnEmpty' => true, 'value' => null),
            array('album_id', 'numerical', 'integerOnly' => true),
            array('title, file, mime_type, size, name', 'length', 'max' => 255),
            array('description', 'safe'),
            array('id, title, description, album_id, file, mime_type, size, name', 'safe', 'on' => 'search'),
        );
    }

    public function __toString() {
        return (string) $this->title;
    }

    public function relations() {
        return array(
            'albums' => array(self::HAS_MANY, 'Album', 'thumbnail_id'),
            'album' => array(self::BELONGS_TO, 'Album', 'album_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'album_id' => Yii::t('app', 'Album'),
            'file' => Yii::t('app', 'File'),
            'mime_type' => Yii::t('app', 'Mime Type'),
            'size' => Yii::t('app', 'Size'),
            'name' => Yii::t('app', 'Name'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('album_id', $this->album_id);
        $criteria->compare('file', $this->file, true);
        $criteria->compare('mime_type', $this->mime_type, true);
        $criteria->compare('size', $this->size, true);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                ));
    }

}