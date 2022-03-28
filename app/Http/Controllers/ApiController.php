<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function store()
    {
        try {
            $requestReddit = Http::get('https://api.reddit.com/r/artificial/hot')->json();
            $postsReddit = $requestReddit['data']['children'];

            DB::beginTransaction();
            foreach ($postsReddit as $postReddit) {
                $post = PostModel::where('api_id', $postReddit['data']['id'])->first();
                if (!$post) {
                    $post = new PostModel();
                    $post->api_id = $postReddit['data']['id'];
                    $post->title = $postReddit['data']['title'];
                    $post->author = $postReddit['data']['author'];
                    $post->ups = $postReddit['data']['ups'];
                    $post->num_comments = $postReddit['data']['num_comments'];
                    $post->created = date('Y-m-d h:i:s', $postReddit['data']['created']);
                    $post->save();
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    
}
