<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass." {\n"; ?>

<?php 
        $authpath = 'ext.awegen.AweCrud.templates.default.auth.';
	Yii::app()->controller->renderPartial($authpath . $this->authtype);
?>

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('<?php echo $this->modelClass; ?>');
        $this->render('index', array(
                'dataProvider' => $dataProvider,
        ));
    }
        
    public function actionView($id) {
        $this->render('view', array(
                'model' => $this->loadModel($id, '<?php echo $this->modelClass; ?>'),
        ));
    }
        
    public function actionCreate() {
        $model = new <?php echo $this->modelClass; ?>;
        <?php if($this->validation == 1 || $this->validation == 3) { ?>
            $this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass)?>-form');
        <?php } ?>
        if (isset($_POST['<?php echo $this->modelClass; ?>'])) {
            $model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);
                
                <?php //TODO Relationships ?>
                
                try {
                    if($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                            $this->redirect($_GET['returnUrl']);
                    } else {
                            $this->redirect(array('view','id'=>$model->id));
                    }
                }
                } catch (Exception $e) {
                        $model->addError('<?php echo $this->identificationColumn;?>', $e->getMessage());
                }
        } elseif(isset($_GET['<?php echo $this->modelClass; ?>'])) {
                        $model->attributes = $_GET['<?php echo $this->modelClass; ?>'];
        }

        $this->render('create',array( 'model'=>$model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        <?php if($this->validation == 1 || $this->validation == 3) { ?>
        $this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass)?>-form');
        <?php } ?>

        if(isset($_POST['<?php echo $this->modelClass; ?>']))
        {
            $model->setAttributes($_POST['<?php echo $this->modelClass; ?>']);

                try {
                    if($model->save()) {
                        if (isset($_GET['returnUrl'])) {
                                $this->redirect($_GET['returnUrl']);
                        } else {
                                $this->redirect(array('view','id'=>$model->id));
                        }
                    }
                } catch (Exception $e) {
                        $model->addError('<?php echo $this->identificationColumn;?>', $e->getMessage());
                }

            }

        $this->render('update',array(
                'model'=>$model,
                ));
    }
                
               

    public function actionDelete($id) {
        if(Yii::app()->request->isPostRequest) {    
            try {
                $this->loadModel($id)->delete();
            } catch (Exception $e) {
                    throw new CHttpException(500,$e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                            $this->redirect(array('admin'));
            }
        }
        else
            throw new CHttpException(400,
                Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
    }
                
    public function actionAdmin() {
        $model = new <?php echo $this->modelClass; ?>('search');
        $model->unsetAttributes();

        if (isset($_GET['<?php echo $this->modelClass; ?>']))
                $model->setAttributes($_GET['<?php echo $this->modelClass; ?>']);

        $this->render('admin', array(
                'model' => $model,
        ));
    }

    public function loadModel($id) {
            $model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('app', 'The requested page does not exist.'));
            return $model;
    }



    public function beforeAction($action) {
            if ($this->module !== null) {
                    $this->breadcrumbs[$this->module->Id] = array('/'.$this->module->Id);
            }
            return true;
    }
        
}//End of Controller Class