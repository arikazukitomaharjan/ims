<?php

namespace App\Http\Controllers\Category;

use App\Http\Requests\CreateCategoryRequest;
use App\Repository\CategoryRepository as Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    /**
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Category $category)
    {
        // Temporarily increase memory limit to 256MB
        ini_set('memory_limit', '-1');
        $categories = $category->show();
        return response()->json(['data' => $categories]);
    }

    /**
     * @param Category $category
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Category $category, CreateCategoryRequest $request)
    {

        $categories = $category->add($request->all());
        /*$msg = Session::flash('message', 'Category has been Successfully added.');
        $flashShow = Session::flash('flash_type', 'alert-success');*/
        $msg="Category has been Successfully added.";


        return response()->json(['data' => $categories, 'msg' => $msg]);
    }

    public function update($id, Category $category, CreateCategoryRequest $request)
    {

        //$data=$request->all();
//        $categories = $category->find($id)->($request->all());
        $categories = $category->edit($id, $request->all());
        $msg="Category has been Successfully updated.";

        return response()->json(['data' => $categories,'msg'=>$msg]);
    }

    public function delete($id, Category $category, CreateCategoryRequest $request)
    {

        $categories = $category->remove($id);

        return response()->json(['data' => $categories, 'msg' => 'successfully deleted', 'id' => $id]);
    }
}
