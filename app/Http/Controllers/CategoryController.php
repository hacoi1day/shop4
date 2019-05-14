<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryGlobal;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    protected $categoryGlobal;

    /**
     * CategoryController constructor.
     * @param Category $category
     * @param CategoryGlobal $categoryGlobal
     */
    public function __construct(Category $category, CategoryGlobal $categoryGlobal)
    {
        $this->category = $category;
        $this->categoryGlobal = $categoryGlobal;
    }

    /**
     * @param Request $request
     * @param $shop_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $shop_id)
    {
        $this->validate($request, [
            'category_name' => 'required|min:4'
        ], [
            'category_name.required' => 'Tên danh mục chưa được điền',
            'category_name.min' => 'Tên danh mục quá ngắn',
        ]);
        $params = $request->all();
        $category_name = $params['category_name'];
        $category_name_u = changeTitle($category_name);
        $category_globals = $params['category_globals'];

        $category = $this->category->create([
            'category_name' => $category_name,
            'category_name_u' => $category_name_u,
            'shop_id' => $shop_id
        ]);
        if(count($category_globals) > 0)
            $category->categoryglobals()->attach($category_globals);
        if($category) {
            return redirect()->route('seller.category');
        } else {
            echo 'Fail';
        }
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categoryGloals = $this->categoryGlobal->all();
        $category = $this->category->find($id);
        return view('category.edit', ['categoryGloals' => $categoryGloals, 'category' => $category]);
    }
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_name' => 'required|min:4'
        ], [
            'category_name.required' => 'Tên danh mục chưa được điền',
            'category_name.min' => 'Tên danh mục quá ngắn',
        ]);
        $params = $request->all();
        $category_name = $params['category_name'];
        $category_name_u = changeTitle($category_name);
        $category_globals = $params['category_globals'];

        $category = $this->category->find($id);
        $category->update([
            'category_name' => $category_name,
            'category_name_u' => $category_name_u,
        ]);
        if(count($category_globals) > 0)
            $category->categoryglobals()->sync($category_globals);
        if($category) {
            return redirect()->route('seller.category');
        } else {
            echo abort(404);
        }
    }
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $category = $this->category->find($id);
        $category->delete();
        $category->categoryglobals()->detach();
        $category->products()->detach();
        if($category)
        {
            return redirect()->route('seller.category');
        }
        else
        {
            echo abort(404);
        }
    }
    /**
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProductOfCategory($name)
    {
        $category = $this->category->where('category_name_u', $name)->first();

        return view('home.category', ['category' => $category]);
    }

    // ------------------------------------------------------------------

    public function adminCategoryList()
    {
        $cateogries = $this->category->paginate(15);
        return view('admin2.category.list', ['categories' => $cateogries]);
    }

    public function adminCategoryEdit($id)
    {
        $categoryGloals = $this->categoryGlobal->all();
        $category = $this->category->find($id);
        return view('admin2.category.edit', ['categoryGloals' => $categoryGloals, 'category' => $category]);
    }
    public function adminCategoryUpdate(Request $request, $id)
    {
        $params = $request->all();
        $category_name = $params['category_name'];
        $category_name_u = changeTitle($category_name);
        $category_globals = $params['category_globals'];

        $category = $this->category->find($id);
        $category->update([
            'category_name' => $category_name,
            'category_name_u' => $category_name_u,
        ]);
        if(count($category_globals) > 0)
            $category->categoryglobals()->sync($category_globals);
        if($category) {
            return redirect()->route('admin.category.list');
        } else {
            return abort(404);
        }
    }

    public function adminCategoryDelete($id)
    {
        $category = $this->category->find($id);
        $category->delete();
        $category->categoryglobals()->detach();
        $category->products()->detach();
        if($category)
        {
            return redirect()->route('admin.category.list');
        }
        else
        {
            return abort(404);
        }
    }
}
