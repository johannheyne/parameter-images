Parameter-Images
================

Der Entwurf 2 zu einer gesamtheitlichen Lösung zu Bildern in RWD geht von dem Ansatz aus, dass das Verhalten der Bilder zentral über eine Variable in PHP definiert wird. Aus ihr werden automatisch die Mediaqueries in ein separates Stylesheet abgeleitet. Ein Javascript überwacht Veränderungen des Browserfenster und überprüft, ob ein Bild neu geladen werden muss. Die dafür notwendigen Informationen bezieht es aus einem Data Attribut im IMG-Tag.

```php
// php
$setup = array(
	'behaviorname' => array(
		'1' => array(
			'window_max_width' => 400,
			'img_width' => 400
		),
		'2' => array(
			'window_max_width' => 800,
			'img_width' => 800
		),
		'3' => array(
			'window_max_width' => 1200,
			'img_width' => 1200
		),
	),
);
```

```html
// html
<img data-resp="{'maxw-400':'1','maxw-800':'2','maxw-1200':'3'}" 
	 data-current-size="3" 
	 src="image.jpg?behavior=3&size=1">
```

Anhand des Data Attributes ```data-current-size``` und dem im Data Attribut ```data-resp``` gegebenem JSON-Objektes kann ein Javaskript bei Größenveränderung des Browserfensters überprüfen, ob eine neue Bildgröße / -variante eforderlich ist. Das Skript würde den scr Parameter size anpassen, was ein Neuladen des Bildes mit den veränderten Maßen bewirkt.