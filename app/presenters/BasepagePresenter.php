<?php

namespace App\Presenters;

use Nette;
use App\Model;

class BasepagePresenter extends BasePresenter {

    private $model = null;

    public function getModel() {
        if (!isset($this->model)) {
            $this->model = new Model\BasepageModel($this->context->getService("database"));
        }
        
        return $this->model;
    }

    public function renderDefault() {
        
        $this->template->basepage = $this->getModel();
    }
    
    public function actionDeleteRoom() {
        
        $this->getModel();
        
        $this->flashMessage("Nothing to see here! Move along citizen.");
        $this->redirect("basepage:");
    }
    
}
