<div class="form">
    <p class="note">
        <?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'album-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
            ));

    echo $form->errorSummary($model);
    ?>

    <?php
    $this->widget('PageForm', array(
        'model' => $model,
        'form' => $form,
        'fields' => array('title', 'slug')
    ));
    ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'Description'); ?>
        <?php
        $page = isset($model->page) ? $model->page : new Page;
        $this->widget('ext.ckeditor.CKEditorWidget', array(
            "model" => $page,
            "attribute" => "content",
            "defaultValue" => $page->content,
            "config" => array(
                "height" => "50px",
                'toolbar' => 'Basic',
            ),
        ));
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'thumbnail_id'); ?>
        <?php echo $form->dropDownList($model, 'thumbnail', CHtml::listData(Image::model()->findAll(), 'id', 'title')); ?>
        <?php echo $form->error($model, 'thumbnail_id'); ?>
    </div>

    

    <?php
    echo CHtml::submitButton(Yii::t('app', 'Save'));
    echo CHtml::Button(Yii::t('app', 'Cancel'), array(
        'submit' => 'javascript:history.go(-1)'));
    $this->endWidget();
    ?>
</div> <!-- form -->