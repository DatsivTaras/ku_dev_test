<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsCreate;
use App\Models\Comments;
use App\Services\CommentsService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /*
     * @param int $id
     */  
    public function index(Request $request)
    {
        return json_encode(CommentsService::getCommentsForAjaxByBlogId($request->get('id')));
    }

    /*
     * @param Request $request
     */
    public function store(CommentsCreate $request)
    {
        $comment = new Comments();
        $comment->fill($request->all());
        $comment->save();

        return json_encode([
            'id' => $comment->id,
            'text' => $comment->text,
            'created_at' => Carbon::createFromTimeString($comment->created_at)->format('d M Y h:m')
        ]);
    }

    /*
     * @param int $id
     */   
    public function destroy(int $id)
    {
        Comments::find($id)->delete();

        return json_encode([
            'status' => true
        ]);
    }
}
