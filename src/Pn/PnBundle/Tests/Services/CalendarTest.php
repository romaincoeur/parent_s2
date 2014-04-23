<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 22/04/14
 * Time: 16:07
 */

// src/Pn/PnBundle/Tests/Services/CalendarTest.php

namespace Pn\PnBundle\Tests\Services;
use Pn\PnBundle\Services\Calendar;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testGetMatrix()
    {
        $example1 = "[(1000000)(1000000)(1000000)(1000000)(1000000)(1100000)(1100000)(1100000)(1000000)(1000000)(1000000)
        (1000000)(1000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)]";
        $example2 = "[(0000010)(0000010)(0000010)(0000010)(0000010)(1000000)(1000000)(1000000)(0100000)(0100000)(0100000)
        (0000000)(0000000)(0010000)(0010000)(0010000)(0000000)(0000000)(0001000)(0001000)(0001000)(0000100)(0000100)(0000100)]";
        $example3 = "[(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0100000)(0100000)(0100000)
        (0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)]";

        $mat1 = Calendar::getMatrix($example1);
        $mat2 = Calendar::getMatrix($example2);

        $this->assertEquals($mat1[1][1],1);
        $this->assertEquals($mat1[1][2],0);
        $this->assertEquals($mat1[2][1],1);
        $this->assertEquals($mat1[3][1],1);
        $this->assertEquals($mat1[6][2],1);
        $this->assertEquals($mat1[6][3],0);

        $this->assertEquals($mat2[1][1],0);
        $this->assertEquals($mat2[1][6],1);
        $this->assertEquals($mat2[2][3],0);
        $this->assertEquals($mat2[2][6],1);
        $this->assertEquals($mat2[6][1],1);
        $this->assertEquals($mat2[6][2],0);
    }


    /**
     * An empty calendar is a 24*7 matrix.
     */
    public function testNewMatrix()
    {
        $emptyCalendar = array_fill(1, 24 ,array_fill(1, 7, false));
        $newMat = Calendar::newMatrix();
        $this->assertEquals($newMat, $emptyCalendar);
        for ($i=1;$i<=24;$i++)
        {
            for ($j=1;$j<=7;$j++)
            {
                $this->assertEquals($newMat[$i][$j], 0);
            }
        }
    }

    /**
     *
     */
    public function testGetString()
    {
        $mat1 = array_fill(1, 24 ,array_fill(1, 7, false));
        $mat1[1][1] = 1;
        $mat1[2][1] = 1;
        $mat1[3][1] = 1;
        $mat1[4][1] = 1;
        $mat1[5][1] = 1;
        $mat1[6][1] = 1;
        $mat1[6][2] = 1;
        $mat1[7][1] = 1;
        $mat1[7][2] = 1;

        $mat2 = array_fill(1, 24 ,array_fill(1, 7, false));
        $mat2[1][6] = 1;
        $mat2[2][6] = 1;
        $mat2[3][6] = 1;
        $mat2[4][6] = 1;
        $mat2[5][6] = 1;
        $mat2[6][1] = 1;
        $mat2[7][1] = 1;
        $mat2[9][2] = 1;

        $example1 = "[(1000000)(1000000)(1000000)(1000000)(1000000)(1100000)(1100000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)]";
        $example2 = "[(0000010)(0000010)(0000010)(0000010)(0000010)(1000000)(1000000)(0000000)(0100000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)]";
        $this->assertEquals(Calendar::getString($mat1),$example1);
        $this->assertEquals(Calendar::getString($mat2),$example2);
    }
}
