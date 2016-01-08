<?php
/**
 * Created by Romain Goffi.
 * User: romain goffi
 * Date: 28/12/15
 * Time: 17:37
 */

class Controllerforgotpass extends Controller {
	public function __construct(Model $model) {
		parent::__construct($model);
	}

	public function recupadr($information1)
	{$this->model->get($information1);
	}// recupadr

}