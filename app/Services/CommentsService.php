<?php

namespace App\Services;

use App\Models\Blogs;
use App\Models\Comments;
use Carbon\Carbon;

class CommentsService
{

    /*
     * @param int $id
     * 
     * @return array
     */  
    public static function getCommentsForAjaxByBlogId(int $blogId):array
    {
        $res = [];
        if (!Blogs::where('id', $blogId)->exists()) {
            return $res;
        }

        $comments = Comments::where('blog_id', $blogId)->get();
        if ($comments) {
            foreach ($comments as $comment) {
                $res[] = [
                    'id' => $comment->id,
                    'text' => $comment->text,
                    'created_at' => Carbon::createFromTimeString($comment->created_at)->format('d M Y h:m')
                ];
            }
        }

        return $res;
    }
}
?>