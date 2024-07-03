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

## Projekt Embedded i Aplikacja Webowa

Aplikacja webowa jest częścią większego projektu MeteoStation, który składa się z dwóch głównych komponentów:
1. **Część Embedded**: Zbieranie i przesyłanie danych z czujników przy użyciu mikrokontrolera STM32F303RE i modułu WiFi ESP-01s. Więcej informacji znajduje się w [MeteoStation_STM32](https://github.com/Ola2195/MeteoStation_STM32), czyli repozytorium aplikacji Stacja Meteo z Wykorzystaniem Technologii IoT - Embedded.
2. **Aplikacja Webowa**: Prezentacja i analiza zebranych danych w przeglądarce internetowej.

Sure, here is the translated version:

---

# IoT Weather Station - Web Application

## Project Description

A web application for monitoring atmospheric conditions, part of the larger MeteoStation project. The system collects data from sensors using the STM32F303RE microcontroller and the ESP-01s WiFi module, and then stores it in a MySQL database. The application displays current and historical measurements, including temperature, humidity, and light intensity.

## Project Goal

The goal of the project is to enable users to monitor and analyze atmospheric conditions in real-time. In this version of the application, only the temperature sensor is integrated, but the system's architecture allows for easy addition of other sensors in the future.

## Features

- Display current temperature.
- Historical measurements in list format.
- Interactive temperature chart using Chart.js.
- Automatic data refresh every 20 seconds.

## Project Structure

- `index.php`: Main HTML file generating the user interface. Displays current measurements and the measurement history.
- `style.css`: Stylesheet responsible for the aesthetics and layout of the user interface.
- `db_connect.php`: PHP file responsible for connecting to the MySQL database and retrieving measurement data.
- `insert_data.php`: PHP file for receiving measurement data from the microcontroller and storing it in the database.

## Requirements

- Web server with PHP support (e.g., Apache).
- MySQL database.

## Installation

1. Configure the MySQL database:
    - Create a database named `meteostation`.
    - Create a `measurements` table:
    ```sql
    CREATE TABLE measurements (
        id INT AUTO_INCREMENT PRIMARY KEY,
        temperature DECIMAL(6, 2) NOT NULL,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

2. Configure `db_connect.php`:
    - Ensure that the database connection details (host, user, password, database name) are correct.

3. Place the project files on your web server.

## Usage

- Visit the application's main page in a web browser.
- The page will automatically refresh every 20 seconds to display the latest data.
- The temperature chart is updated based on historical measurements.

## Embedded Project and Web Application

The web application is part of the larger MeteoStation project, which consists of two main components:
1. **Embedded Component**: Collecting and transmitting data from sensors using the STM32F303RE microcontroller and the ESP-01s WiFi module. More information can be found in the [MeteoStation_STM32](https://github.com/Ola2195/MeteoStation_STM32) repository, which is the repository for the IoT Weather Station - Embedded.
2. **Web Application**: Presenting and analyzing the collected data in a web browser.
