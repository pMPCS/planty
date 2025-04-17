jQuery(document).ready(function($)
{
	//
	// Allgemein
	//

	// Prüfen ob der Breakdace-Editor aktiv ist
	if($('body').hasClass('logged-in')) var bd_editor=true;
	else var bd_editor=false;

	// Ausgabe Bild-Titel deaktivieren
	$('img[title]').each(function() { $(this).removeAttr('title'); });

	// Listen
	$('.bde-rich-text ul li').wrapInner('<span class="text"></span>');

	// Gutenberg-Buttons in Breakdance-Buttons umwandeln
	$('.wp-block-button a').attr('class', 'button-atom button-atom--primary bde-button__button').attr('style', 'transition: none;').wrapInner('<span class="button-atom__text"></span>');
	$('.wp-block-button').attr('class', 'bde-button');
	
});