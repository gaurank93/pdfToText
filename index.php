<?php
require "./vendor/autoload.php";
use \ForceUTF8\Encoding;  // It's namespaced now.

$parser = new \Smalot\PdfParser\Parser(); 
 
// Source PDF file to extract text 
$file = './PCI-DSS-v4-0-SAQ-A.pdf'; 
 
// Parse pdf file using Parser library 
$pdf = $parser->parseFile($file); 
$pages = $pdf->getPages(); 

// Extract text from PDF 

// Create the new document..
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Add an empty Section to the document

//Add 10 pages of pdf to word
for($x=0;$x<10;$x+=1)
{
    $section = $phpWord->addSection();
    $tmp = $pages[$x]->getText();
    $tmp = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $tmp);
    //$tmp = Encoding::toUTF8($tmp);
    $tmp = htmlentities($tmp);
    // echo $tmp;
    //$tmp = Encoding::toLatin1($tmp);
    $section->addText(
        $tmp
    );
}

// Save document
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('./HelloWorld.docx');





