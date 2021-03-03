<?php

namespace App\Helpers;

class Text
{
    
    /**
     * Return extract of a content
     *
     * @param  mixed $content to extract sentence
     * @param  mixed $limit number of character to extract
     * @return void
     */
    public static function excerpt(string $content, int $limit = 60): string
    {
        // mb_str for unicode
        if (mb_strlen($content) <= $limit) {
            return $content;
        }
        // search first space from $limit
        $space = mb_strpos($content, ' ', $limit);
        return mb_substr($content, 0, $space) . '...';
        
    }
}
