<div class="view">

    <h2><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id' => $data->id)); ?></h2>

    <?php
    if (!empty($data->user_id)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->user_id);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->content)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo nl2br($data->content);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->status)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->status);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->created_at)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
            </div>
<div class="field_value">
                <?php
                $datetime = strtotime($data->created_at);
                $dbfield = date('D, d M y H:i:s', $datetime);
                echo $dbfield;
                ?>

        </div>
        </div>

        <?php
    }
    ?>
    <?php
    if (!empty($data->modified_at)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('modified_at')); ?>:</b>
            </div>
<div class="field_value">
                <?php
                $datetime = strtotime($data->modified_at);
                $dbfield = date('D, d M y H:i:s', $datetime);
                echo $dbfield;
                ?>

        </div>
        </div>

        <?php
    }
    ?>
    <?php
    if (!empty($data->parent)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('parent')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->parent);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->order)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('order')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->order);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->type)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->type);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->comment_status)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('comment_status')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->comment_status);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('tags_enabled')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->tags_enabled == 1 ? 'True' : 'False');
                ?>

            </div>
        </div>
    <?php
    if (!empty($data->permission)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('permission')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->permission);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->password)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->password);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($data->views)) {
        ?>
    <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('views')); ?>:</b>
            </div>
<div class="field_value">

                <?php
                echo CHtml::encode($data->views);
                ?>

            </div>
        </div>
        <?php
    }
    ?>
</div>