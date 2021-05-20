<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

use Codeception\TestCase\WPTestCase;
use Error;

class BlockTest extends WPTestCase
{

    //////// methods

    public function testTwigTemplates()
    {
        $renderer = Fb::Instance()->getRenderer();
        $renderer->getBlocksLoader()->loadAllBlocks();
        $blockClasses = $renderer->getBlocksLoader()->getLoadedBlockClasses();

        foreach ($blockClasses as $blockClass) {
            if (! is_subclass_of($blockClass, Block::class)) {
                $this->fail('The blocks list is wrong');
            }

            try {
                $block = new $blockClass();
            } catch (Error $ex) {
                $this->fail('The block constructor is wrong : ' . $blockClass);
            }

            // for IDE
            if (! is_subclass_of($block, Block::class) ) {
                continue;
            }

            $this->assertNotEmpty($renderer->render($block), 'Wrong block is ' . $blockClass);
        }
    }

}
