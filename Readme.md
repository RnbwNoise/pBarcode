# pBarcode

     ████▐▐▐ ▐██▐▐▐██ █▐▐ ▐▌  ▐▌  ▌▐▐▌ ██▐▐▐█▌ ▐███▐ ▐▐ ▌ 
     ████▐▐▐ ▐██▐▐ ▐▌ █  ▐▐█ ▐▐█▌▌█ █  ██▐▐ ▌  ▐███▐ ▐▐ ▌ 
     ████▐▐▐ ▐█▐▐▐██▌ ██▐ ██▐ ▐▐ ▐  ▐█▌█▐▐ ▐██ ▐███▐ ▐▐ ▌ 
     ████▐▐▐ ▐▌▌██ ██▌█ ▐▐▐▌  ▐▌▐  ▐▐▌ ▌▌██ ██ ▐███▐ ▐▐ ▌ 
     ████▐▐▐ ▐▌▌█▌ ▐  █▐▐█▌▐▌ ▐█▌▌  ▌ ▌██▐▐█ █▌▐███▐ ▐▐ ▌ 
     ████▐▐▐ ▐█▌▌██▐  █▐▌▐ ▐█▌▐▐▌▌  ▐█ ██▐▐█▌ ▐▐███▐ ▐▐ ▌ 
     ████▐▐▐ ▐█▐ █▌██▌▌█▌▐██▐█▐ ▌ ▐▌ ▐▌█▐ █▌██ ▐███▐ ▐▐ ▌ 

A library for making barcodes in PHP.


## Supported Symbologies

* Code39
* Code93
* Code128
* EAN 8 and 13
* ITF (Interleaved 2 of 5)
* Codabar
* DataMatrix
* PDF417
* QRCode


## Example

    require_once('lib/pBarcode/pBarcode.php');
    
    $symbol = new \pBarcode\Symbols\Code39();
    
    $symbol->setText('0123456789');
    $image = $symbol->getImage();

    $view = new \pBarcode\Views\BlockElements($image);
    echo $view->getResult();

See example.php.


## Documentation

See docs/.


## License

Copyright (C) 2014 Vladimir P.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.