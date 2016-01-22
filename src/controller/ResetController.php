<?php

class Reset extends Controller {
	public function __construct(Model $model) {
		parent::__construct($model);
	}

	public function recupadr($information1)
	{$this->model->get($information1);
	}// recupadr

	public function update()
    {

    }

}