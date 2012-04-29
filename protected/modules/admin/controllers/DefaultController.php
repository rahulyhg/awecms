<?php

class DefaultController extends Controller {

    public function actionIndex() {
        //if the user isn't logged in, redirect to login page
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('/user/login'));
            //should be redirected back here after the login
        } elseif (!Yii::app()->getModule('user')->isAdmin()) {
            //redirect non-admin users to profile(the only thing they can administrate)
            $this->redirect(array('/user/profile'));
        } else {//finally it should be him, the admin
            $this->render('index');
        }
    }

}