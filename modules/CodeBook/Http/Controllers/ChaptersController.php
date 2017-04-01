<?php

namespace Modules\CodeBook\Http\Controllers;

use Illuminate\Http\Request;
use Modules\CodeBook\Criteria\FindByBookCriteria;
use Modules\CodeBook\Criteria\OrderByOrderCriteria;
use Modules\CodeBook\Http\Requests\ChapterRequest;
use Modules\CodeBook\Models\Book;
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
     * ChaptersController constructor.
     *
     * @param ChapterRepository $chapterRepository
     */
    public function __construct(ChapterRepository $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="Ver listagem de capítulos")
     *
     * @param Request $request
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param $bookId
     */
    public function index(Request $request, Book $book)
    {
        $search = $request->get('search');
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($book->id));
        $this->chapterRepository->pushCriteria(new OrderByOrderCriteria());
        $chapters = $this->chapterRepository->paginate(10);

        return view('codebook::chapters.index', compact('book', 'chapters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Criar capítulos")
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param $bookId
     */
    public function create(Book $book)
    {
        return view('codebook::chapters.form', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Criar capítulos")
     *
     * @param ChapterRequest $request
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function store(ChapterRequest $request, Book $book)
    {
        $data = $request->all();
        $data['book_id'] = $book->id;
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($book->id));
        $this->chapterRepository->create($data);

        return redirect()->to($request->get('_previous'))->with('success', 'Capítulo cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     * @Permission\Action(name="list", description="Ver listagem de capítulos")
     *
     * @param Book $book
     * @param $chapterId
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, $chapterId)
    {
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($book->id));
        $chapter = $this->chapterRepository->find($chapterId);

        return view('codebook::chapters.show', compact('book', 'chapter'));
    }

    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar capítulos")
     *
     * @param Book $book
     * @param integer $chapterId
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, $chapterId)
    {
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($book->id));
        $chapter = $this->chapterRepository->find($chapterId);

        return view('codebook::chapters.form', compact('book', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar capítulos")
     *
     * @param ChapterRequest $request
     * @param Book $book
     * @param $chapterId
     * @return \Illuminate\Http\Response
     */
    public function update(ChapterRequest $request, Book $book, $chapterId)
    {
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($book->id));
        $this->chapterRepository->update($request->except('book_id'), $chapterId);

        return redirect()->to($request->get('_previous'))->with('success', 'Capítulo alterado com sucesso . ');
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir capítulos")
     *
     * @param Request $request
     * @param Book $book
     * @param $chapterId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Book $book, $chapterId)
    {
        $this->chapterRepository->pushCriteria(new FindByBookCriteria($book->id));
        $this->chapterRepository->delete($chapterId);

        return redirect()->to($request->get('_previous'))->with('success', 'Capítulo excluído com sucesso');
    }
}
