<?php

class BoobyTest extends PHPUnit_Framework_TestCase
{
    public function testFlash()
    {
        $msg = Booby\Flash::me('This is my awesome message!');
        $this->assertInstanceOf('Booby\Flash', $msg);
        foreach (Booby\Flash::each() as $msg) {
            $this->assertInstanceOf('Booby\Flash', $msg);
            echo "$msg";
        }
        $this->expectOutputString('This is my awesome message!');
        $i = 0;
        foreach (Booby\Flash::each() as $msg) {
            ++$i;
        }
        $this->assertEquals(0, $i);
    }
}

