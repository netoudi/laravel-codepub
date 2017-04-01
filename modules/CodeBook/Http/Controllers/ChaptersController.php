<?php

namespace Modules\CodeBook\Http\Controllers;

use Illuminate\Http\Request;
use Modules\CodeBook\Criteria\FindByAuthorCriteria;
use Modules\CodeBook\Criteria\FindByBookCriteria;
use Modules\CodeBook\Http\Requests\ChapterRequest;
use Modules\CodeBook\Repositories\BookRepository;
use Modules\CodeBook\Repositories\ChapterRepository;
use Modules\CodeUser\Annotations\Mapping as Permission;

/**
 * Class ChaptersController
 * @Permission\Controller(name="codebook-chapters", description="Administração de capítulos")
 *
 * @package Modules\CodeBook\Http\Controllers
 */
class ChaptersController extends Controller
{
    /**
     * @var ChapterRepository
     */
    private $chapterRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * ChaptersController constructor.
     *
     * @param ChapterRepository $chapterRepository
     * @param BookRepository $bookRepository
     */
    public function __construct(ChapterRepository $chapterRepository, BookRepository $bookRepository)
    {
        $this->chapterRepository = $chapterRepository;
        $this->bookRepository = $bookRepository;
        $this->bookRepository->pushCriteria(new FindByAuthorCriteria());
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="Ver listagem de capítulos")
     *
     * @param Request $request
     * @param $bookId
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $bookId)
    {
        $book = $this->bookRepository->find($bookId);
        $search = $request->get('search');
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($bookId));
        $chapters = $this->chapterRepository->paginate(10);

        return view('codebook::chapters.index', compact('book', 'chapters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Criar capítulos")
     *
     * @param $bookId
     * @return \Illuminate\Http\Response
     */
    public function create($bookId)
    {
        $book = $this->bookRepository->find($bookId);

        return view('codebook::chapters.form', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Criar capítulos")
     *
     * @param ChapterRequest $request
     * @param $bookId
     * @return \Illuminate\Http\Response
     */
    public function store(ChapterRequest $request, $bookId)
    {
        $book = $this->bookRepository->find($bookId);
        $data = $request->all();
        $data['book_id'] = $book->id;
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($bookId));
        $this->chapterRepository->create($data);

        return redirect()->to($request->get('_previous'))->with('success', 'Capítulo cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     * @Permission\Action(name="list", description="Ver listagem de capítulos")
     *
     * @param integer $bookId
     * @param $chapterId
     * @return \Illuminate\Http\Response
     */
    public function show($bookId, $chapterId)
    {
        $book = $this->bookRepository->find($bookId);
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($bookId));
        $chapter = $this->chapterRepository->find($chapterId);

        return view('codebook::chapters.show', compact('book', 'chapter'));
    }

    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar capítulos")
     *
     * @param integer $bookId
     * @param integer $chapterId
     * @return \Illuminate\Http\Response
     */
    public function edit($bookId, $chapterId)
    {
        $book = $this->bookRepository->find($bookId);
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($bookId));
        $chapter = $this->chapterRepository->find($chapterId);

        return view('codebook::chapters.form', compact('book', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar capítulos")
     *
     * @param ChapterRequest $request
     * @param integer $bookId
     * @param $chapterId
     * @return \Illuminate\Http\Response
     */
    public function update(ChapterRequest $request, $bookId, $chapterId)
    {
        $book = $this->bookRepository->find($bookId);
        $data = $request->all();
        $data['book_id'] = $book->id;
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($bookId));
        $this->chapterRepository->update($data, $chapterId);

        return redirect()->to($request->get('_previous'))->with('success', 'Capítulo alterado com sucesso . ');
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir capítulos")
     *
     * @param Request $request
     * @param integer $bookId
     * @param $chapterId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $bookId, $chapterId)
    {
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($bookId));
        $this->chapterRepository->delete($chapterId);

        return redirect()->to($request->get('_previous'))->with('success', 'Capítulo excluído com sucesso');
    }
}
