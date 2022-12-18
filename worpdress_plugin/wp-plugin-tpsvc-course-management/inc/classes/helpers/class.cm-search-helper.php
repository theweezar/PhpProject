<?php

class CM_Search_Helper {

    /**
     * Analyze key words to return posible phrases that could match course id, name
     * 
     * @param string $key_word Search key word
     * @return array The posible phrases
     */
    public static function analyze_key_word($key_word = '') {
        $trim_phrase = trim($key_word);

        if (strlen($trim_phrase) === 0) return array($key_word);

        $posible_phrases = array($trim_phrase);

        $remove_middle_space_key_word = preg_replace('/\s+/', ' ', $trim_phrase);

        array_push($posible_phrases, preg_replace('/\s+/', '-', $trim_phrase));

        array_push($posible_phrases, $remove_middle_space_key_word);

        // Split the key word by space
        $split_by_space = explode(' ', $remove_middle_space_key_word);
        $posible_phrases = array_merge($posible_phrases, $split_by_space);

        // Split the key word by character -
        $split_by_bar = explode('-', $remove_middle_space_key_word);
        $posible_phrases = array_merge($posible_phrases, $split_by_bar);

        // Remove duplicate phrases
        $posible_phrases = array_unique($posible_phrases);
        
        return $posible_phrases;
    }
}