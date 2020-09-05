<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        $pageSize = $request->size ?? self::PAGE_SIZE;
        $pageNO = $request->page ?? 1;
        $skip = ($pageNO - 1) * $pageSize;

        $data['count'] = Item::count();
        $data['object'] = Item::skip($skip)->take($pageSize)->get()->toArray();
        $data['result'] = true;

        return $data;
    }

}
