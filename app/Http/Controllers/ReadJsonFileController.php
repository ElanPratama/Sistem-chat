<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReadJsonFileController extends Controller
{


    public function index()
    {
        $data = json_decode(
            file_get_contents(storage_path("chat_response.json")),
            true
        );

        echo "<pre>";
        print_r($data);

    }
}



