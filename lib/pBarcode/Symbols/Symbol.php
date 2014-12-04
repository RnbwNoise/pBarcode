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
     * A barcode symbol.
     * @copyright 2014 Vladimir P.
     * @license MIT
     */
	abstract class Symbol {
        /**
         * Text to be encoded in the barcode.
         * @var string
         */
		protected $text = '';
		
        /**
         * Sets text to be encoded in the barcode. Characters that are not supported by a symbology may be removed.
         * @param string $text
         * @return void
         */
		public function setText($text) {
			$this->text = self::removeNonASCIICharacters($text);
		}
		
        /**
         * Returns text that will be actually encoded in the barcode.
         * @return string
         */
		final public function getText() {
			return $this->text;
		}
		
        /**
         * Returns an Image containing the barcode.
         * @return Image
         */
		abstract public function getImage();
		
        /**
         * Removes all characters except the ones considered to be valid from a string.
         * @param string $string String to be processed.
         * @param string $validCharacters String containing characters that should not be removed.
         * @return string
         */
		final protected static function removeInvalidCharacters($string, $validCharacters) {
			$finalString = '';
			for($i = 0, $length = strlen($string); $i < $length; ++$i)
				if(strpos($validCharacters, $string[$i]) !== false)
					$finalString .= $string[$i];
			return $finalString;
		}
		
        /**
         * Removes all characters that are not in ASCII from a string.
         * @param string $string String to be processed.
         * @return string
         */
		final protected static function removeNonASCIICharacters($string) {
			$finalString = '';
			for($i = 0, $length = strlen($string); $i < $length; ++$i)
				if(ord($string[$i]) <= 127)
					$finalString .= $string[$i];
			return $finalString;
		}
	}