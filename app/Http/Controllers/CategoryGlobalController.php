<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryGlobal;
use Illuminate\Http\Request;

class CategoryGlobalController extends Controller
{
    protected $categoryGlobal;
    protected $category;

    public function __construct(CategoryGlobal $categoryGlobal, Category $category)
    {
        $this->categoryGlobal = $categoryGlobal;
        $this->category = $category;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categoryGlobals = $this->categoryGlobal->orderBy('category_global_name', 'asc')->get();
        return view('admin2.cagory-global.list', ['categoryGlobals' => $categoryGlobals]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // validate
        $this->validate($request, [
            'category_global_name' => 'required|min:4'
        ]);
        $params = $request->all();
        $category_global_name = $params['category_global_name'];
        $category_global_name_u = changeTitle($category_global_name);

        $categoryGlobal = $this->categoryGlobal->create([
            'category_global_name' => $category_global_name,
            'category_global_name_u' => $category_global_name_u
        ]);
        if($categoryGlobal)
            return redirect()->back();
        else
            return abort(404);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categoryGlobal = $this->categoryGlobal->find($id);
        return view('admin2.cagory-global.edit', ['categoryGlobal' => $categoryGlobal]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        // validate
        $this->validate($request, [
            'category_global_name' => 'required|min:4'
        ]);
        $params = $request->all();
        $category_global_name = $params['category_global_name'];
        $category_global_name_u = changeTitle($category_global_name);

        $categoryGlobal = $this->categoryGlobal->find($id);
        $categoryGlobal->update([
            'category_global_name' => $category_global_name,
            'category_global_name_u' => $category_global_name_u
        ]);
        if($categoryGlobal)
            return redirect()->route('admin.category-global.list');
        else
            return abort(404);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $categoryGlobal = $this->categoryGlobal->find($id);
        $categoryGlobal->delete();
        return redirect()->route('admin.category-global.list');
    }

    public function getProductOfCategoryGlobal($name)
    {
        $categoryGlobal = $this->categoryGlobal->where('category_global_name_u', $name)->first();
        $categories = $categoryGlobal->categories;
        return view('home.category-global', ['categories' => $categories]);
    }
}
