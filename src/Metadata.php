<?php

namespace ChordPro;

class Metadata extends Line {
    private $label;
    private $name;
    private $value;

    public function __construct(string $name, ?string $value)
    {
        $this->name = $this->setName($name);
        $this->label = $this->setLabel($this->name);
        $this->value = $value;
    }

    public function getLabel()
    {
        return $this->label;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getValue()
    {
        return $this->value;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    private function setName($name)
    {
        if ($name === 't') {
            return 'title';
        }
        if ($name === 'st') {
            return 'subtitle';
        }
        if ($name === 'c') {
            return 'comment';
        }
        if ($name === 'ci') {
            return 'comment_italic';
        }
        if ($name === 'cb') {
            return 'comment_box';
        }
        if ($name === 'soc') {
            return 'start_of_chorus';
        }
        if ($name === 'eoc') {
            return 'end_of_chorus';
        }

        return $name;
    }

    private function setLabel($name)
    {
        $label = '';
        $predefinedNames = [
            'title',
            'subtitle',
            'comment',
            'comment_italic',
            'comment_box',
            'start_of_chorus',
            'end_of_chorus',
            'meta',
        ];
        if (
            !in_array($name, $predefinedNames)
            && strpos($name, 'start_of_') === false
            && strpos($name, 'end_of_') === false
        ) {
            $label = ucfirst($name) . ': ';
        }
        return $label;
    }
}
