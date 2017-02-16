<?php

namespace Modules\CodeBook\Http\Controllers;

use Illuminate\Http\Request;
use Modules\CodeBook\Repositories\BookRepository;
use Modules\CodeUser\Annotations\Mapping as Permission;

/**
 * Class BooksTrashedController
 * @Permission\Controller(name="codebook-books-trashed", description="Administração de livros na lixeira")
 *
 * @package Modules\CodeBook\Http\Controllers
 */
class BooksTrashedController extends Controller
{
    /**
     * @var \Modules\CodeBook\Repositories\BookRepository
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
     * @Permission\Action(name="list", description="Ver listagem de livros na lixeira")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->bookRepository->onlyTrashed()->paginate(10);

        return view('codebook::trashed.books.index', compact('books', 'search'));
    }

    /**
     * Display the specified resource.
     * @Permission\Action(name="list", description="Ver listagem de livros na lixeira")
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->bookRepository->onlyTrashed()->find($id);

        return view('codebook::trashed.books.show', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar livros na lixeira")
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
     * @Permission\Action(name="destroy", description="Excluir livros na lixeira")
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
