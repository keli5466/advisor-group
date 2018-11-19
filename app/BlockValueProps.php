<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class BlockValueProps extends Base
{
	use HasImages, IsBlockType;

	public static $layouts = [
		'image-left' => 'Image Left',
		'image-right' => 'Image Right',
	];

	/**
	 * Map block data for the API
	 *
	 * @param  Block $block
	 * @return array
	 */
	public function forApi(Block $block) {
		$block->load([
			'iconTouts' => function($query) { $query->listing(); },
		])
		->withImage('value_props_background', '100%')
		->withImage('iconTouts.icon', 250)
		->addVisible('iconTouts');
		return $this->toArray();
	}
}
