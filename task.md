# Zazdanie - Napisanie programu PHP

## Aplikacja ma za zadanie udostępnić publicznie 2 adresy http:
1. /health - powinien obsługiwać tylko metodę HTTP GET, i zwracać zawsze HTTP code 204, w przypadku innej metody powinien zwrócić odpowiedni code który o tym informuje
2. /file/[NAZWA_PLIKU].[ROZSZERZENIE_PLIKU] np. /file/some-file.txt - powinien obsługiwać tylko metodę HTTP GET
* ten adres ma zadanie zapisać plik o podanej nazwie i rozszerzeniu na dysku oraz go zwrócic w odpowiedzi do użytkownika
* adres ma obsługiwać tylko rozszerzenia .txt oraz .json; niech w treści pliku będzie informacja o jego nazwie oraz data i czas zapisania.
---
### Trzeba rozważyć (wymagane):
* jeśli plik istnieje, aplikacja zwraca go zamiast generować (plik nie może być nadpisywany)
* wygenerowane pliki nie powinny być dostępne w inny sposób niż przez utworzony url
* jeśli kilku użytkowników próbuje naraz wygenerować ten sam plik, aplikacja generuje go tylko 1 raz, i każdemu zwraca poprawnie odpowiedź
---
### Opcjonalnie (niewymagane):
* testy automatyczne, które sprawdzą poprawność działanie aplikacji
* dostęp do aplikacji niepubliczny (z wyjątkiem /health) - tylko dla użytkowników autoryzowanych np. takich co posiadają token dostępu

---

### Jak będziemy oceniać

* Głównie zwrócimy uwagę na architekturę aplikacji - ale nic na siłę
* Nie ma też co spędzać nad tym przesadnie dużo czasu

---

### Inne
* Jak chcesz coś dopytać do pisz smiało, albo coś dla Ciebie nie jest jasne lub jest niespojność w treści zadania wymagająca doprecyzowania naszych oczekiwań