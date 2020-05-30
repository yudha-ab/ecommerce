<?php

namespace App\Http\Controllers\API\V1\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Logic\V1\API\Categories\Admin\CreateCategory;
use App\Logic\V1\API\Categories\Admin\ShowCategories;
use App\Logic\V1\API\Categories\Admin\ShowCategory;
use App\Structs\CategoryStruct;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new ShowCategories;
        return response()->json([
            'data' => $data->run()
        ]);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:5',
        ]);
        
        if ($validate->fails()) {
            return response()->json([
                'errors' => $validate->errors()
            ]);
        }

        $struct = new CategoryStruct();
        $struct->name = $request['name'];

        $logic = new CreateCategory();
        $result = $logic->createCategory($struct);
        if (is_array($result) || !$result) {
            return response()->json([
                'message' => is_array($result)? $result: 'failed to save data'
            ], 422);
        }
        return response()->json([
            'message' => 'success'
        ]);
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'message' => 'invalid ID'
            ], 422);
        }
        
        $data = new ShowCategory(intval($id));
        return response()->json([
            'data' => $data->run()
        ]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'message' => 'invalid ID'
            ], 422);
        }

        $validate = Validator::make($request->all(), [
            'name' => 'required|min:5'
        ]);
        dd($validate->fails(), $validate->errors());
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
