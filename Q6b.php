<?php 
$conn=mysqli_connect('localhost','root','','api_cat');
$a=mysqli_query($conn,"select * from products");
$xml=new XMLWriter() ;
$xml->openURI("php://output");
$xml->startDocument();
$xml->setIndent(true);
$xml->startElement("Products");
while($row=mysqli_fetch_assoc($a)) {
    $xml->startElement("ProductsInfo");
        $xml->startElement("ProId");
        $xml->writeRaw ($row["ProId"]);
        $xml->endElement(); 

        $xml->startElement("ProName");
        $xml->writeRaw ($row["ProName"]);
        $xml->endElement();

        $xml->startElement("ProQty");
        $xml->writeRaw ($row["ProQty"]);
        $xml->endElement(); 

         $xml->startElement("ProUnit");
        $xml->writeRaw ($row["ProUnit"]);
        $xml->endElement(); 

         $xml->startElement("Supplier");
        $xml->writeRaw ($row["Supplier"]);
        $xml->endElement(); 

         $xml->startElement("SupplierPhone");
        $xml->writeRaw ($row["SupplierPhone"]);
        $xml->endElement(); 

    $xml->endElement();   
}
$xml->endElement();
header("Content-type: text/xml");
$xml->flush();
?>
