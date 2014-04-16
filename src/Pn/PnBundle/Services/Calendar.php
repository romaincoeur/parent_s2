<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 04/04/14
 * Time: 09:58
 */

// src/Pn/PnBundle/Services/Calendar.php

namespace Pn\PnBundle\Services;

class Calendar
{
    /**
     * Transforme une chaine de caractere en matrice pour les objets utilisants
     * les calendriers
     *
     * @param string $calendar
     */
    public function getMatrix($calendarText)
    {
        $calendarStr = str_split($calendarText,1);

        $calendar = array_fill(1, 24 ,array_fill(1, 7, false));

        $i = 1;
        $j = 1;
        foreach ($calendarStr as &$c)
        {
            if ($c == ')')
            {
                $j = 1;
                $i++;
                continue;
            }
            if ($c == '0')
            {
                $j++;
            }
            if ($c == '1')
            {
                $calendar[$i][$j] = true;
                $j++;
            }
        }

        return $calendar;
    }

    public function newMatrix()
    {
        return array_fill(1, 24 ,array_fill(1, 7, false));
    }

    public function getString($calendarMatrix)
    {
        $calendar = '[(';

        foreach ($calendarMatrix as &$tab)
        {
            foreach ($tab as &$case)
            {
                if ($case)
                    $calendar = $calendar.'1';
                else
                    $calendar = $calendar.'0';
            }
            $calendar = $calendar.')(';

        }
        $calendar = rtrim($calendar,'(').']';
        return $calendar;
    }

    public function newString()
    {
        return '[(0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)
        (0000000)]';
    }
}