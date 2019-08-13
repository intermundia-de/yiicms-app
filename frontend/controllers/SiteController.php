<?php

namespace frontend\controllers;

use intermundia\yiicms\models\Search;
use common\models\Page;
use common\models\Website;
use frontend\models\ContactForm;
use frontend\models\ContentTree;
use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale' => [
                'class' => 'common\actions\SetLocaleAction',
                'locales' => array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    /**
     * @return string|Response
     */
    public function actionContactSubmit()
    {
        $adminEmail = null;
        $ccEmail = null;
        $bccEmail = null;
        $websiteContentTree = Yii::$app->websiteContentTree->getModel();

        if ($websiteContentTree->activeTranslation->admin_email) {
            $adminEmail = $websiteContentTree->activeTranslation->admin_email;
        } elseif (Yii::$app->params['adminEmail'] && filter_var(Yii::$app->params['adminEmail'], FILTER_VALIDATE_EMAIL)) {
            $adminEmail = Yii::$app->params['adminEmail'];
        }

        if ($websiteContentTree->activeTranslation->cc_email) {
            $ccEmail = $websiteContentTree->activeTranslation->cc_email;
        } elseif (Yii::$app->params['ccEmail'] && filter_var(Yii::$app->params['ccEmail'], FILTER_VALIDATE_EMAIL)) {
            $ccEmail = Yii::$app->params['ccEmail'];
        }

        if ($websiteContentTree->activeTranslation->bcc_email) {
            $bccEmail = $websiteContentTree->activeTranslation->bcc_email;
        } elseif (Yii::$app->params['bccEmail'] && filter_var(Yii::$app->params['bccEmail'], FILTER_VALIDATE_EMAIL)) {
            $bccEmail = Yii::$app->params['bccEmail'];
        }

        $adminEmail = $adminEmail ? explode(',', $adminEmail) : null;
        $ccEmail = $ccEmail ? explode(',', $ccEmail) : null;
        $bccEmail = $bccEmail ? explode(',', $bccEmail) : null;


        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($adminEmail && $model->contact($adminEmail, null, $ccEmail, $bccEmail)) {
                return $this->render('contact_success');
            }
        }

        $page = Page::find()
            ->byId(Yii::$app->request->post('page_id'))
            ->notDeleted()
            ->one();
        return $this->render('contact', [
            'contactFormModel' => $model,
            'model' => $page
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionContactSuccess()
    {
        return $this->render('contact_success');
    }

    public function actionSitemapXml()
    {
        Yii::$app->response->format = Response::FORMAT_XML;

        $items = ContentTree::find()
            ->notHidden()
            ->notDeleted()
            ->andWhere(['<=', 'depth', 3])
            ->andWhere('table_name = :page')
            ->params([
                'page' => ContentTree::TABLE_NAME_PAGE,
            ])
            ->orderBy('lft')
            ->all();

        $sitemapItems = [];
        foreach ($items as $item) {
            $sitemapItems[] = [
                'changefreq' => 'daily',
                'url' => $item->getUrl(false, true),
                'priority' => 1 - ($item->depth - 1) / 10
            ];
        }

        return $sitemapItems;
    }

    /**
     * @param string $language
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     * @return string
     */
    public function actionSearch($language = '')
    {
        $searchModel = new Search();
        $query = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query->all(),
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
