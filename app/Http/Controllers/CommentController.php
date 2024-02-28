<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Content;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index() {
        $comments = Comment::select(
            'id',
            'text',
            'sending_date',
            'publication_date',
            'status'
            )->orderBy('created_at', 'DESC')->paginate(10);
        return $this->validResponse($comments);
    }

    public function read($id) {
        $comment = Comment::findOrFail($id);
        
        return $this->validResponse($comment);
    }

    public function create(Request $request) {
        $rules = [
            'text' => 'required|max:180',
            'sending_date' => 'required|integer|min:20240101',
            'publication_date' => 'required|integer|min:20240101',
            'status' => 'required|in:PENDING,PUBLISHED',
            'content_id' => 'required|integer|exists:contents,id',
            'user_id' => 'required|integer|exists:users,id'
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['created_by'] = 'system';

        
        $comment = Comment::create($data);

        return $this->successResponse($comment, Response::HTTP_CREATED);
    }

    public function update($id, Request $request) {
        $rules = [
            'text' => 'required|max:180',
            'sending_date' => 'required|integer|min:20240101',
            'publication_date' => 'required|integer|min:20240101',
            'status' => 'required|in:PENDING,PUBLISHED',
            'content_id' => 'required|integer|exists:contents,id',
            'user_id' => 'required|integer|exists:users,id'
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['updated_by'] = 'system';

        $comment = Comment::findOrFail($id);

        $comment->fill($data);
        $comment->save();

        return $this->successResponse($comment, Response::HTTP_OK);
    }

    public function patch($id, Request $request) {
        $rules = [
            'text' => 'max:180',
            'sending_date' => 'integer|min:20240101',
            'publication_date' => 'integer|min:20240101',
            'status' => 'in:SENDING,PUBLISHED',
            'content_id' => 'integer|exists:contents,id',
            'user_id' => 'integer|exists:users,id'
        ];
        $this->validate($request, $rules);

        $comment = Comment::findOrFail($id);

        $data = $request->all();
        $data['updated_by'] = 'system';

        $comment->fill($data);
        $comment->save();

        return $this->successResponse($comment, Response::HTTP_OK);
    }

    public function delete($id) {
        $comment = Comment::findOrFail($id);

        $comment->delete();
        return $this->successResponse($comment, Response::HTTP_OK);
    }

}
