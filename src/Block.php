<?php

namespace ChordPro;

class Block {
    private $chord;
    private $text;

    private $french_chords = array(
        'A' => 'La',
        'B' => 'Si',
        'C' => 'Do',
        'D' => 'Ré',
        'E' => 'Mi',
        'F' => 'Fa',
        'G' => 'Sol'
    );

    private function englishNotation($chord)
    {
        if (in_array(substr(strtolower($chord),0,2),['la','si','do','ré','re','mi','fa','so'])) {
            return str_replace(['la','si','do','ré','re','mi','fa','sol'],['A','B','C','D','D','E','F','G'],strtolower($chord));
        }
        else {
            return $chord;
        }
    }

    public function __construct($chord,$text)
    {
        $this->chord = $chord;
        $this->text = $text;
    }

    // getFrenchChord & getChord return an array (when with fundamental "/"), composed by an array with note, and alteration
    public function getFrenchChord()
    {
        $result = [];
        $chords = explode('/',$this->chord);
        foreach ($chords as $chord) {
            if (!$chord) break;
            $result[] = [$this->french_chords[substr($chord,0,1)],substr($chord,1)];
        }
        return $result;
    }
    public function getChord()
    {
        if (null !== $this->chord) {
            $chords = explode('/',$this->englishNotation($this->chord));
            foreach ($chords as $chord) {
                // Convert flat symbols in the second part of the chord (everything after 'B' in 'Bbm')
                // so that chords such as 'B♭' are transposed correctly.
                $secondPart = substr($chord, 1);
                $secondPart = str_replace('♭', 'b', $secondPart);

                $result[] = [substr($chord,0,1),$secondPart];
            }
            return $result;
        }
    }

    public function getText()
    {
        return $this->text;
    }

    public function setChord($newchord)
    {
        $this->chord = $newchord;
    }
}
