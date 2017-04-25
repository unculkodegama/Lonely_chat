<?php

namespace App\Presenters;

use Nette;
use App\Model;

class ChatpagePresenter extends BasePresenter {

    private $model = null;

    public function getModel() {
        if (!isset($this->model)) {
            $this->model = new Model\ChatpageModel($this->context->getService("database"));
        }
        
        return $this->model;
    }

    public function renderDefault() {
        
        $this->template->account = $this->getModel();
    }
       
}