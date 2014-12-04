<?php
    /**
     * pBarcode
     * Copyright (C) 2014 Vladimir P.
     * 
     * Permission is hereby granted, free of charge, to any person obtaining a copy
     * of this software and associated documentation files (the "Software"), to deal
     * in the Software without restriction, including without limitation the rights
     * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
     * copies of the Software, and to permit persons to whom the Software is
     * furnished to do so, subject to the following conditions:
     * 
     * The above copyright notice and this permission notice shall be included in
     * all copies or substantial portions of the Software.
     * 
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
     * THE SOFTWARE.
     */
	
	namespace pBarcode\Symbols;
    use pBarcode\Image as Image;
	
    /**
     * A Codabar symbol.
     * @copyright 2014 Vladimir P.
     * @license MIT
     */
	final class Codabar extends Symbol {
        /**
         * Width of a wide bar in terms of the width of a narrow bar.
         * @const int
         */
		const WIDE_BAR_WIDTH = 3;
        
        /**
         * Codabar encoding. 0 = narrow bar, 1 = wide bar.
         * @var string
         */
		private $encoding = array(
			'0' => '0000011', '1' => '0000110', '2' => '0001001', '3' => '1100000',
			'4' => '0010010', '5' => '1000010', '6' => '0100001', '7' => '0100100',
			'8' => '0110000', '9' => '1001000', '-' => '0001100', '$' => '0011000',
			':' => '1000101', '/' => '1010001', '+' => '0011111', '.' => '1010100',
			'A' => '0011010', 'B' => '0001011', 'C' => '0101001', 'D' => '0001110'
		);
		
        /**
         * Sets text to be encoded in the barcode. Characters that are not supported by Codabar will be removed.
         * @param string $text
         * @return void
         */
		public function setText($text) {
			$this->text = self::removeInvalidCharacters(strtoupper($text), '0123456789-$:/+.ABCD');
			
			// There should be no letters in the body of a barcode.
			for($i = 1, $textLength = strlen($this->text); $i < $textLength - 1; ++$i)
				if($this->text[$i] >= 'A' && $this->text[$i] <= 'D') {
					$this->text = substr($this->text, 0, $i) . substr($this->text, $i + 1);
					--$textLength;
					--$i;
				}
			
			// Barcode must begin and end with an letter.
			if($this->text[0] < 'A' || $this->text[0] > 'D') {
				$this->text = 'A' . $this->text;
				++$textLength;
			}
			if($this->text[$textLength - 1] < 'A' || $this->text[$textLength - 1] > 'D') {
				$this->text .= 'B';
				++$textLength;
			}
			
			// Barcode has to have at least 2 characters in the body.
			while(strlen($this->text) - 2 < 2) {
				$this->text = $this->text[0] . '0' . substr($this->text, 1);
				++$textLength;
			}
		}
		
        /**
         * Returns an Image containing the barcode.
         * @return Image
         */
		public function getImage() {
			if(strlen($this->text) === 0)
				return null;
			
			$code = array();
			for($i = 0, $textLength = strlen($this->text); $i < $textLength; ++$i) {
				assert(isset($this->encoding[$this->text[$i]]));
				$symbolCode = $this->encoding[$this->text[$i]];
				
				for($j = 0, $symbolCodeLength = strlen($symbolCode); $j < $symbolCodeLength; ++$j) {
					$barWidth = ($symbolCode[$j] === '0') ? 1 : self::WIDE_BAR_WIDTH;
					for($k = 0; $k < $barWidth; ++$k)
						$code[] = ($j % 2 === 0);
				}
				$code[] = 0;
			}
			$codeWidth = count($code);
			
			$image = new Image($codeWidth, 1);
			for($x = 0; $x < $codeWidth; ++$x)
				$image->setPixel($x, 0, $code[$x]);
			
			return $image;
		}
	}