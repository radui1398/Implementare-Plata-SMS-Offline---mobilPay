## Implementare Sistem de Plata Offline - mobilPay

Pentru a implementa plata offline trebuie sa adaugam un 
produs/serviciu in contul nostru de comerciant.<br>
Acest lucru se poate realiza din contul de administrare astfel:<br>
<code>Admin->Conturi de comerciant->Produse/Servicii->Adauga</code>

___
Cand adaugam produsul/serviciul setam tipul acestuia la **Offline**.<br>
Cuvantul cheie va fi mesajul ce trebuie trimis pentru a accesa serviciul/produsul, iar
adresa pentru procesarea comenzilor este URL-ul catre fisier-ul <code>smsConfirm.php</code>.
<br><br>
## Testare:

Pentru a testa daca implementarea functioneaza corect, sincronizam contul mobilPay cu contul 
de sandBox. Sincronizarea se realizeaza  astfel: <br>
<code>Admin->Conturi de comerciant->Modifica->Sincronizare</code> 
---
Dupa sincronizare in contul de sandbox mergem la:<br>
<code>Implementare->Simulator</code><br>
Mai mult detalii despre simulator
<a href="https://suport.mobilpay.ro/index.php?/Knowledgebase/Article/View/47/12/cum-folosesc-simulatorul-de-plati-prin-sms">aici</a>.
<br>

## Exemplu de folosire:
+ Clientul trimite un mesaj cu textul "abcd" la numarul de telefon "####", numar si text specificat de noi;
+ In fisierul `smsConfirm` generam un cod random din 5 cifre;
+ Acest cod, il inseram in baza de date cu statusul de "pending";
+ Trimitem acelasi cod clientului;
+ Clientul foloseste un formular de pe site pentru a obtine produsul cu ajutorul codului
primit
+ Verificam codul oferit de client:
    + Daca gasim codul in baza noastra de date, oferim produsul.
    + Daca nu este gasit atunci afisam un mesaj de eroare.