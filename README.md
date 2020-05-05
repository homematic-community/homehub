# HomeHub WebUI
HomeHub ist ein alternatives Frontend für HomeMatic. Der Hauptfokus liegt darauf, eine Übersicht über die vorhandenen HomeMatic Komponenten zu geben und die Möglichkeit zu bieten, Komponenten wie Jalousien und Heizung schnell zu bedienen.

## Wie wird HomeHub installiert?
HomeHub benötigt eine installierte XML-API auf der CCU.

1. HomeHub auf einen Webserver im LAN kopieren.
2. In der Datei app/Config/config.php die korrekte IP der CCU in die Variable $homematicIp eintragen.
3. Den Ordnern app/Config und cache 777 Rechte geben.
4. http://IP_OF_YOUR_SERVER/HomeHub im Browser öffnen.
5. Im Menü auf Import klicken, um Komponenten, Programme und Systemvariablen von der CCU einzulesen.

## Anforderungen
* XML-API
* PHP 5.5
* libxml Erweiterung
* JavaScript

## Unterstützte HomeMatic Komponenten (zumindest lesend)
* HM-CC-RT-DN
* HM-CC-SCD
* HM-CC-TC
* HM-CC-VD
* HM-CC-VG-1
* HM-Dis-TD-T
* HM-Dis-WM55
* HM-ES-PMSw1-DR
* HM-ES-PMSw1-Pl
* HM-ES-PMSw1-Pl-DN-R1
* HM-ES-PMSw1-Pl-DN-R5
* HM-ES-TX-WM
* HM-LC-Bl1-FM
* HM-LC-Bl1PBU-FM
* HM-LC-Bl1-SM
* HM-LC-Dim1PWM-CV
* HM-LC-Dim1T-CV
* HM-LC-Dim1T-FM
* HM-LC-Dim1TPBU-FM
* HM-LC-Dim1T-Pl
* HM-LC-RGBW-WM
* HM-LC-Sw1-Ba-PCB
* HM-LC-Sw1-DR
* HM-LC-Sw1-FM
* HM-LC-Sw1-PB-FM
* HM-LC-Sw1PBU-FM
* HM-LC-Sw1-Pl
* HM-LC-Sw1-Pl-2
* HM-LC-Sw1-Pl-CT-R1
* HM-LC-Sw1-Pl-DN-R1
* HM-LC-Sw1-Pl-DN-R5
* HM-LC-Sw1-SM
* HM-LC-Sw2-FM
* HM-LC-Sw4-Ba-PCB
* HM-LC-Sw4-DR
* HM-LC-Sw4-PCB
* HM-LC-Sw4-SM
* HM-LC-Sw4-WM
* HM-MOD-EM-8
* HM-MOD-Re-8
* HM-OU-CFM-Pl
* HM-OU-CM-PCB
* HM-OU-LED16
* HM-PB-2-FM
* HM-PB-2-WM
* HM-PB-2-WM55
* HM-PB-2-WM55-2
* HM-PB-4Dis-WM
* HM-PB-4Dis-WM-2
* HM-PB-4-WM
* HM-PB-6-WM55
* HM-PBI-4-FM
* HM-RC-19
* HM-RC-19-B
* HM-RC-19-SW
* HM-RC-4
* HM-RC-4-2
* HM-RC-4-B
* HM-RC-8
* HM-RC-Dis-H-x-EU
* HM-RC-Key3-B
* HM-RC-Key4-2
* HM-RC-P1
* HM-RCV-50
* HM-SCI-3-FM
* HM-Sec-Key
* HM-Sec-Key-S
* HM-Sec-MDIR
* HM-Sec-MDIR-2
* HM-Sec-RHS
* HM-Sec-SC
* HM-Sec-SC-2
* HM-Sec-SCo
* HM-Sec-SD-2-Team
* HM-Sec-SD-Team
* HM-Sec-SFA-SM
* HM-Sec-TiS
* HM-Sec-WDS
* HM-Sec-WDS-2
* HM-Sec-Win
* HM-Sen-DB-PCB
* HM-Sen-EP
* HM-Sen-MDIR-O
* HM-Sen-MDIR-O-2
* HM-Sen-MDIR-SM
* HM-Sen-MDIR-WM55
* HM-Sen-RD-O
* HM-Sen-Wa-Od
* HM-SwI-3-FM
* HM-TC-IT-WM-W-EU
* HM-WDC7000
* HM-WDS100-C6-O
* HM-WDS10-TH-O
* HM-WDS30-OT2-SM
* HM-WDS30-OT2-SM-2
* HM-WDS30-T-O
* HM-WDS40-TH-I
* HM-WDS40-TH-I-2
* HMW-IO-12-FM
* HMW-IO-12-Sw14-DR
* HMW-IO-12-Sw7-DR
* HMW-IO-4-FM
* HMW-LC-Bl1-DR
* HMW-LC-Dim1L-DR
* HMW-LC-Sw2-DR
* HMW-RCV-50
* HMW-Sen-SC-12-DR
* HMIP-BDT
* HMIP-BROLL
* HMIP-BSL
* HMIP-BSM
* HMIP-BWTH
* HMIP-eTRV
* HMIP-eTRV-2
* HMIP-eTRV-B
* HMIP-SLO
* HMIP-FSM
* HMIP-FSM16
* HMIP-FSI16
* HMIP-PSM
* HMIP-SCI
* HMIP-SRH
* HMIP-STHD
* HMIP-SWDO-I
* HmIP-SWDO-PL
* HMIP-SWO-B
* HMIP-WTH-2
* HMIPW-DRS4
* HMIPW-DRS8
* HMIPW-DRD3 (validieren)
* HMIPW-DRBL4 (validieren)
* Programme
* Systemvariablen

## Unterstützte CUxD Komponenten (zumindest lesend)
* CUX2801
* CUX2803
* CUX4000 (noch nicht voll unterstützt)
* CUX9002

## Unterstützte Custom Komponenten
* Audio (Radio Erft)
* iFrame (HomeMatic-Forum)
* Tagesschau in 100 Sekunden
* Tankerkönig
* WeatherUnderground
* Webcam (INSTAR IN5905HD)

## Konfigurationsmöglichkeiten in HomeHub
* In der Datei app/Config/categories.json kann das Menü auf der linken Seite konfiguriert werden.
* app/Config/mapping.json wird dazu genutzt Komponententypen wie z.B. HM-CC-RT-DN Menüeinträgen zuzuordnen.
* Spezifische Komponenten wie z.B. das Heizkörperthermostat im Wohnzimmer kann in der Datei app/Config/custom.json einem oder mehreren Menüeinträgen zugeordnet werden.

## Wie kann das Aussehen von HomeHub angepasst werden?
Das Aussehen von HomeHub kann mit der Datei assets/css/custom.css angepasst werden. Das Stylesheet wird nach dem HomeHub Stylesheet aufgerufen.
Es ist auch möglich, das komplette Design für einen einzelnen Menüeintrag zu verändern. Dazu muss eine HTML Datei für diese Kategorie angelegt werden und im Ordner app/Views/lowercase_category_name.html abgelegt werden.