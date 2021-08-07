<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use DB;


class ScraperController extends Controller
{
    private $results = array();

    public function search(){
        $search = str_replace(' ', '+', request('search'));
        $url="https://www.aliexpress.com/wholesale?SearchText=".$search;

        $client = new Client();
        $page = $client->request('GET',$url);    
        $endArray = strpos($page->text(),'window.runParams.csrfToken');
        $ini = substr($page->text(),strpos($page->text(), 'window.runParams = {"')+19,$endArray);
        $ini = json_decode(explode('; window.runParams.csrfToken ', $ini)[0]);
        
        foreach($ini->mods->itemList->content as $product) {

            $this->results[$product->productId] = array(
                'title' => $product->title->displayTitle,
                'image' => $product->image->imgUrl,
                'price' => $product->prices->salePrice->formattedPrice,
                'storeName' => $product->store->storeName
            );
        }

        $data = $this->results;
        return view('scraper',compact('data'));
    }

    public function saveArticle(Request $request){
        $data = $request->all();
        DB::table('my_articles')->insertOrIgnore([
            [
                'product_id' => $data['id'], 
                'title' => $data['title'],
                'store' => $data['store'],
                'img_url' => 'http:'.$data['img_url'],
                'price' =>explode('$',$data['price'])[1],
                'product_url' => 'https://www.aliexpress.com/item/'.$data['id'].'.html',
            ]
        ]);
    }
}