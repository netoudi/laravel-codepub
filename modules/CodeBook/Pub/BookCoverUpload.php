<?php

namespace Modules\CodeBook\Pub;

use Illuminate\Http\UploadedFile;
use Imagine\Image\Box;
use Modules\CodeBook\Models\Book;

class BookCoverUpload
{
    public function upload(Book $book, UploadedFile $cover)
    {
        \Storage::disk(config('codebook.book_storage'))
                ->putFileAs($book->ebook_template, $cover, $book->cover_ebook_name);

        $this->makeCoverPdf($book);
        $this->makeCoverKindle($book);
        $this->makeThumbnail($book);
    }

    protected function makeCoverPdf(Book $book)
    {
        if (!is_dir($book->pdf_template_storage)) {
            mkdir($book->pdf_template_storage, 0775, true);
        }

        $img = new \Imagick($book->cover_ebook_file);
        $img->setImageFormat('pdf');
        $img->writeImage($book->cover_pdf_file);
    }

    protected function makeCoverKindle(Book $book)
    {
        if (!is_dir($book->kindle_template_storage)) {
            mkdir($book->kindle_template_storage, 0775, true);
        }

        copy($book->cover_ebook_file, $book->cover_kindle_file);
    }

    protected function makeThumbnail(Book $book)
    {
        if (!is_dir($book->thumbs_storage)) {
            mkdir($book->thumbs_storage, 0775, true);
        }

        $coverEbookFile = $book->cover_ebook_file;

        $thumbnail = \Image::open($coverEbookFile)->thumbnail(new Box(356, 522));
        $thumbnail->save($book->thumbnail_file);

        $thumbnailSmall = \Image::open($coverEbookFile)->thumbnail(new Box(138, 230));
        $thumbnailSmall->save($book->thumbnail_small_file);
    }
}