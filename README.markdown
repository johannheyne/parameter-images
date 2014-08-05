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
<!-- html -->
<img data-resp="{'maxw-400':'1','maxw-800':'2','maxw-1200':'3'}" 
	 data-current-size="3" 
	 src="image.jpg?behavior=behaviorname&size=3">
```

Anhand des Data Attributes ```data-current-size``` und dem im Data Attribut ```data-resp``` gegebenem JSON-Objektes kann ein Javaskript bei Größenveränderung des Browserfensters überprüfen, ob eine neue Bildgröße / -variante eforderlich ist. Das Skript würde den scr Parameter size anpassen, was ein Neuladen des Bildes mit den veränderten Maßen bewirkt.

Die Zukunf
----------------
Die offizielle zukünftige Lösung liegt derzeit im picture Tag sowie dem srcset und size Attribut. Bei diesen Lösungen ist es ebenfalls notwendig, dass verschiedene Bildvarianten vom Server bereitgestellt werden. Parameter-Images könnte das automatisiert leisten, sodass dies nicht mehr händisch erledigt werden muss. Sowohl beim picture Tag als auch bei der srcset Variante muss das Verhalten des Bildes über Mediaqueries syncron zu den in den Stylesheets definierten Mediaqueries angegeben werden. Parameter-Images ist bestrebt, das Verhalten der Bilder zentral zu definieren, um Fehlerquellen und Arbeitszeit zu veringern.