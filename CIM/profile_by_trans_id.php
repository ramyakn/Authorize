<html>
<body>
<?php

/*
D I S C L A I M E R
WARNING: ANY USE BY YOU OF THE SAMPLE CODE PROVIDED IS AT YOUR OWN RISK.
Authorize.Net provides this code "as is" without warranty of any kind, either express or implied, including but not limited to the implied warranties of merchantability and/or fitness for a particular purpose.
Authorize.Net owns and retains all right, title and interest in and to the Automated Recurring Billing intellectual property.
*/

include_once ("vars.php");
include_once ("util.php");

echo "create profile...<br><br>";

//build xml to post
$content =
	"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
	"<createCustomerProfileFromTransactionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
	MerchantAuthenticationBlock().
	"<transId>" . $_POST["old_trans_id"] . "</transId>".
	"</createCustomerProfileFromTransactionRequest>";


echo "Raw request: " . htmlspecialchars($content) . "<br><br>";
$response = send_xml_request($content);


echo "Raw response: " . htmlspecialchars($response) . "<br><br>";
$parsedresponse = parse_api_response($response);
if ("Ok" == $parsedresponse->messages->resultCode) {
	echo "customerProfileId <b>"
		. htmlspecialchars($parsedresponse->customerProfileId)
		. "</b> was successfully created.<br><br>";
}

echo "<br><a href=index.php?customerProfileId="
	. urlencode($parsedresponse->customerProfileId).
	"&customerPaymentProfileId="
	. urlencode($parsedresponse->customerPaymentProfileIdList->numericString)
	. ">Continue</a><br>";
?>
</body>
</html>
