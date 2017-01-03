<?php

namespace CodePub\Http\Controllers;

use CodePub\Repositories\BookRepository;
use Illuminate\Http\Request;

class BooksTrashedController extends Controller
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * BooksTrashedController constructor.
     *
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
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
        $books = $this->bookRepository->onlyTrashed()->paginate(10);

        return view('trashed.books.index', compact('books', 'search'));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->bookRepository->onlyTrashed()->find($id);

        return view('trashed.books.show', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->bookRepository->onlyTrashed()->restore($id);

        return redirect()->to($request->get('_previous'))->with('success', 'Livro restaurado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $book = $this->bookRepository->onlyTrashed()->find($id);
        $book->forceDelete();

        return redirect()->to($request->get('_previous'))->with('success', 'Livro excluído com sucesso');
    }
}
