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
     * A QRCode symbol.
     * @copyright 2014 Vladimir P.
     * @license MIT
     */
	final class QRCode extends TCPDFMatrixSymbol {
        /**
         * Error correction level.
         * @var string
         */
		private $errorCorrectionLevel = 'L';
		
        /**
         * Returns an instance of TCPDF barcode generator.
         * @return \TCPDF2DBarcode
         */
		protected function getTCPDF2DBarcode() {
			return new \TCPDF2DBarcode($this->text, 'QRCODE,' . $this->errorCorrectionLevel);
		}
		
		/**
         * Sets error correction level.
         * @param string $level 'L' -- low (7%), 'M' -- medium (15%), 'Q' -- quartile (25%), or 'H' -- high (30%).
         * @return void
         * @throws \InvalidArgumentException If called with an invalid error correction level.
         */
		public function setErrorCorrectionLevel($level) {
			if($level !== 'L' && $level !== 'M' && $level !== 'Q' && $level !== 'H')
				throw new \InvalidArgumentException('Invalid error correction level.');
			$this->errorCorrectionLevel = $level;
		}
	}