<?php

class DefaultController extends Controller {
	
    public function __construct($model) {
        parent::__construct($model);
    }// ControllerInscription

    public function update(/*do_it*/) {
        if (!empty($this->options)) {
            if ($this->options[0] === "r")
            {
                switch ($this->options[1])
                {
                    case "flux":
                        ;
                    case "category":
                        ;
                    case "blog":
                        ;
                        $this->model->setActive($this->options[1]);
                    default:break;
                }
            }

        }
    }
}
