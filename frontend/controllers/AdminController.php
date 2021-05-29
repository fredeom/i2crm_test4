<?php

namespace frontend\controllers;

use \yii\web\Controller;
use \yii\filters\VerbFilter;
use \yii\data\Pagination;

use \common\models\User;
use \common\models\UserSearch;
use \common\models\Message;

use \frontend\filters\AdminAuthActionFilter;


class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            [
              'class' => AdminAuthActionFilter::class,
              'only' => ['users', 'marked', 'promote-user', 'mark-message']
            ],
            [
              'class' => '\yii\filters\AjaxFilter',
              'only' => ['promote-user', 'mark-message']
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'promote-user' => ['post'],
                    'mark-message' => ['post'],
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'mark-message' => [
              'class' => \frontend\actions\MarkMessageAction::class,
              'renderCallback' => 'actionMarked'
            ]
        ];
    }

    public function renderUsers() {
      $this->view->params['isAdmin'] = true;
      $searchModel = new UserSearch();
      $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

      return $this->render('users', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
    }

    public function actionUsers()
    {
      return $this->renderUsers();
    }

    public function actionPromoteUser()
    {
        $role = \Yii::$app->request->post('role');
        $iduser = \Yii::$app->request->post('iduser');

        $promoteModel = \yii\base\DynamicModel::validateData(compact('role', 'iduser'), [
          [['role', 'iduser'], 'required'],
          ['role', 'integer', 'max' => 1, 'min' => 0],
          ['iduser', 'integer']
        ]);

        if ($iduser == \Yii::$app->user?->id) {
            $promoteModel->addError('iduser', "You have admin role. Keep up with it");
        }
        if (!$promoteModel->hasErrors()) {
            if (($model = User::findOne($iduser)) !== null) {
              $model->role = $role;
              $model->save();
            }
        } else {
            foreach ($promoteModel->getErrors() as $error) {
                \Yii::$app->session->setFlash('error', $error);
            }
        }
        return $this->renderUsers();
    }

    public function actionMarked()
    {
        $this->view->params['isAdmin'] = true;
        $query = Message::find()->where(['mark' => 1])->orderBy(['created_at' => SORT_ASC]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 10, 'route' => 'admin/marked']);
        $pageFromGET = \Yii::$app->request->get('page');
        $pagination->setPage(
          \Yii::$app->request->get('per-page') ?
            $pageFromGET - 1 :
            (($pageFromGET !== null) && ($pageFromGET <= $pagination->pageCount - 1) ? $pageFromGET : $pagination->pageCount - 1));
        $messages = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('marked', [
          'messages' => $messages,
          'isAdmin' => true,
          'pagination' => $pagination
        ]);
    }
}
