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
     * A Code39 symbol.
     * @copyright 2014 Vladimir P.
     * @license MIT
     */
	final class Code39 extends TCPDFLinearSymbol {
        /**
         * Determines whether the barcode should include a checksum digit.
         * @var boolean
         */
		private $checksum = false;
		
        /**
         * Sets text to be encoded in the barcode. Characters that are not supported by Code39 will be removed.
         * @param string $text
         * @return void
         */
		public function setText($text) {
			$this->text = self::removeInvalidCharacters(strtoupper($text),
													'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-. $/+%');
		}
		
        /**
         * Returns an instance of TCPDF barcode generator.
         * @return \TCPDFBarcode
         */
		protected function getTCPDFBarcode() {
			return new \TCPDFBarcode($this->text, 'C39' . ($this->checksum ? '+' : ''));
		}
		
        /**
         * Adds or removes a checksum digit from the barcode.
         * @param boolean $checksum True of the checksum should be added, false otherwise.
         * @return void
         */
		public function addChecksum($checksum) {
			$this->checksum = $checksum;
		}
	}