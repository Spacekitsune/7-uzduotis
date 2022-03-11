Instructions
1. Sukurti nauj&#261;  Laravel projekt&#261;. &#302;traukti autentifikacijos modul&#303;.
2. Sukurti modelius:</br>
   Article:
   ID,
   title,
   description,
   type_id.

   Type:
   ID,
   title,
   description.

Turi b?ti sudarytas ry�ys.
3. Tiek Article, tiek Type reikalingas tik index.blade.php failas.
3. Visos CRUD operacijos turi b?ti suprogramuotos taip:
    *Nauj? ?ra�? prid?jimas vykdomas per i��okant? lang? su AJAX. ?ra�ai prisideda realiu laiku.
    *?ra�? redagavimas vykdomas per i��okant? lang? su AJAX.
    *?ra�? trynimas vykdomas su Ajax. ?ra�ai i�sitrina realiu laiku.
    * 'Show' mygtukas atvaizduoja informacij? apie ?ra�? i��okan?iame lange su AJAX.</br>
Papildoma:</br>
 Suprogramuoti keli? ?ra�? i�trynim? vienu metu.</br>

1.  Patobulinti įrašų redagavimą: įrašų redagavimas turi atsinaujinti
    realiu laiku.</br>
2.  Tiek Article, tiek Type, sukurti Ajax paiešką, lentelė atsinaujina
    realiu laiku, jei nerasta įrašų, turi iššokti pranešimas, kad įrašų
    nėra.</br>
3.  Tiek Article, tiek Type, sukurti Ajax rikiavimą.</br>
4.  Prie Article rikiavimo prijungti Ajax filtravimą pagal Type.</br>
5.  Patobulinti įrašų pridėjimą taip, kad jeigu tuo metu yra rikiuojama
    lentelė, įrašas atsirastų ne lentelės pabaigoje, o pagal esamą
    rikiavimą.</br>
6.  Įtraukti AJAX validacijas. Validacijos taisyklės taikomos savo
    nuožiūra</br>
7.  Suprogramuoti kelių įrašų ištrynimą vienu metu.</br>

Papildomai: Sukurti Ajax puslapiavimą.</br>
