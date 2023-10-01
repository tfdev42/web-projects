<!-- HTML Form (Formula)<form action="">

2023.05.24


>> INPUT
>> Button


-------------------- GET: --------------------
- Daten werden in URL uebertragen
- Informationen teilen
- URL (Link) verschicken
- Durch Aufruf weden KEINE DATEN VERAENDERT

Key-Value-Pairs werden uebertragen => in der URL


-------------------- POST: --------------------
- Im REQUEST Body
- Unsichtbar im Background
- Login, Registrierung
- File uploads
- ZUSTANDSVERAENDERUNG


-------------------- SECURITY --------------------
Angriffsmethoden:
- XSS (Cross-Site-Scripting)
-- htmlspecialchars()

- SQL Injections
-- Prepared Statements

- Bruteforce Attacks
-- Zugriff nach fehlversuchen Sperren
-- Captcha

- Man-in-the-midddle attacks
- Phishing
- Passwortdiebstahl
-- password_hash(), password_verify()


-------------------- HASH --------------------
- Einwegfunktion
- Algo: sha256, sha512
- Gleicher Input ==> fuehrt immer zum Gleichen Hash


-------------------- SYMMETRISCHE VERSCHLUESSELUNG --------------------
m... Message
k... Key
Encrypt; E(k, m) => Cipher-Text(c)
Decrypt; D(c, k) => m


-------------------- A-SYMMETRISCHE VERSCHLUESSELUNG --------------------
public Key >> ENCRYPT
private Key >> DECRYPT

E(m, publicKey) => Cipher-Text(c)
D(c, privateKey) => m





-->



<?php
// WARNINGS
// Enable WARNINGS ON LINUX >>>>>>
error_reporting(E_ALL);

ini_set('display_errors','1');



?>