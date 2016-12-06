<?php

namespace CodePub\Http\Controllers;

use CodePub\Http\Requests\BookRequest;
use CodePub\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /**
     * @var Book
     */
    private $book;

    /**
     * BooksController constructor.
     *
     * @param \CodePub\Models\Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->book->query()->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.form');
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
        $this->book->create($data);

        return redirect()->to($request->get('_previous'))->with('success', 'Livro cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param \CodePub\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.form', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param \CodePub\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $book->fill($request->all())->save();

        return redirect()->to($request->get('_previous'))->with('success', 'Livro alterado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param \CodePub\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Book $book)
    {
        $book->delete();

        return redirect()->to($request->get('_previous'))->with('success', 'Livro excluído com sucesso');
    }
}
