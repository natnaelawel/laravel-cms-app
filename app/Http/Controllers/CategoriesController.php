<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Categories\UpdateCategoriesRequest;
use App\Http\Requests\Categories\CreateCategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     // to automatically create this method use --resource when creating this controller
     // like - php artisan make:controller CategoriesController --resource
     //
    public function index()
    {
        //
        return view('categories.index')->with('categories',Category::all() );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // by using the request object we can validate there

        // $this->validate($request, [
        //     'name'=> 'required|unique:categories'
        // ]);



        // with out creating an instance of model class
        // we can also store using a static method called create
        // inorder to do that the model class must have
        // a property called fillable
        Category::create([
            'name' => $request->name
        ]);

        // session()->flash('success', 'Category added Successfully');
        session()->flash('success', 'Category created successfully.');

        // return redirect(route('categories.index'));
        return redirect(route('categories.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, Category $category)
    {
        // Category::where('id', $id)
        //         ->update($request->all());

        // $category->name = $request->name;
        // $category->save();

        $category->update([
            'name'=> $request->name
        ]);

        session()->flash('success', 'Category Updated successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->posts->count()> 0){
        session()->flash('error', 'Category Can\'t be deleted because have some posts.');
        return redirect()->back();
        }
        $category->delete();
        session()->flash('success', 'Category Deleted successfully.');

        return redirect(route('categories.index'));
    }
}
