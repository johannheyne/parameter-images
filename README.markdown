Parameter-Images
================

Ganzheitliche Lösung zu Bildern in Responsive Web Design (RWD).

- clientseitige Steuerung der responsiven Bildvarianten
- serverseitiges Bildmanagement

Der Entwurf 2 zu einer gesamtheitlichen Lösung zu Bildern in RWD geht von dem Ansatz aus, dass das responsive Verhalten und die atomatische Generierung der Bilder zentral über eine Variable in PHP definiert wird. Aus ihr werden automatisch die Mediaqueries in ein separates Stylesheet abgeleitet. Ein Javascript überwacht Veränderungen des Browserfenster und überprüft, ob ein Bild neu geladen werden muss. Die dafür notwendigen Informationen bezieht es aus einem Data Attribut im IMG-Tag.

```php
// php
$setup = array(
	'behaviorname' => array(
		'400' => array(
			'img_width' => 400
		),
		'800' => array(
			'img_width' => 800
		),
		'9999' => array(
			'img_width' => 1200
		),
	),
);
```

```html
<!-- html -->
<img data-respbehavior="[400,800,9999]" 
	 data-breakpoint="800" 
	 src="image.jpg?behavior=behaviorname&breakpoint=800">
```

Anhand des Data Attributes ```data-breakpoint``` und dem im Data Attribut ```data-respbehavior``` gegebenem JSON-Objektes kann ein Javaskript bei Größenveränderung des Browserfensters überprüfen, ob eine neue Bildgröße / -variante eforderlich ist. Das Skript würde den scr Parameter breakpoint anpassen, was ein Neuladen des Bildes mit den veränderten Maßen bewirkt.

Die Zukunft
----------------
Die offizielle zukünftige Lösung liegt derzeit im picture Tag sowie dem srcset und size Attribut. Bei diesen Lösungen ist es ebenfalls notwendig, dass verschiedene Bildvarianten vom Server bereitgestellt werden. Parameter-Images könnte das automatisiert leisten, sodass dies nicht mehr händisch erledigt werden muss. Sowohl beim picture Tag als auch bei der srcset Variante muss das Verhalten des Bildes über Mediaqueries syncron zu den in den Stylesheets definierten Mediaqueries angegeben werden. Parameter-Images ist bestrebt, das Verhalten der Bilder zentral zu definieren, um Fehlerquellen und Arbeitszeit zu veringern.
