<?php header('Access-Control-Allow-Origin: http://disqus.com'); ?>
<?php Awecms::$start_time = microtime(TRUE); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/kube.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css?<?php echo time() ?>" />

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js?<?php echo time() ?>"></script>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <script type="text/javascript">
            var disqus_developer = 1;
        </script>
    </head>

    <body>
        <div class="wrapper">
            <div >
                <header id="header">
                    <h1 class="head"><?php echo Settings::get('site', 'name'); ?></h1>
                    <nav id="nav">
                        <?php $this->widget('MenuRenderer'); ?>
                        <?php $this->widget('GAnalytics'); ?>
                    </nav>       
                </header>
            </div>
            <?php if (isset($this->breadcrumbs)) { ?>
                <div class="mid-bar row">
                    <?php //TODO: show up some message and breadcrumb like Home /Index when user is not signed in and is in home page ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                }
                ?>
                <?php $this->widget('LoginWidget'); ?>  
            </div>

            <div class="row">
                <div class="fifth">

                    <?php $this->widget('LatestNews'); ?>  
                    <?php $this->widget('Events'); ?> 

                </div>

                <div class="fourfifth">
                    <?php echo $content; ?>
                </div>
            </div>
            <?php include_once '_footer.php'; ?>
        </div>
        <?php $this->widget('Disqus'); ?>
    </body>
</html>

