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
ghcr.io/homematic-community/homehub:master
```

Verfügbare Parameters im Detail:

| Parameter | Optional | Beispiel | Erklärung |
| ---- | --- | --- | --- |
| `TIMEZONE` | yes | Europe/Berlin | Timezone im Container |
| `-p` | no | 80:8080 | Zuweisung des Apache2 Port innerhalb dieses Containers auf den Docker-Host Port (Bridge Mode). Mit dieser Konfiguration kann HomeHub dann über Port 8080 des Docker-Hosts erreicht werden, z. B. 192.168.178.100:8080|

Volumes:

| Volume | Erklärung |
| ---- | --- |
| `/FOLDER/OF/YOUR/CONFIG` | Das Verzeichnis /htdocs/config, in dem die HomeHub-Einstellungen gespeichert werden sollen. Dieser Ordner befindet sich auf dem PC, auf dem Docker ausgeführt wird und die Dateien aus dem Verzeichnis config werden dort abgelegt. Sie werden dann automatisch an die HomeHub-Docker-Instanz weitergeleitet. |


## Lizenzen
HomeHub nutzt [jQuery](https://jquery.com/license/), [Chartjs](Chartjs.org), [knx-uf-iconset](https://github.com/OpenAutomationProject/knx-uf-iconset), [Bootstrap](https://getbootstrap.com/)
