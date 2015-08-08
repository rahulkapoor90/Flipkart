<?php
 
$url = "http://www.flipkart.com/apple-iphone-6/p/itme5rf6ewg7trwz?pid=MOBEYGPZAHZQMCKZ&otracker=from-search&srno=t_4&query=apple&al=hplRX0gsd%2BUs3897GU7MA33GdyuXyA9x5heu%2FXnCd8gCFiEqsIXwVoaLq2lx4bRfFLwHQxVDMNU%3D&ref=cfd05202-e814-4bb4-bbe2-422b4ecc6df9";
$response = getPriceFromFlipkart($url);
 
echo json_encode($response);
 
/* Returns the response in JSON format */
 
function getPriceFromFlipkart($url) {
 
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 10.10;)");
curl_setopt($curl, CURLOPT_FAILONERROR, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($curl);
curl_close($curl);
 
$regex = '/<meta itemprop="price" content="([^"]*)"/';
preg_match($regex, $html, $price);
 
$regex = '/<h1[^>]*>([^<]*)<\/h1>/';
preg_match($regex, $html, $title);
 
$regex = '/data-src="([^"]*)"/i';
preg_match($regex, $html, $image);
 
if ($price && $title && $image) {
echo $price[1];
echo "<img src='$image[1]' align='center'></img>";
echo "<title>$title[1]</title>";
}

}
?>
