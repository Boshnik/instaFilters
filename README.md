## instaFilters
Полный набор фильтров Instagram на чистом CSS

### Cниппет instaFilters:

#### MODX
    [[instaFilters? $src=`/assets/image/img.jpg`]]

#### Fenom
    {'instaFilters' | snippet: [
        'src' => '/assets/image/img.jpg'
    ]}
    
#### Modifier
    {'/assets/image/img.jpg' | instaFilters : 'filter=1997&alt=filter-1977'}
    
#### Параметры сниппета:
Имя | Описание | По умолчанию
--- | --- | ---
tplOuter | Шаблон обвертки изображения | '@INLINE <figure class="filter-[[+filter]]">[[+wrapper]]</figure>'
tpl | Шаблон изображения | '@INLINE <img src="[[+src]]" alt="[[+alt]]" [[+classes]]>'
src | Путь к картинке | 
alt | alt картинки |
classes | Классы для картинки |
filter | Фильтр картинки | Normal
toPlaceholder | Вывод результата в плейсхолдер |