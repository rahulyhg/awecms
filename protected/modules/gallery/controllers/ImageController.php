<?php

class ImageController extends Controller {

    private $subfolderVar = 'folder';
    private $path;
    private $publicPath;
    private $_subfolder = '';

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Image');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionUpload() {

        //handle folders
        $this->path = Settings::get('gallery', 'uploadPath');
        $path = Yii::app()->getBasePath() . Settings::get('gallery', 'uploadPath');
        $this->publicPath = Settings::get('gallery', 'uploadUrl');

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
            chmod($path, 0777);
            //throw new CHttpException(500, "{$this->path} does not exists.");
        } else if (!is_writable($path)) {
            chmod($path, 0777);
            //throw new CHttpException(500, "{$this->path} is not writable.");
        }

        if ($this->subfolderVar !== null && Yii::app()->request->getQuery($this->subfolderVar)) {
            $this->_subfolder = Yii::app()->request->getQuery($this->subfolderVar, date("mdY"));
        } else if (isset($_GET['album_id'])) {
            $this->_subfolder = Awecms::getCamelCase(Album::model()->findByPk($_GET['album_id'])->page->title);
        } else if ($this->subfolderVar !== false) {
            $this->_subfolder = date("mdY");
        }

        //handle upload file
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }

        if (isset($_GET["_method"])) {
            if ($_GET["_method"] == "delete") {
                $success = is_file($_GET["file"]) && $_GET["file"][0] !== '.' && unlink($_GET["file"]);
                echo json_encode($success);
            }
        } else {
            $model = new Image;
            $file = CUploadedFile::getInstance($model, 'file');
            if ($file !== null) {
                $path = ($this->_subfolder != "") ? "{$path}/{$this->_subfolder}/" : "{$path}/";
                $this->path = ($this->_subfolder != "") ? "{$this->path}/{$this->_subfolder}/" : "{$this->path}/";
                $time = time();
                $model->mime_type = $file->getType();
                $model->size = $file->getSize();
                $model->name = $file->getName();
                $model->title = $_POST['title'][$model->size . $model->name];
                $model->description = $_POST['description'][$model->size . $model->name];
                $model->file = $this->path . $time . $model->name;


                if (isset($_GET['album_id']))
                    $model->album_id = $_GET['album_id'];
                if ($model->save()) {
                    $publicPath = ($this->_subfolder != "") ? "{$this->publicPath}/{$this->_subfolder}/" : "{$this->publicPath}/";
                    if (!is_dir($path)) {
//                        print_r($path);
//                        die();
                        mkdir($path, 0777, true);
                        chmod($path, 0777);
                    }
                    $file->saveAs($path . $time . $model->name);
                    chmod($path . $time . $model->name, 0777);
                    echo json_encode(array(array(
                            "name" => $time . $model->name,
                            "title" => $model->title,
                            "description" => $model->description,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            "url" => $publicPath . $model->name,
                            "thumbnail_url" => $publicPath . $time . $model->name,
                            "delete_url" => $this->createUrl("upload", array(
                                "_method" => "delete",
                                "file" => $path . $model->name
                            )),
                            "delete_type" => "POST"
                            )));
                } else {
                    echo json_encode(array(array("error" => $model->getErrors('file'),)));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction");
                }
            } else {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new Image;
        if (isset($_POST['Image'])) {
            $model->setAttributes($_POST['Image']);

            if (isset($_POST['Image']['album']))
                $model->album = $_POST['Image']['album'];
            if (isset($_POST['Image']['page']))
                $model->page = $_POST['Image']['page'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('', $e->getMessage());
            }
        } elseif (isset($_GET['Image'])) {
            $model->attributes = $_GET['Image'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Image'])) {
            $model->setAttributes($_POST['Image']);
            if (isset($_POST['Image']['album']))
                $model->album = $_POST['Image']['album'];
            else
                $model->album = array();
            if (isset($_POST['Image']['page']))
                $model->page = $_POST['Image']['page'];
            else
                $model->page = array();
            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('', $e->getMessage());
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($id)->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(array('admin'));
            }
        }
        else
            throw new CHttpException(400,
                    Yii::t('app', 'Invalid request.'));
    }

    public function actionAdmin() {
        $model = new Image('search');
        $model->unsetAttributes();

        if (isset($_GET['Image']))
            $model->setAttributes($_GET['Image']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Image::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }

}