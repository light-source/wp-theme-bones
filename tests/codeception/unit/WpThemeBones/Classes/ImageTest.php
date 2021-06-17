<?php

declare( strict_types=1 );

namespace WpThemeBones\Classes;

use Codeception\Test\Unit;

class ImageTest extends Unit {

	//////// methods

	public function testImageSizes() {

		$sizes = Image::filterImageSizes( [
			'1536x1536',
			'2048x2048',
			'medium_large',
			'100x100',
		] );

		$this->assertEquals( [ '100x100', ], array_values( $sizes ) );

	}

}
