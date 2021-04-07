<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Translate\V2\TranslateClient;

class HookController extends Controller
{
    function index(Request $request)
    {
        $path = storage_path('data.json');
        $json = json_decode(file_get_contents($path), true);
        $translate = new TranslateClient([
            'key' => $request->key,
            'source' => $request->src,
            'target' => $request->targ
        ]);
        foreach (array_chunk($json, 128) as $value) {
            $results = $translate->translateBatch($value);
            foreach ($results as $result) {
                $cart[] = $result['text'];
            }
        }
        return $cart;
    }
}
