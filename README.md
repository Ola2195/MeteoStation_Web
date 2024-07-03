# Stacja Meteo z Wykorzystaniem Technologii IoT - Aplikacja Webowa

## Opis Projektu

Aplikacja webowa do monitorowania warunków atmosferycznych, będąca częścią większego projektu MeteoStation. System zbiera dane z czujników za pomocą mikrokontrolera STM32F303RE i modułu WiFi ESP-01s, a następnie przechowuje je w bazie danych MySQL. Aplikacja wyświetla aktualne i historyczne pomiary, w tym temperaturę, wilgotność i natężenie światła.

## Cel Projektu

Celem projektu jest umożliwienie użytkownikom monitorowania i analizy warunków atmosferycznych w czasie rzeczywistym. W tej wersji aplikacji zintegrowano tylko czujnik temperatury, ale architektura systemu pozwala na łatwe dodanie innych czujników w przyszłości.

## Funkcje

- Wyświetlanie aktualnej temperatury.
- Historia pomiarów w formie listy.
- Interaktywny wykres temperatury z wykorzystaniem biblioteki Chart.js.
- Automatyczne odświeżanie danych co 20 sekund.

## Struktura Projektu

- `index.php`: Główny plik HTML generujący interfejs użytkownika. Wyświetla aktualne pomiary oraz historię pomiarów.
- `style.css`: Arkusz stylów odpowiedzialny za estetykę i układ interfejsu użytkownika.
- `db_connect.php`: Plik PHP odpowiedzialny za nawiązanie połączenia z bazą danych MySQL oraz pobieranie danych pomiarowych.
- `insert_data.php`: Plik PHP do odbierania danych pomiarowych z mikrokontrolera i zapisywania ich w bazie danych.

## Wymagania

- Serwer webowy z obsługą PHP (np. Apache).
- Baza danych MySQL.

## Instalacja

1. Skonfiguruj bazę danych MySQL:
    - Utwórz bazę danych o nazwie `meteostation`.
    - Utwórz tabelę `measurements`:
    ```sql
    CREATE TABLE measurements (
        id INT AUTO_INCREMENT PRIMARY KEY,
        temperature FLOAT NOT NULL,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

3. Skonfiguruj plik `db_connect.php`:
    - Upewnij się, że dane do połączenia z bazą danych (host, użytkownik, hasło, nazwa bazy danych) są poprawne.

4. Umieść pliki projektu na swoim serwerze webowym.

## Użycie

- Odwiedź stronę główną aplikacji w przeglądarce internetowej.
- Strona automatycznie odświeża się co 20 sekund, aby wyświetlić najnowsze dane.
- Wykres temperatury jest aktualizowany na podstawie historycznych pomiarów.

## Projekt Embedded

Aplikacja webowa jest częścią większego projektu MeteoStation, który składa się z dwóch głównych komponentów:
1. **Część Embedded**: Zbieranie i przesyłanie danych z czujników przy użyciu mikrokontrolera STM32F303RE i modułu WiFi ESP-01s. Więcej informacji znajduje się w [MeteoStation_STM32](https://github.com/Ola2195/MeteoStation_STM32), czyli repozytorium aplikacji Stacja Meteo z Wykorzystaniem Technologii IoT - Embedded.
2. **Aplikacja Webowa**: Prezentacja i analiza zebranych danych w przeglądarce internetowej.
