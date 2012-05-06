<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language ?>">
    <head>
        <meta charset=utf-8" />
        <title>Dashboard : <?php echo Awecms::getSiteName() ?></title>
        <?php $assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.admin.assets')) . '/'; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $assetsUrl; ?>admin.css?<?php echo time() ?>"/>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                $('.accordion .head').click(function() {
                    $(this).next().toggle('slow');
                    return false;
                }).next().hide();
            });
        </script>
        <style type="text/css">
        </style>
    </head>

    <body>

        <div id="main_container">
            <header>
                <h2 id="title">
                    <?php echo CHtml::link(AdminModule::t('Dashboard') . ' : ' . Awecms::getSiteName(), array('/admin')); ?>
                </h2>
                <nav id="header_right">
                    <ul id="header_links">
                        <li><?php echo AdminModule::t('Welcome') . ' ' . Yii::app()->user->name; ?></li> |
                        <li><?php echo CHtml::link(AdminModule::t('Account Settings'), array('/profile/edit')); ?></li> |
                        <li><?php echo CHtml::link(AdminModule::t('Visit Website'), array('/')); ?></li> |
                        <li><?php echo CHtml::link(AdminModule::t('Logout'), array('/user/logout')); ?></li>
                    </ul>

                </nav>
                <nav>
                    <div class="grid_5 sidebar" style="overflow: auto">
                        <?php
//                        $this->widget('application.widgets.NavBar', array(
//                            'tryDefault' => FALSE,
//                            'context' => 'admin',
//                            'items' => array(
//                                array('label' => 'Admin Home', 'url' => array('/admin/index/index')),
//                            ),
//                        ));
                        ?>
                    </div>

                </nav>

            </header>
            <div class="clear"></div>
            <?php
            ?>
            <nav id="left_sidebar">
            <?php
            $this->widget('zii.widgets.jui.CJuiAccordion', array(
                'panels' => AdminModule::getMenuConfig(),
                'options' => array(
                    'collapsible' => true,
                    'active' => 0,
                    'animated' => 'slide',
                    'navigation' => true,
                    'collapsible' => false,
                ),
                'htmlOptions' => array(
                    'style' => 'width:220px;'
                ),
            ));
            ?>


            </nav>
            <div id="main_wrapper">
<?php
echo $content;
?>
            </div>
        </div>
        <footer>

        </footer>
    </body>
</html>