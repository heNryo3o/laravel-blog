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

        $categories = Category::all()->toArray();

        foreach ($categories as $k => $v){

            $urls[] = route('category.show_slug', $v['slug']);

        }

        //标签
        $tags = Tag::all()->toArray();

        foreach ($tags as $k => $v){

            $urls[] = route('tag.show', $v['name']);

        }

        $urls[] = route('tags');

        $posts = Post::orderBy('created_at', 'desc')->get()->toArray();

        foreach ($posts as $k => $v){

            $urls[] = route('post.show_slug', $v['slug']);

        }

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
