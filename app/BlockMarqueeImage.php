<?php

namespace App;

use App\Concerns\IsPositionedBlockChild;
use Bkwld\Decoy\Models\Base;
use Bkwld\Decoy\Models\Traits\HasImages;

class BlockMarqueeImage extends Base
{
    use HasImages, IsPositionedBlockChild;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       'images.background' => 'image',
    ];

    /**
     * List of all relationships
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function blockMarquee()
    {
        return $this->belongsTo(BlockMarquee::class);
    }

    /**
	 * Increase the size of the preview thumb
	 *
	 * @return string
	 */
	public function getAdminTitleHtmlAttribute() {
		if (!$url = $this->getAdminThumbAttribute(80, 80)) return;
		return sprintf('<img src="%s" alt="">', $url);
	}
}
