<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class BlockMultiBlurb extends Base
{
	use HasImages, IsBlockType;

	public static $themes = [
		'white' => 'White',
		'grey' => 'Grey',
	];

	public static $align = [
		'left' => 'Left',
		'right' => 'Right',
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
			'blurbs' => function($query) { $query->listing(); },
		])
		->withImage('multi_blurb_background', '100%')
		->withImage('iconTouts.icon', 250)
		->addVisible(['iconTouts', 'blurbs']);
		return $this->toArray();
	}
}
