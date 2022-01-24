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

class FileTest extends TestCase
{

    /**
     * @test
     */
    public function fileTest()
    {

        $body = file_get_contents(__DIR__ . "/inputs/styles/body.scss");
        $header = file_get_contents(__DIR__ . "/inputs/styles/header.scss");
        $index = file_get_contents(__DIR__ . "/inputs/styles/index.scss");

        // Router Object
        $file = new Compiler();

        $file->registerFiles(
            array(
                'body.scss' => $body ,
                'header.scss' => $header,
                'index.scss' => $index
            )
        );

        $css = $file->compileFile('index.scss')->getCss();

        $this->assertNotEmpty($css);


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
