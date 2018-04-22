# LiveLocationMap 📍
Shows the location of a person/smartphone on a map.

## About 🐝
Initially this project was a fork of "[Big Brother GPS](http://bk.gnarf.org/creativity/bigbrothergps/)".
Since that project seems unmaintained (the iOS App also did not received any updates since 2014), I have now rewritten most of my original code.

Location updates are now provided by "[PhoneTrack](https://gitlab.com/eneiluj/phonetrack-oc)" and [OwnTracks](http://owntracks.org).

## Features 📖
* Display your location on Google Maps
* Optional pseudonymization for your location

## Requirements ✅
* PHP 5.6+
* Google Maps API Key ([🔑](https://developers.google.com/maps/documentation/javascript/get-api-key))
* Nextcloud/Owncloud with installed [PhoneTrack App](https://gitlab.com/eneiluj/phonetrack-oc)
* An App like [OwnTracks](http://owntracks.org) to provide the location data

## Changelog 📝
* 0.3 - Rewritten 🎉 with Google Maps APIv3, PhoneTrack backend and new license
* 0.2.1 - Added even more settings
* 0.2 - Added some settings, new images (apple-touch-icon) and bugfixes
* 0.1 - Initial Release

## ToDos/Planned features 🛠
* Choose between 'Google Maps' and 'Open Street Map' (🤷‍♂)
* Password protection for non-pseudonymizated location
* Admin panel for settings (instead of settings file)
* JSON caching (🤷‍♂)

## Resources 💖
* OpenGraph-Image by [@rrruthie](https://unsplash.com/photos/a6mfMjCFkII) (CC 0)
* Marker.svg (CC-BY-SA) 2018 Jan Jastrow

## License 📜
MIT License
