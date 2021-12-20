<?php

/**
 * SCSSPHP
 *
 * @copyright 2012-2020 Leaf Corcoran
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link http://scssphp.github.io/scssphp
 */

namespace ScssPhp\ScssPhp\Tests;

use PHPUnit\Framework\TestCase;
use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\Logger\QuietLogger;

/**
 * Exception test
 *
 * @author Leaf Corcoran <leafot@gmail.com>
 */
class FileTest extends TestCase
{
    public static function fileTest(){

        $bodyTwig = file_get_contents("Input/styles/body.scss");
        $headerTwig = file_get_contents("Input/styles/header.scss");
        $indexTwig = file_get_contents("Input/styles/index.scss");

        // Router Object
        $file = new src\Compiler;

        $result = $file->registerFiles(
            array(
                'body.scss' => $bodyTwig , 
                'header.scss' => $headerTwig, 
                'index.scss' => $indexTwig
            )
        );

        $this->assertIsArray($result);

        // $expected = [
        //     'get' =>[
        //         'index.scss = $indexTwig',
        //         'body.scss = $bodyTwig',
        //         'header.scss = $headerTwig',
        //     ],
        // ];

        // // Assert the file
        // $this->assertEquals($result->importFile());

    }
}
