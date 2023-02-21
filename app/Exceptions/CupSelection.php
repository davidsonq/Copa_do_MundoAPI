<?php

class NegativeTitlesError extends Exception {
    public function __construct($message) {
        parent::__construct($message);
    }
}

class InvalidYearCupError extends Exception {
    public function __construct($message) {
        parent::__construct($message);
    }
}

class ImpossibleTitlesError extends Exception {
    public function __construct($message) {
        parent::__construct($message);
    }
}

function dataProcessing($cupSelection) {
    if ($cupSelection['titles'] < 0) {
        throw new NegativeTitlesError('titles cannot be negative');
    }

    $formatYear = DateTime::createFromFormat('Y-m-d', $cupSelection['first_cup'])->format('Y');
    $formatYearCup = (ceil(($formatYear - 1930) / 4)) * 4 + 1930;

    if ($formatYear < 1930 || $formatYear != $formatYearCup) {
        throw new InvalidYearCupError('there was no world cup this year');
    }

    $dateYearNow = (int) date('Y');
    $titlesIsValidate = ($cupSelection['titles'] * 4) + $formatYear;

    if ($dateYearNow < $titlesIsValidate) {
        $error = 'impossible to have more titles than disputed cups';
        throw new ImpossibleTitlesError($error);
    }

    return $cupSelection;
}
