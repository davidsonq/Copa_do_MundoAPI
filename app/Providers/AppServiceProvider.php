<?php

namespace App\Providers;

use DateTime;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\NegativeTitleException;
use App\Exceptions\InvalidYearCupException;
use App\Exceptions\ImpossibleTitlesException;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Validator::extend('non_negative', function ($attribute, $value, $parameters, $validator) {
            
            if($value < 0){
                throw new NegativeTitleException($value);
            }else{
                return true;
            }
            
        });

        Validator::extend('invalid_year', function ($attribute, $value, $parameters, $validator) {
            $firstCup = $validator->getData()['first_cup'];
            $formatYear = DateTime::createFromFormat('Y-m-d', $firstCup)->format('Y');

        $formatYearCup = (ceil(($formatYear - 1930) / 4)) * 4 + 1930;

        if ($formatYear < 1930 || $formatYear != $formatYearCup) {
            throw new InvalidYearCupException();
        }else{
            return true;
        } 
        });

        Validator::extend('impossible_titles', function ($attribute, $value, $parameters, $validator) {
            $titles = $validator->getData()['titles'];
            $firstCup = $validator->getData()['first_cup'];

            $formatYear = DateTime::createFromFormat('Y-m-d', $firstCup)->format('Y');

            $dateYearNow = (int) date('Y');

            $titlesIsValidate = ($titles * 4) + $formatYear;
            if ($dateYearNow < $titlesIsValidate) {
                throw new ImpossibleTitlesException();
            }else{
                return true;
            }
        });
    }
}
