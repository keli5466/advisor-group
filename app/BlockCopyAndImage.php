<?php

namespace App;

use App\Concerns\IsBlockType;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class BlockCopyAndImage extends Base
{
		use HasImages, IsBlockType;

		public static $layouts = [
				'image-left' => 'Image Left',
				'image-right' => 'Image Right',
		];

		public static $themes = [
				'white' => 'White',
				'grey' => 'Grey',
		];

		public static $widths = [
				'half' => '<b>Half -</b> <br><span style="color:grey"> Design Dimensions: <b>610x482</b><br> Upload ratio: <b>305/241</b><br> Recommended(Retina) Upload Image Size: <b>1220px x 964px</b> </span>',
				'quarter' => '<b>Quarter -</b> <br><span style="color:grey"> Design Dimensions: <b>410x482</b><br> Upload ratio: <b>205/241</b><br> Recommended(Retina) Upload Image Size: <b>820px x 964px</b> </span>',
				'third' => '<b>Third -</b> <br><span style="color:grey"> Design Dimensions: <b>510x482</b><br> Upload ratio: <b>255/241</b><br> Recommended(Retina) Upload Image Size: <b>1020px x 964px</b> </span>',
		];
		/**
		 * Map block data for the API
		 *
		 * @return array
		 */
		public function forApi(Block $block) {
				$block->withImage('copy_and_image_background')
					->withImage('copy_and_image_foreground');
				return $this->toArray();
		}
}
