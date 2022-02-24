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

if(!function_exists('complementDateByInterval'))
{
    function complementDateByInterval(string $dateStart,string $dateEnd)
    {
        $intervalDates = [$dateStart];
        $actualDate = $dateStart;
        while ($actualDate < $dateEnd) {
            $actualDate = date('Y-m-d', strtotime("+ 1 month", strtotime($actualDate)));
            $intervalDates[] = $actualDate;
        }
        return $intervalDates;
    }
}

if(!function_exists('complementDateByIntervalInIndex'))
{
    function complementDateByIntervalInIndex(string $dateStart,string $dateEnd)
    {
        $intervalDates[$dateStart] = [];
        $actualDate = $dateStart;
        while ($actualDate < $dateEnd) {
            $actualDate = date('Y-m-d', strtotime("+ 1 month", strtotime($actualDate)));
            $intervalDates[$actualDate] = [];
        }
        return $intervalDates;
    }
}

if(!function_exists('simpleDateRight'))
{
    function simpleDateRight()
    {
        return date('Y-m-d',strtotime('-3 hour'));
    }
}

