<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Goutte\Client;

class ProductInfosController extends Controller
{
    private $results = array();
    function getDescHtml($url){
        $html = file_get_contents($url);
        return $html;
    }
    public function prodInfos(){
        $res =json_decode(DB::table('my_articles')->get(), true);
        return view('productInfos',compact('res'));
    }

    public function delete($id){
        $res = DB::table('my_articles')->where('product_id',$id)->delete();
        return redirect('/');
    }

    public function specificProdDetails($id){
        $url='https://www.aliexpress.com/item/'.$id.'.html';

        $client = new Client();
        $page = $client->request('GET',$url); 
       
        $startIndex = strpos($page->text(),'window.runParams = { data:')+27;
        $ini = substr($page->text(),$startIndex);
        $endIndex = strpos($ini,', csrfToken:');
        $ini = substr($ini,0,$endIndex);
        $ini = json_decode($ini);

        $this->results[$ini->actionModule->productId] = array(
            'product_id' => $ini->actionModule->productId,
            'title' => $ini->titleModule->subject,
            'image' => array($ini->imageModule->imagePathList),
            'price' => $ini->priceModule->maxAmount->value,
            'store' => $ini->storeModule->storeName,
            'description' => $this->getDescHtml($ini->descriptionModule->descriptionUrl),
        );
        $data = $this->results;
        return view('specificProduct',compact('data'));
    }

   
}
