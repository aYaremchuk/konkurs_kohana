<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Comments extends Controller {
 
    public function action_index()
    {
        if($this->request->is_initial())
            Request::initial()->redirect(URL::site(''));
 
        $article_id = $this->request->param('id');
 
        $content = View::factory('/comments/show')
                    ->bind('comments', $comments);
 
        if($_POST)
        {
            $user = Arr::get($_POST, 'user');
            $message = Arr::get($_POST, 'message');
 
            Model::factory('Comment')->create_comment($article_id, $user, $message);
        }
 
        $comments = Model::factory('Comment')->get_comments($article_id);
        $this->response->body($content);
    }
 
} // Comments