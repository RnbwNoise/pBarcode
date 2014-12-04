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
	
	namespace pBarcode\Views;
	use pBarcode\Image as Image;
	
    /**
     * An abstract view.
     * @copyright 2014 Vladimir P.
     * @license MIT
     */
	abstract class View {
        /**
         * Image to be rendered.
         * @var Image
         */
        protected $image;
        
        /**
         * Rendered image.
         * @var mixed|null
         */
		protected $result = null;
		
        /**
         * Creates a view for a given image.
         * @param Image $image
         */
		final public function __construct(Image $image) {
            $this->image = $image;
		}
		
        /**
         * Returns a rendered image.
         * @return mixed
         */
		final public function getResult() {
            if($this->result === null)
                $this->render();
			return $this->result;
		}
		
		/**
         * Creates a rendered image and writes result to $this->result.
         * @return void
         */
        abstract protected function render();
	}