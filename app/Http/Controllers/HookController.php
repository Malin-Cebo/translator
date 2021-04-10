<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Translate\V2\TranslateClient;
use simplehtmldom\HtmlWeb;

class HookController extends Controller
{
    function index(Request $request)
    {
        $translate = new TranslateClient([
            'key' => $request->key,
            'source' => $request->src,
            'target' => $request->targ
        ]);

        $doc = new HtmlWeb();
        $html = $doc->load('https://coconut5990849.brizy.site/');

        $array1 = [];

        $htmll = file_get_contents('https://coconut5990849.brizy.site/', true);

        foreach ($html->find('p span, a span, img, h1, h2, h3, h4, h5, h6') as $tag) {
            $tou = $tag->outertext;
            $tr = $translate->translate($tag->outertext)['text'];
            // $md5 = md5($tag->outertext);
            // $array1[$md5] = array(
            //     'original' => $tou,
            //     'toLang' =>  $request->targ
                //    'translated' => $translate->translate($tag->outertext)['text']
            // );
            $array2[] = $tou;
            $array3[] = $tr;
        }
        $htmll = str_replace($array2, $array3, $htmll);

        print_r($htmll);
    }
}
