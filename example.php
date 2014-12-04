<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <title>pBarcode example</title>
    </head>
    <body>
        <pre><?php
            require_once(__DIR__ . '/lib/pBarcode/pBarcode.php');
            
            $symbol = new \pBarcode\Symbols\Code39();
            // $symbol = new \pBarcode\Symbols\Code93();
            // $symbol = new \pBarcode\Symbols\Code128();
            // $symbol = new \pBarcode\Symbols\EAN();
            // $symbol = new \pBarcode\Symbols\ITF();
            // $symbol = new \pBarcode\Symbols\Codabar();
            // $symbol = new \pBarcode\Symbols\DataMatrix();
            // $symbol = new \pBarcode\Symbols\PDF417();
            // $symbol = new \pBarcode\Symbols\QRCode();
            
            $symbol->setText('0123456789');
            $image = $symbol->getImage();

            $view = new \pBarcode\Views\BlockElements($image);
            echo $view->getResult(), "\n";
            echo str_pad($symbol->getText(), $view->getWidth(), ' ', STR_PAD_BOTH);
        ?></pre>
    </body>
</html>