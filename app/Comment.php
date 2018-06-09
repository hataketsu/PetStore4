<?php

namespace App;

use App\Http\Controllers\FlashToOld;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $content
 * @property int $score
 * @property int $user_id
 * @property int $product_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereScore($value)
 */
class Comment extends Model
{
    use \App\CanFillOld;

    protected $fillable = [
        'content',
        'score',
    ];

    //get the product which this comment belongs to
    public function product()
    {
        return $this->belongsTo('App\\Product');
    }

    //get the user who made this comment
    public function user()
    {
        return $this->belongsTo('App\\User');
    }


}
