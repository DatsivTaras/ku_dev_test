<?php

namespace App\Models;

use App\Classes\Enum\BlogStatus;
use App\Services\BlogsService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    /*
     * @return string
     */
    public function getLink()
    {
        return route('blog.view', ['id' => $this->id]);
    }

    /*
     * @return string
     */
    public function getDescriptionWithLink()
    {
        return BlogsService::addLinkToBlogDescription($this);
    }

    /*
     * @return string
     */
    public function getStatus()
    {
        $statuses = self::statusList();
        return array_key_exists($this->status, $statuses) ? $statuses[$this->status] : '';
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', BlogStatus::PUBLISHED);
    }

    /*
     * @return array
     */
    public static function statusList()
    {
        return [
            BlogStatus::PUBLISHED => __('blog.published'),
            BlogStatus::NOTPUBLISHED => __('blog.notPublished')
        ];
    }
}
