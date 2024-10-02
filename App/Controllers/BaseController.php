<?php

namespace App\Controllers;

use App\Classes\Block;
use App\Traits\Twig;
use App\Traits\Cache;

class BaseController {

	use Twig, Cache;

	public function __construct() {
		(new Block)->blockNotAdmin($this);
	}

}
