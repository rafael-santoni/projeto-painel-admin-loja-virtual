<?php

namespace App\Controllers;

use App\Classes\Block;
use App\Classes\Container;
use App\Traits\Twig;
use App\Traits\Cache;

class BaseController extends Container {

	use Twig, Cache;

	public function __construct() {

		parent::__construct();

		(new Block)->blockNotAdmin($this);

	}

}
