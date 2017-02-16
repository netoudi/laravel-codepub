<?php

namespace Modules\CodeBook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\CodeBook\Criteria\FindBooksAuthorCriteria;
use Modules\CodeBook\Http\Requests\BookRequest;
use Modules\CodeBook\Models\Book;
use Modules\CodeBook\Repositories\BookRepository;
use Modules\CodeBook\Repositories\CategoryRepository;
use Modules\CodeUser\Annotations\Mapping as Permission;

/**
 * Class BooksController
 * @Permission\Controller(name="codebook-books", description="Administração de livros")
 *
 * @package Modules\CodeBook\Http\Controllers
 */
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
     * @Permission\Action(name="list", description="Ver listagem de livros")
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
        $books = $this->bookRepository->paginate(10);

        return view('codebook::books.index', compact('books', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Criar livros")
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
     * @Permission\Action(name="store", description="Criar livros")
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
     * @Permission\Action(name="list", description="Ver listagem de livros")
     *
     * @param integer $bookId
     * @return \Illuminate\Http\Response
     */
    public function show($bookId)
    {
        $book = $this->checkPermission($bookId, 'update');

        return view('codebook::books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar livros")
     *
     * @param integer $bookId
     * @return \Illuminate\Http\Response
     */
    public function edit($bookId)
    {
        $book = $this->checkPermission($bookId, 'update');

        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id');

        return view('codebook::books.form', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar livros")
     *
     * @param BookRequest $request
     * @param integer $bookId
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $bookId)
    {
        $this->checkPermission($bookId, 'update');

        $this->bookRepository->update($request->all(), $bookId);

        return redirect()->to($request->get('_previous'))->with('success', 'Livro alterado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir livros")
     *
     * @param Request $request
     * @param integer $bookId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $bookId)
    {
        $this->checkPermission($bookId, 'delete');

        $this->bookRepository->delete($bookId);

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
        $book = $this->bookRepository->find($bookId);

        if (\Auth::user()->cannot($ability, $book)) {
            throw new AuthorizationException('Usuário não autorizado');
        }

        return $book;
    }
}
