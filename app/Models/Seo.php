<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Seo extends Model
{

    public function pushUrl()
    {

        $urls = array();

        $urls[] = url('/');

        $categorys = Category::all();

        $categorys->each(function ($category) {

            $urls[] = route('category.show', $category->slug);

        });

        //标签
        $tags = Tag::all();

        $tags->each(function ($tag) {

            $urls[] = route('tag.show', $tag->name);

        });

        $urls[] = route('tags');

        $posts = Post::orderBy('created_at', 'desc')->get();

        $posts->each(function ($post) {

            $urls[] = route('post.show', $post->slug);

        });

        dd($urls);

        $api = 'http://data.zz.baidu.com/urls?site=https://www.yuyinuo.cn&token=ublJMuNlBVDcTdmH';
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );

        curl_setopt_array($ch, $options);

        $result = curl_exec($ch);
        echo $result;

        return;

    }

}
