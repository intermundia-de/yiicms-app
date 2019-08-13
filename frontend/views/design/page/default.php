<?php
/**
 * User: zura
 * Date: 6/27/18
 * Time: 7:09 PM
 */

/** @var $this \yii\web\View */
/** @var $contentTreeItem  \frontend\models\ContentTree */
/** @var $index integer */
/** @var $model \intermundia\yiicms\models\Page */

$itemsQuery = $contentTreeItem
    ->getItemsQuery([\common\models\ContentTree::TABLE_NAME_CONTENT_TEXT])
    ->andWhere("view IS NULL OR view = 'default' OR view = ''");
(Yii::$app->user->canEditContent() && Yii::$app->request->get('hidden')) ?: $itemsQuery->notHidden();
$children = $itemsQuery->all();


?>

<div>
    <div>
        {{content}}
    </div>
    <h1><?php echo $model->renderAttribute('title'); ?></h1>
</div>


