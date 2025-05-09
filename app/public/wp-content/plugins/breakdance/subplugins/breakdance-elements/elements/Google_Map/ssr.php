
<?php
/**
 * @var array $propertiesData
 */

$use_without_api_key = $propertiesData["content"]["content"]["use_without_api_key"] ?? false;
$title = $propertiesData["content"]["content"]["title"] ?? "Map";

$apiKey = \Breakdance\APIKeys\getKey(BREAKDANCE_GOOGLE_MAPS_API_KEY_NAME);

if (!$apiKey && !$use_without_api_key) {

	echo 'To enable all Google Maps functionality, add your API key in the WordPress admin panel at Breakdance → Settings → API Keys.';

} else {

	$address = $propertiesData["content"]["content"]["address"] ?: "Space Needle, Seattle WA";
	$zoom = $propertiesData["content"]["content"]["zoom"] ?: 14;

    if (\Breakdance\isRequestFromBuilderSsr() && str_starts_with($address, '[breakdance_dynamic')) {
        // render the shortcode value so this displays correctly in the builder
        $address = \Breakdance\DynamicData\breakdanceDoShortcode($address);
    }

	if ($use_without_api_key) {
		echo '<iframe width="100%" height="100%" style="border:0" loading="lazy" title="' . esc_attr($title) . '" src="https://maps.google.com/maps?q='.urlencode($address).'&t=m&z='.$zoom.'&output=embed&iwloc=near" allowfullscreen></iframe>'.PHP_EOL;
	} else {

		$maptype = $propertiesData["content"]["content"]["map_type"] ?? 'roadmap';

		echo '<iframe width="100%" height="100%" style="border:0" loading="lazy" title="' . esc_attr($title) . '" src="https://www.google.com/maps/embed/v1/place?key='.$apiKey.'&q='.urlencode($address).'&zoom='.$zoom.'&maptype='.$maptype.'" allowfullscreen></iframe>'.PHP_EOL;
	}

}
?>
