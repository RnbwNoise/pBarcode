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
    
	require_once(__DIR__ . '/../../vendor/tcpdf/tcpdf_barcodes_1d.php');
	
    /**
     * A barcode symbol based on a TCPDF 1D barcode generator.
     * @copyright 2014 Vladimir P.
     * @license MIT
     */
	abstract class TCPDFLinearSymbol extends Symbol {
        /**
         * Returns an Image containing the barcode.
         * @return Image|null
         */
		final public function getImage() {
			if(strlen($this->text) === 0)
				return null;
			
			$data = $this->getTCPDFBarcode()->getBarcodeArray();
			if($data === false)
				return null;
			
			$image = new Image($data['maxw'], $data['maxh']);
			
			$x = 0;
			foreach($data['bcode'] as $bar) {
				for($i = 0; $i < $bar['w']; ++$i) {
					for($y = 0; $y < $bar['h']; ++$y)
						$image->setPixel($x + $i, $bar['p'] + $y, (int)$bar['t']);
				}
				$x += $bar['w'];
			}
			
			return $image;
		}
		
        /**
         * Returns an instance of TCPDF barcode generator.
         * @return \TCPDFBarcode
         */
		abstract protected function getTCPDFBarcode();
	}