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
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return false;
        }
    }

    public function getPosts($initial, $final, $order = 1)
    {
        try {
            $orderBy = $order == 2 ? 'num_comments' : 'ups';

            $posts = PostModel::select('title', 'author', 'ups', 'num_comments', 'created')
                ->whereRaw("date(created) BETWEEN '$initial' AND '$final'")
                ->orderBy($orderBy, 'DESC')
                ->get();

            if (count($posts) > 0) {
                return response()->json([
                    'success' => true,
                    'data' => json_decode($posts->toJson()),
                ]);
            }

            return response()->json([
                'success' => true,
                'msg' => 'Results not found',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getAuthors($order = 1)
    {
        try {
            $orderBy = $order == 2 ? 'num_comments' : 'ups';

            $authors = PostModel::select('author')
                ->orderBy($orderBy, 'DESC')
                ->get();

            if (count($authors) > 0) {
                return response()->json([
                    'success' => true,
                    'data' => json_decode($authors->toJson()),
                ]);
            }

            return response()->json([
                'success' => true,
                'msg' => 'Results not found',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
