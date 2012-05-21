<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Login');
$this->breadcrumbs = array(
    Yii::t('app', "Login"),
);
?>

<?php if (Yii::app()->user->hasFlash('loginMessage')): ?>

    <div class="success">
        <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
    </div>

<?php endif; ?>

<div class="form">
    <?php echo CHtml::beginForm(Yii::app()->getModule('user')->loginUrl); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'username'); ?>
        <?php echo CHtml::activeTextField($model, 'username') ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'password'); ?>
        <?php echo CHtml::activePasswordField($model, 'password') ?>
    </div>

    <div class="row rememberMe">
        <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
        <?php echo CHtml::activeLabelEx($model, 'rememberMe'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton(Yii::t('app', 'Login')); ?>
    </div>

    <div class="row">
        <p class="hint">
            <?php echo CHtml::link(Yii::t('app', 'Register'), Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(Yii::t('app', 'Lost Password?'), Yii::app()->getModule('user')->recoveryUrl); ?>
        </p>
    </div>

    <?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
            'elements' => array(
                'username' => array(
                    'type' => 'text',
                    'maxlength' => 32,
                ),
                'password' => array(
                    'type' => 'password',
                    'maxlength' => 32,
                ),
                'rememberMe' => array(
                    'type' => 'checkbox',
                )
            ),
            'buttons' => array(
                'login' => array(
                    'type' => 'submit',
                    'label' => 'Login',
                ),
            ),
                ), $model);
?>