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
	
    /**
     * A EAN 8 or 13 symbol.
     * @copyright 2014 Vladimir P.
     * @license MIT
     */
	final class EAN extends TCPDFLinearSymbol {
        /**
         * Sets text to be encoded in the barcode. All non-numeric characters will be removed. If the string is longer
         * than 12 digits, it will be truncated to have that length. If the string does not have enough digits to make
         * a valid EAN barcode, zeros will be added in front of it to get the right length.
         * @param string $text
         * @return void
         */
		public function setText($text) {
			$this->text = self::removeInvalidCharacters($text, '0123456789');
			$this->text = substr($this->text, 0, 12);
			
            // Add zeros in front of the data to get the right length.
			$textLength = strlen($text);
			while($textLength !== 7 && $textLength < 12) {
				$this->text = '0' . $this->text;
				++$textLength;
			}
		}
		
        /**
         * Returns an instance of TCPDF barcode generator.
         * @return \TCPDFBarcode
         */
		protected function getTCPDFBarcode() {
			$textLength = strlen($this->text);
			if($textLength === 7)
				return new \TCPDFBarcode($this->text, 'EAN8');
			else
				return new \TCPDFBarcode($this->text, 'EAN13');
		}
	}