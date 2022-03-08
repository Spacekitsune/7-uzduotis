Instructions
1. Sukurti nauj&#261;  Laravel projekt&#261;. &#302;traukti autentifikacijos modul&#303;.
2. Sukurti modelius:</tr>
   Article:
   ID,
   title,
   description,
   type_id.

   Type:
   ID,
   title,
   description.

Turi b?ti sudarytas ryšys.
3. Tiek Article, tiek Type reikalingas tik index.blade.php failas.
3. Visos CRUD operacijos turi b?ti suprogramuotos taip:
    *Nauj? ?raš? prid?jimas vykdomas per iššokant? lang? su AJAX. ?rašai prisideda realiu laiku.
    *?raš? redagavimas vykdomas per iššokant? lang? su AJAX.
    *?raš? trynimas vykdomas su Ajax. ?rašai išsitrina realiu laiku.
    * 'Show' mygtukas atvaizduoja informacij? apie ?raš? iššokan?iame lange su AJAX.
Papildoma:
 Suprogramuoti keli? ?raš? ištrynim? vienu metu.