<?php
$tplOuter = $modx->getOption('tplOuter', $scriptProperties, '@INLINE <figure class="filter-[[+filter]]">[[+wrapper]]</figure>');
$tpl = $modx->getOption('tpl', $scriptProperties, '@INLINE <img src="[[+src]]" alt="[[+alt]]" [[+classes]]>');
$src = $modx->getOption('src', $scriptProperties, $modx->getOption('input', $scriptProperties, '', true), true);
$alt = $modx->getOption('alt', $scriptProperties, '');
$classes = $modx->getOption('classes', $scriptProperties, '');
$filter = $modx->getOption('filter', $scriptProperties, 'normal');
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, false);
$options = $modx->getOption('options', $scriptProperties, '', false);

if(!isset($scriptProperties['src'])) {
    $scriptProperties['src'] = $src;
}

if(!empty($options)) {
    $options = explode('&', $options);
    foreach($options as $option) {
        $option = explode('=', $option);
        $scriptProperties[$option[0]] = $option[1];
    }
    if(isset($scriptProperties['filter'])) {
        $filter = $scriptProperties['filter'];
    }
}

if(empty($src)) return;
if(!empty($classes)) {
    $scriptProperties['classes'] = "class='$classes'";
}

// Подключем css
$modx->regClientCss('/assets/components/instafilters/css/instagram.min.css');

// Output
$pdo = $modx->getService('pdoTools');
$wrapper = $pdo->parseChunk($tpl, $scriptProperties);
$output = $pdo->parseChunk($tplOuter, array(
    'filter' => $filter,
    'wrapper' => $wrapper
));
if (!empty($toPlaceholder)) {
    // If using a placeholder, output nothing and set output to specified placeholder
    $modx->setPlaceholder($toPlaceholder, $output);

    return '';
}
// By default just return output
return $output;