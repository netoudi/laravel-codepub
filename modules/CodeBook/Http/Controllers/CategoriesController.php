<?php

namespace Modules\CodeBook\Http\Controllers;

use Illuminate\Http\Request;
use Modules\CodeBook\Http\Requests\CategoryRequest;
use Modules\CodeBook\Models\Category;
use Modules\CodeBook\Repositories\CategoryRepository;

class CategoriesController extends Controller
{
    /**
     * @var \Modules\CodeBook\Repositories\CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoriesController constructor.
     *
     * @param \Modules\CodeBook\Repositories\CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = $this->categoryRepository->paginate(10);

        return view('codebook::categories.index', compact('categories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codebook::categories.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->create($request->all());

        return redirect()->to($request->get('_previous'))->with('success', 'Categoria cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('codebook::categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Modules\CodeBook\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('codebook::categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->all())->save();

        return redirect()->to($request->get('_previous'))->with('success', 'Categoria alterada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param \Modules\CodeBook\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        return redirect()->to($request->get('_previous'))->with('success', 'Categoria excluída com sucesso');
    }
}
