<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;

class BlockWysiwyg extends Base
{
	use IsBlockType;

    /**
	 * Parse links in wysiwyg
	 *
	 * @return string
	 */
	public function getWysiwygAttribute($val) {
		return app('site')->addApiUrlToLinks($val);
	}

	/**
	 * Map block data for the API
	 *
	 * @return array
	 */
	public function forApi(Block $block) {
		return $this->toArray();
	}
}
