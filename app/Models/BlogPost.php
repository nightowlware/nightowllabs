<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 25 Dec 2018 01:19:51 -0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BlogPost
 * 
 * @property int $id
 * @property int $author_id
 * @property int $category_id
 * @property string $title
 * @property string $seo_title
 * @property string $excerpt
 * @property string $body
 * @property string $image
 * @property string $slug
 * @property string $meta_description
 * @property string $status
 * @property bool $featured
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $tags
 * @property \Carbon\Carbon $published_date
 *
 * @package App\Models
 */
class BlogPost extends Eloquent
{
	protected $perPage = 25;

	protected $casts = [
		'author_id' => 'int',
		'category_id' => 'int',
		'featured' => 'bool'
	];

	protected $dates = [
		'published_date'
	];

	protected $fillable = [
		'author_id',
		'category_id',
		'title',
		'seo_title',
		'excerpt',
		'body',
		'image',
		'slug',
		'meta_description',
		'status',
		'featured',
		'tags',
		'published_date'
	];
}
