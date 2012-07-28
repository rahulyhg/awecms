<?php
$this->breadcrumbs = array(
    Yii::t('app', 'News') => array('/news'),
    Yii::t('app', 'Create'),
);
if (!isset($this->menu) || $this->menu === array())
    $this->menu = array(
        array('label' => Yii::t('app', 'List'), 'url' => array('/news')),
        array('label' => Yii::t('app', 'Manage'), 'url' => array('admin')),
    );
?>

<h1> Create New News </h1>
<?php
$this->renderPartial('_form', array(
    'model' => $model,
    'buttons' => 'create'));
?>