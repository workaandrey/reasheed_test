<?php


namespace App\Services;


class PdfReader
{
    public function readFile(string $path): PdfReader
    {
        //do something
        return $this;
    }

    public function hasText(string $term):bool
    {
        return (bool) rand(0, 1);
    }
}
