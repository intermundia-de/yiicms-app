<?php
/**
 * User: zura
 * Date: 6/24/18
 * Time: 7:18 PM
 */

/** @var $this \intermundia\yiicms\web\View */
/** @var $contentTreeItem \frontend\models\ContentTree */
/** @var $index integer */
/** @var $model \intermundia\yiicms\models\ContentText */

$page = $this->contentTreeObject;
?>

<div id="id_<?php echo $contentTreeItem->id ?>" <?php echo $contentTreeItem->getEditableAttributesForSection('section'); ?> class="<?php echo $contentTreeItem->getCssClass(); ?> col-sm-4">
    <?php echo $model->renderImage('image'); ?>
    <h2><?php echo $model->renderAttribute('name'); ?></h2>
    <div class="xmlblock-wrapper">
        <div class="xmlblock" <?php echo $contentTreeItem->getEditableAttributes('multi_line', 'rich-text') ?>>
            <?php echo $model->renderAttribute('multi_line'); ?>
        </div>
    </div>
    <?php echo $this->render('@frontend/views/content-tree/list', [
        'viewFile' => null,
        'contentTreeItem' => $contentTreeItem
    ]); ?>
</div>
