## HomeHub für die CCU gibt es nun schon viele Jahre und bietet eine schlanke leicht konfigurierbare Lösung für Homematic CCUs (keine Homematic Cloud).

Systemanforderungen:
Webserver mit PHP
Installiertem CURL und PHP-CURL Modul

Anleitung steht im [HomeMatic-Forum](https://homematic-forum.de/forum/viewtopic.php?f=41&t=81476) zur Verfügung. (noch Version 4.0)

### Oberfläche

Ansicht in großer Auflösung (>1000 px breite)

![2024-03-29 10_49_27](https://github.com/homematic-community/homehub/assets/126362145/71e3c7cf-21aa-4550-a9f5-7645c682e700)

Ansicht in mittlerer Auflösung (>=600 px breite)

![2024-03-29 10_51_09](https://github.com/homematic-community/homehub/assets/126362145/83b29ffa-e017-4691-ba48-74eadea3b234)

Ansicht in geringer Auflösung (<600 px breite) - Smartphone

![2024-03-29 10_50_11](https://github.com/homematic-community/homehub/assets/126362145/3c0e7771-9822-421d-b66c-63f6cc6d2214)

### showtime


Bei folgenden Komponenten lässt sich durch Angabe von ``"showtime":"true"`` die Zeit der letzten Aktivität einblenden:

- CUX2801
- CUX2803
- CUX4000
- CUX9002
- HM-LC-Sw1-FM
- HM-LC-Sw2PBU-FM
- HM-RCV-50
- HM-Sec-MDIR-2
- HM-Sec-RHS
- HM-Sec-SC-2
- HM-Sec-SC
- HM-Sec-SCo
- HM-Sec-WDS-2
- HmIP-DLD
- HmIP-MOD-HO
- HmIP-RCV-50
- HmIP-SCI
- HmIP-SMI55-2
- HmIP-SMI55
- HmIP-SPI
- HmIP-SWDM-2
- HmIP-SWDM-B2
- HmIP-SWDM
- HmIP-SWDO-I
- HmIP-SWDO-PL
- HMW-LC-Bl1-DR
- HMW-RCV-50
- Program
- SysVar

## Docker Integration
```
docker run \
-d \
--name=HomeHub \
--restart unless-stopped \
-p 8080:80 \
-e TZ=Europe/Berlin \
-v /FOLDER/OF/YOUR/CONFIG:/htdocs/config \
ghcr.io/etofi/homehub_docker:master
```

The available parameters in detail:

| Parameter | Optional | Example | Description |
| ---- | --- | --- | --- |
| `TIMEZONE` | yes | Europe/Berlin | Timezone for the container |
| `-p` | no | 80:8080 | Map Apache2 Listenport inside this Container to Host Device Listen Port (Bridge Mode) |

Volumes:

| Volume | Description |
| ---- | --- |
| `/FOLDER/OF/YOUR/CONFIG` | The directory to to persist /htdocs/config of the HomeHub settings. This folder is located on the PC on which Docker is running and the files from the config directory go into it. They are then automatically passed through to the HomeHub Docker instance. |


## Lizenzen
HomeHub nutzt [jQuery](https://jquery.com/license/), [Chartjs](Chartjs.org), [knx-uf-iconset](https://github.com/OpenAutomationProject/knx-uf-iconset), [Bootstrap](https://getbootstrap.com/)
