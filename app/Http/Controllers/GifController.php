<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GifController extends Controller
{
    public function getById(Request $request) {
        return response()->json([
            'status' => 'OK',
            'id'     => $request->id,
        ]);
    }

    public function getByQuery(Request $request) {
        return response()->json([
            'status' => 'OK',
            'query'  => $request->search,
        ]);
    }

    public function save(Request $request) {
        return response()->json([
            'status' => 'OK',
            'alias'  => $request->alias,
        ]);
    }
}
