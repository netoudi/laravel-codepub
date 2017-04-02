<?php

namespace Modules\CodeBook\Faker;

use Faker\Provider\Base;

class ChapterFakerProvider extends Base
{
    public function markdown($numSubTitle = 1)
    {
        $title = $this->generator->sentence(3);
        $contents = [];

        foreach (range(1, $numSubTitle) as $value) {
            $contents[] = [
                'subtitle' => $this->generator->sentence(2),
                'content' => $this->generator->paragraph(10),
            ];
        }

        return view('codebook::faker.chapter', compact('title', 'contents'));
    }
}