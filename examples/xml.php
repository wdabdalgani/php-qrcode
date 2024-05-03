<?php
/**
 * XML output example (not a meme)
 *
 * @created      02.05.2024
 * @author       smiley <smiley@chillerlan.net>
 * @copyright    2024 smiley
 * @license      MIT
 */

use chillerlan\QRCode\{Data\QRMatrix, QRCode, QROptions};
use chillerlan\QRCode\Output\QRMarkupXML;

require_once __DIR__.'/../vendor/autoload.php';

$options = new QROptions;

$options->version          = 7;
$options->outputInterface  = QRMarkupXML::class;
$options->outputBase64     = false;
$options->drawLightModules = false;

// assign an XSLT stylesheet
$options->xmlStylesheet   = './qrcode.style.xsl';

$options->moduleValues    = [
	// finder
	QRMatrix::M_FINDER_DARK    => '#A71111', // dark (true)
	QRMatrix::M_FINDER_DOT     => '#A71111', // finder dot, dark (true)
	QRMatrix::M_FINDER         => '#FFBFBF', // light (false)
	// alignment
	QRMatrix::M_ALIGNMENT_DARK => '#A70364',
	QRMatrix::M_ALIGNMENT      => '#FFC9C9',
	// timing
	QRMatrix::M_TIMING_DARK    => '#98005D',
	QRMatrix::M_TIMING         => '#FFB8E9',
	// format
	QRMatrix::M_FORMAT_DARK    => '#003804',
	QRMatrix::M_FORMAT         => '#CCFB12',
	// version
	QRMatrix::M_VERSION_DARK   => '#650098',
	QRMatrix::M_VERSION        => '#E0B8FF',
	// data
	QRMatrix::M_DATA_DARK      => '#4A6000',
	QRMatrix::M_DATA           => '#ECF9BE',
	// darkmodule
	QRMatrix::M_DARKMODULE     => '#080063',
	// separator
	QRMatrix::M_SEPARATOR      => '#DDDDDD',
	// quietzone
	QRMatrix::M_QUIETZONE      => '#DDDDDD',
];


try{
	$out = (new QRCode($options))->render('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
}
catch(Throwable $e){
	// handle the exception in whatever way you need
	exit($e->getMessage());
}


if(php_sapi_name() !== 'cli'){
	header('Content-type: '.QRMarkupXML::MIME_TYPE);
}

echo $out;

exit;
