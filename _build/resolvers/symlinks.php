<?php
// $config['update']['symlink'] = true; Удаляем рекурсивно все файлы из пакета и создает ссылки на рабочие файлы
// $config['update']['symlink'] = false; Удаляем ссылку и копируем рабочие файлы обратно в пакет

/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;
    
    $config = ['update' => ['symlink' => true]];
    /** @var array $config */
    if (file_exists(MODX_BASE_PATH . 'Extras/instaFilters/_build/config.inc.php')) {
        $config = include(MODX_BASE_PATH . 'Extras/instaFilters/_build/config.inc.php');
    }
    
    $base = MODX_BASE_PATH . 'Extras/instaFilters/';
    $core = MODX_CORE_PATH;
    $assets = MODX_ASSETS_PATH;
    
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($base) && $cache) {
        
        $files = [
            'assets' => [
                'target' => $base . 'assets/components/instafilters',
                'production' => $assets . 'components/instafilters/'    
            ],
            'core' => [
                'target' => $base . 'core/components/instafilters',
                'production' => $core . 'components/instafilters/'  
            ]
        ];
        
        foreach ($files as $file) {
            if (is_link($file['target'])) {
                if(!$config['update']['symlinks']) {
                    unlink($file['target']);
                    $cache->copyTree($file['production'], $file['target']);
                }
            } else {
                if($config['update']['symlinks'] ) {
                    $cache->deleteTree(
                        $file['target'],
                        ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
                    );
                    symlink($file['production'], $file['target']);
                }
                
            }
        }
        
    }
}

return true;
