<?php 

$email = ""; // your email, same as your Helprace login
$api_key = ""; // an API key from the Settings > Integrations > API page in your Helprace admin panel
$yourdomain = ""; // the first part of your help desk URL (without alias): yourdomain.helprace.com
$server = "helprace.com";

// Update topic fields
$space_data = json_encode(array(
  "name" => "Updated API Space",
  "restrictions" => "staff_only"
));
$space_id = 1;

$url = "https://$yourdomain.$server/api/v1/spaces/$space_id";

$ch = curl_init($url);

$header[] = "Content-type: application/json";
$header[] = "Accept: application/json";
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $space_data);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_USERPWD, "$email/api_key:$api_key");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);
$info = curl_getinfo($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($server_output, 0, $header_size);
$response = substr($server_output, $header_size);

echo "___Response Headers___ <br>\n";
echo nl2br($headers)."<br>\n";
echo "___Response Body___ <br>\n";
echo "$response <br>\n";

curl_close($ch);