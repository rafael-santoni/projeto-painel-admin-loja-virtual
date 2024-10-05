<?php

namespace App\Controllers;

use App\Classes\Block;
use App\Classes\Container;
use App\Traits\Twig;
use App\Traits\Cache;
use App\Traits\View;

class BaseController extends Container {

	use Twig, Cache, View;

	public function __construct() {

		parent::__construct();

		// (new Block)->blockNotAdmin($this);
		$this->load(Block::class)->blockNotAdmin($this);

	}

}
