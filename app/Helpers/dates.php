<?php

if(!function_exists('getNameMouthsByYear'))
{
    function getNameMouthsByYear()
    {
        return [
            'Janeiro',
            'Feveiror',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro'
        ];
    }
}

if(!function_exists('getNameMouthsByNumber'))
{
    function getNameMouthsByNumber(string $number)
    {
        foreach(getNameMouthsByYear() as $index=>$month)
        {
            $numberMount = $index +1;
            if($number === $numberMount)
            {
                return $month;
            }
        }
    }
}


