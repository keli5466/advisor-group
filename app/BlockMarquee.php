<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class BlockMarquee extends Base
{
	use HasImages, IsBlockType;

	public static $types = [
		'white' => 'White',
		'outline' => 'Outline',
	];
	public static $floats = [
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
			'blockMarqueeImages' => function($query) { $query->listing(); },
		])
		->withImage('marquee_eyebrow', 600)
		->withImage('marquee_float_logo', 600)
		->withImage('blockMarqueeImages.background', 1920)
		->addVisible('blockMarqueeImages');
		return $this->toArray();
	}
}
