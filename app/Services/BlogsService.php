<?php

namespace App\Services;

use App\Models\Blogs;

class BlogsService
{

    /*
     * @param Blogs $id
     * 
     * @return string
     */  
    public static function addLinkToBlogDescription(Blogs $blog):string
    {
        $description = $blog->description;
        $descriptionWords = explode(" ", $blog->description);

        $checkedWord = [];
        foreach ($descriptionWords as $word) {
            if (mb_strlen($word) < 5) {
                continue;
            }
            $searchWord = trim($word, '.,');
            if (in_array($searchWord, $checkedWord)) {
                continue;
            }
            $checkedWord[] = $searchWord;

            $lastBlog = Blogs::where('id', '!=', $blog->id)
                ->where('description', 'like', '%' . $searchWord . '%')
                ->orderBy('created_at', 'desc')
                ->first();

            if ($lastBlog) {
                $description = str_replace($searchWord, '<a href="' . $lastBlog->getLink() . '">' . $searchWord . '</a>', $description);
            }
        }

        return $description;
    }
}
?>