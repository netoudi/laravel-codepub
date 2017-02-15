<?php

namespace Modules\CodeBook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\CodeBook\Http\Requests\BookRequest;
use Modules\CodeBook\Models\Book;
use Modules\CodeBook\Repositories\BookRepository;
use Modules\CodeBook\Repositories\CategoryRepository;

class BooksController extends Controller
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * BooksController constructor.
     *
     * @param BookRepository $bookRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(BookRepository $bookRepository, CategoryRepository $categoryRepository)
    {
        $this->bookRepository = $bookRepository;
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
        $books = $this->bookRepository->paginate(10);

        return view('codebook::books.index', compact('books', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');

        return view('codebook::books.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $this->bookRepository->create($data);

        return redirect()->to($request->get('_previous'))->with('success', 'Livro cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param \Modules\CodeBook\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('codebook::books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Modules\CodeBook\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id');

        return view('codebook::books.form', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param \Modules\CodeBook\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $this->bookRepository->update($request->all(), $book->id);

        return redirect()->to($request->get('_previous'))->with('success', 'Livro alterado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BookRequest $request
     * @param \Modules\CodeBook\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookRequest $request, Book $book)
    {
        $book->delete();

        return redirect()->to($request->get('_previous'))->with('success', 'Livro excluído com sucesso');
    }
}
