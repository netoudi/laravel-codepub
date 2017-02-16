<?php

namespace Modules\CodeBook\Http\Controllers;

use Illuminate\Http\Request;
use Modules\CodeBook\Criteria\FindBooksAuthorCriteria;
use Modules\CodeBook\Models\Book;
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
        if (!\Auth::user()->isAdmin()) {
            $this->bookRepository->pushCriteria(new FindBooksAuthorCriteria());
        }

        $search = $request->get('search');
        $books = $this->bookRepository->onlyTrashed()->paginate(10);

        return view('codebook::trashed.books.index', compact('books', 'search'));
    }

    /**
     * Display the specified resource.
     * @Permission\Action(name="list", description="Ver listagem de livros na lixeira")
     *
     * @param $bookId
     * @return \Illuminate\Http\Response
     */
    public function show($bookId)
    {
        $this->checkPermission($bookId, 'view');

        $book = $this->bookRepository->onlyTrashed()->find($bookId);

        return view('codebook::trashed.books.show', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar livros na lixeira")
     *
     * @param Request $request
     * @param $bookId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bookId)
    {
        $this->checkPermission($bookId, 'update');

        $this->bookRepository->onlyTrashed()->restore($bookId);

        return redirect()->to($request->get('_previous'))->with('success', 'Livro restaurado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir livros na lixeira")
     *
     * @param Request $request
     * @param $bookId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $bookId)
    {
        $this->checkPermission($bookId, 'delete');

        $book = $this->bookRepository->onlyTrashed()->find($bookId);
        $book->forceDelete();

        return redirect()->to($request->get('_previous'))->with('success', 'Livro excluído com sucesso');
    }

    /**
     * @param integer $bookId
     * @param string $ability | view, update, delete
     * @return Book
     * @throws AuthorizationException
     */
    private function checkPermission($bookId, $ability)
    {
        $book = $this->bookRepository->withTrashed()->find($bookId);

        if (\Auth::user()->cannot($ability, $book)) {
            throw new AuthorizationException('Usuário não autorizado');
        }

        return $book;
    }
}
