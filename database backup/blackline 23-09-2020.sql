-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 23 Wrz 2020, 09:06
-- Wersja serwera: 5.7.31-0ubuntu0.18.04.1
-- Wersja PHP: 7.1.33-16+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `blackline`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_publication` datetime DEFAULT NULL,
  `visit_daily` int(11) NOT NULL DEFAULT '0',
  `visit_monthly` int(11) NOT NULL DEFAULT '0',
  `visit_yearly` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `articles`
--

INSERT INTO `articles` (`article_id`, `author_id`, `title`, `content`, `date_added`, `date_publication`, `visit_daily`, `visit_monthly`, `visit_yearly`) VALUES
(4, 11, 'a', 'a', '2020-09-14 08:18:44', '2020-09-14 10:18:44', 0, 0, 0),
(5, 12, 'Anoreksja. Jeść czy nie jeść?', 'Anoreksja. Jeść czy nie jeść?', '2020-09-14 08:22:08', '2020-09-11 06:52:03', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles_authors`
--

CREATE TABLE `articles_authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `articles_authors`
--

INSERT INTO `articles_authors` (`author_id`, `author_name`) VALUES
(11, 'a'),
(12, '2020-09-11 06:52:03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `definitions`
--

CREATE TABLE `definitions` (
  `definition_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visit_daily` int(11) NOT NULL DEFAULT '0',
  `visit_monthly` int(11) NOT NULL DEFAULT '0',
  `visit_yearly` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `definitions_authors`
--

CREATE TABLE `definitions_authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `quotes`
--

CREATE TABLE `quotes` (
  `quote_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visit_daily` int(11) NOT NULL DEFAULT '0',
  `visit_monthly` int(11) NOT NULL DEFAULT '0',
  `visit_yearly` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `quotes`
--

INSERT INTO `quotes` (`quote_id`, `author_id`, `content`, `translation`, `date_added`, `visit_daily`, `visit_monthly`, `visit_yearly`) VALUES
(22, 17, 'Prawdziwych przyjaciół poznaje się w biedzie. ', '', '2020-08-28 09:20:36', 0, 0, 0),
(23, 18, 'Ktoś wygasił mi oczy, jak reflektory w teatrze. Usta się śmieją, a oczy cierpią. ', '', '2020-08-28 09:20:55', 0, 0, 0),
(24, 19, 'Przyszłość będzie szczodra jedynie wtedy, gdy wszystko ofiarujesz teraźniejszości. ', '', '2020-08-28 09:21:11', 0, 0, 0),
(25, 19, 'Być wolnym to móc nie kłamać. ', '', '2020-08-28 09:21:23', 0, 0, 0),
(26, 20, 'Najcenniejszych rzeczy w życiu nie nabywa się za pieniądze', '', '2020-08-28 09:21:35', 0, 0, 0),
(27, 20, 'Szaleństwem jest robić wciąż to samo i oczekiwać różnych rezultatów', '', '2020-08-28 09:21:51', 0, 0, 0),
(28, 20, 'Wyobraźnia bez wiedzy może stworzyć rzeczy piękne. Wiedza bez wyobraźni najwyżej doskonałe. ', '', '2020-08-28 09:22:14', 0, 0, 0),
(29, 20, 'Jeśli nie potrafisz wyjaśnić czegoś prosto, nie rozumiesz tego wystarczająco dobrze. ', '', '2020-08-28 09:22:31', 0, 0, 0),
(30, 20, 'Są dwie drogi, aby przeżyć życie. Jedna to żyć tak, jakby nic nie było cudem. Druga to żyć tak, jakby cudem było wszystko. ', '', '2020-08-28 09:22:44', 0, 0, 0),
(31, 21, 'Przyjaźń z całym światem zaczyna się od przyjaźni z najbliższym otoczeniem. ', '', '2020-08-28 09:23:02', 0, 0, 0),
(32, 22, '[...] albowiem niepewność jest najstraszliwszą ze wszystkich tortur. ', '', '2020-08-28 09:23:23', 0, 0, 0),
(33, 22, '[...] zła najczęściej nie da się naprawić; możemy je tylko pomścić. ', '', '2020-08-28 09:23:37', 0, 0, 0),
(34, 23, 'Przyjaciół kochamy dla ich wad, bo lubimy, gdy ktoś też ma wady. ', '', '2020-08-28 09:23:54', 0, 0, 0),
(35, 24, 'Czasami uważamy kogoś za przyjaciela i okazuje się, że to jednak prawda', '', '2020-08-28 09:24:10', 0, 0, 0),
(36, 25, 'Wszyscy jesteśmy pomyleni, ale tego, kto umie analizować swoje urojenia, nazywa się filozofem. ', '', '2020-08-28 09:24:27', 0, 0, 0),
(37, 26, 'Lepiej zaliczać się do niektórych niż do wszystkich. ', '', '2020-08-28 09:24:46', 0, 0, 0),
(38, 27, 'To nic złego być tym, kim jesteś i być tego świadomym, ponieważ sama świadomość jest szczęściem. ', '', '2020-08-28 09:25:05', 0, 0, 0),
(39, 28, 'Sposobem na podejmowanie lepszych decyzji jest podejmowanie ich częściej', '', '2020-08-28 09:25:21', 0, 0, 0),
(40, 29, 'Prawdziwa miłość nie wyczerpuje się nigdy. Im więcej dajesz, tym więcej ci jej zostaje. ', '', '2020-08-28 09:25:39', 0, 0, 0),
(41, 29, 'Mowa jest źródłem nieporozumień. ', '', '2020-08-28 09:25:54', 0, 0, 0),
(42, 30, 'Dziewięć dziesiątych naszego szczęścia polega na zdrowiu. Zdrowy żebrak jest szczęśliwszy niż chory król. ', '', '2020-08-28 09:26:16', 0, 0, 0),
(43, 31, 'Najważniejszą rzeczą jest, aby cieszyć się swoim życiem – być szczęśliwym – tylko to się liczy. ', '', '2020-08-28 09:26:55', 0, 0, 0),
(44, 32, 'Sztuka życia polega mniej na eliminowaniu naszych problemów, a bardziej na rozwijaniu się dzięki nim. ', '', '2020-08-28 09:27:07', 0, 0, 0),
(45, 33, 'Kto walczy, może przegrać. Kto nie walczy, już przegrał. ', '', '2020-08-28 09:27:29', 0, 0, 0),
(46, 34, 'Nigdy nie wiesz jak jesteś silny, dopóki bycie silnym nie jest jedynym wyjściem, jakie Ci zostaje. ', '', '2020-08-28 09:27:50', 0, 0, 0),
(47, 35, 'Wyjdź ze swojej strefy komfortu. Możesz wzrastać tylko, jeśli jesteś gotów czuć się dziwnie i niekomfortowo, próbując czegoś zupełnie dla Ciebie nowego. ', '', '2020-08-28 09:31:21', 0, 0, 0),
(49, 35, 'Aby więcej zarabiać, musisz się więcej nauczyć. ', '', '2020-08-28 09:31:58', 0, 0, 0),
(50, 37, 'W konfrontacji strumienia ze skałą, strumień zawsze wygrywa – nie przez swoją siłę, ale przez wytrwałość. ', '', '2020-08-28 09:32:08', 0, 0, 0),
(51, 38, 'Dorosłość prawdziwa oznacza radość i zrozumienie dla dziecka wewnątrz dorosłości', '', '2020-09-06 09:07:17', 0, 0, 0),
(52, 38, 'Nie zdążysz być w pełni dorosłym, jeśli nie zdążyłeś być w pełni dzieckiem', '', '2020-09-06 09:10:53', 0, 0, 0),
(53, 38, 'Zadaj sobie pytanie... Jaka jest Twoja pierwsza myśl po przebudzeniu? - a być może zrozumiesz sens swych porażek', '', '2020-09-06 09:11:54', 0, 0, 0),
(54, 38, 'Cholerny nowy dzień nastał... Co się gapisz? Mówię, że nastał. Nie powiedziałem jak go przeżyć.', '', '2020-09-06 09:12:42', 0, 0, 0),
(55, 38, 'Sądzisz że z natury jesteś wspaniały, niepowtarzalny, uwielbiany, mądry i wszechstronny... Sądzisz... Ja natomiast jestem pewna, że żyję. Reszta zależy od moich starań.', '', '2020-09-06 09:14:18', 0, 0, 0),
(56, 38, 'Przyjacielu... Po co Ci piękno, miłość, emocje, marzenia, frustracje, sukcesy, tęsknoty, dążenia i pasje... Masz przecież Facebooka.', '', '2020-09-06 09:15:11', 0, 0, 0),
(57, 38, 'Horoskopy są dla głupców - Rzeczywistość tworzą wizjonerzy... A ty  kim jesteś? Lokomotywą, czy wagonem?', '', '2020-09-06 09:15:59', 0, 0, 0),
(58, 38, 'Damulko mierna a strojna w boskości, lśniąca, uwielbiasz siebie samą... Ja natomiast widzę i słyszę, dlaczego stoję w cieniu...', '', '2020-09-06 09:17:21', 0, 0, 0),
(59, 39, 'Lubię ludzi, akceptuję ich, ale... Nie toleruję ich zachowań.', '', '2020-09-06 09:18:02', 0, 0, 0),
(60, 35, 'Jeśli nie ustalasz celów dla siebie, jesteś skazany na pracowanie przy osiąganiu celów kogoś innego. ', '', '2020-09-06 09:23:38', 0, 0, 0),
(61, 38, 'Hej! Lalka! Jesteś tak doskonale perfekcyjna, we własnym sosie zadufana, iż nie potrzebujesz tlenu... Ja natomiast mam okno, by przewietrzyć mózg', '', '2020-09-06 09:26:28', 0, 0, 0),
(62, 40, 'Zdolność słuchania jest połową sukcesu.', '', '2020-09-07 10:27:04', 0, 0, 0),
(64, 42, 'Wszystko, co irytuje nas w innych może nas zaprowadzić do zrozumienia samego siebie. ', '', '2020-09-07 10:27:30', 0, 0, 0),
(66, 43, 'W fabryce produkujemy kosmetyki, w sklepie sprzedajemy nadzieję.', '', '2020-09-07 10:27:56', 0, 0, 0),
(68, 45, 'Nie trzeba żadnych świątyń, nie trzeba skomplikowanej filozofii. Nasz mózg i nasze serce są naszą świątynią; moją filozofią jest dobroć. ', '', '2020-09-07 10:28:25', 0, 0, 0),
(69, 46, 'Jedyny sposób, aby zwyciężyć w kłótni, to unikać jej.', '', '2020-09-07 10:28:40', 0, 0, 0),
(70, 46, 'Jedynym sposobem wywarcia wpływu na drugiego człowieka jest rozmowa o jego pragnieniach i pokazanie mu, jak je może spełnić.', '', '2020-09-07 10:28:59', 0, 0, 0),
(71, 46, 'W dwa miesiące możesz zdobyć więcej przyjaciół, interesując się innymi ludźmi, niż w ciągu dwóch lat, usiłując zainteresować sobą innych.', '', '2020-09-07 10:29:18', 0, 0, 0),
(73, 48, 'Słyszeć nie znaczy słuchać, bo słuch jest zmysłem, a słuchanie sztuką.', '', '2020-09-07 10:29:47', 0, 0, 0),
(74, 49, 'Przyjaźń jednego roztropnego człowieka jest bardziej wartościowa niż przyjaźń wszystkich głupców.', '', '2020-09-07 10:30:00', 0, 0, 0),
(75, 50, 'Ludzie mówią, że bez miłości nie da się żyć. Osobiście uważam, że tlen jest ważniejszy.', '', '2020-09-07 10:30:16', 0, 0, 0),
(76, 51, 'Jeśli doprowadzisz do porządku własne wnętrze, to, co na zewnątrz, samo ułoży się we właściwy sposób.', '', '2020-09-07 10:30:52', 0, 0, 0),
(77, 52, 'Ilekroć sprostasz trudnej sytuacji, takiej, która, jak sądziłeś, po prostu nie może się zdarzyć, to nawet jeśli cierpiałeś męki potępieńca, poczujesz się bardziej wolny, niż byłeś.', '', '2020-09-07 10:31:02', 0, 0, 0),
(78, 53, 'Przyjaźń jest największym darem, jaki mądrość może ofiarować, aby uczynić całe życie szczęśliwym.', '', '2020-09-07 10:31:25', 0, 0, 0),
(79, 54, 'Nie jest bogatym ten, kto duża ma, lecz ten, kto dużo daje.\n', '', '2020-09-07 10:31:41', 0, 0, 0),
(80, 55, 'Pamiętaj, że każdy napotkany człowiek czegoś się boi, coś kocha i coś stracił.', '', '2020-09-07 10:31:55', 0, 0, 0),
(81, 56, 'Sukces jest wynikiem właściwej decyzji. ', '', '2020-09-07 10:32:08', 0, 0, 0),
(83, 58, 'Wesołość jest buntem przeciwko tragedii życia. Jedynym buntem o pozorach zwycięstwa.', '', '2020-09-08 05:46:54', 0, 0, 0),
(84, 59, 'Najlepszą zemstą jest ogromny sukces.', '', '2020-09-08 05:47:07', 0, 0, 0),
(85, 60, 'Logiczne myślenie to próbka fikcji absolutnej.', '', '2020-09-08 05:47:22', 0, 0, 0),
(86, 60, 'A ci, którzy tańczyli, zostali uznani za szalonych przez tych, którzy nie słyszeli.', '', '2020-09-08 05:47:35', 0, 0, 0),
(87, 61, 'Wiele tracimy wskutek tego, że przedwcześnie uznajemy coś za stracone.', '', '2020-09-08 05:47:49', 0, 0, 0),
(88, 62, 'Niebawem zrozumiesz, że to, co dziś wygląda jak poświęcenie, okaże się, że zamiast tego, najwspanialszą inwestycją, jaką kiedykolwiek zrobisz.', '', '2020-09-08 05:48:03', 0, 0, 0),
(89, 63, 'Kto mówi językiem niezrozumiałym dla nikogo poza nim, nie mówi w ogóle. Mówić, to mówić do kogoś.', '', '2020-09-08 05:48:23', 0, 0, 0),
(90, 64, 'Najlepszy sposób na osiągnięcie sukcesu, to postępować według rad, które dajemy innym. ', '', '2020-09-08 05:48:37', 0, 0, 0),
(91, 65, 'Słowa są skrzydłami umysłu.', '', '2020-09-08 07:12:38', 0, 0, 0),
(92, 66, 'Jednym z największych odkryć, jakie uczynił człowiek i jedną z największych dla niego niespodzianek jest odkrycie, że może on uczynić to, o czym ze strachem sądził, że nie potrafi uczynić', '', '2020-09-08 07:12:53', 0, 0, 0),
(93, 66, 'Jeżeli istnieje jakiś jeden sekret sukcesu, to jest to umiejętność przyjmowania cudzego punktu widzenia i patrzenia z tej perspektywy z równą łatwością jak z własnej.', '', '2020-09-08 07:13:09', 0, 0, 0),
(94, 66, 'Każdy, kto przestaje się uczyć jest stary, bez względu na to, czy ma 20 czy 80 lat. Kto kontynuuje naukę pozostaje młody. Najwspanialszą rzeczą w życiu jest utrzymywanie swojego umysłu młodym.', '', '2020-09-08 07:13:22', 0, 0, 0),
(95, 66, 'Patrząc zawsze przed siebie, myśląc o tym, jak zrobić jeszcze więcej, osiągniesz stan umysłu, w którym nie ma rzeczy niemożliwych.', '', '2020-09-08 07:13:33', 0, 0, 0),
(96, 66, 'Żadne zadanie nie jest szczególnie trudne, jeśli podzielisz je na mniejsze podzadania.', '', '2020-09-08 07:13:55', 0, 0, 0),
(97, 66, 'Myślenie to najcięższa praca z możliwych i pewnie dlatego tak niewielu ją podejmuje.', '', '2020-09-08 07:14:08', 0, 0, 0),
(98, 67, 'Uśmiech to bodaj najkrótsza droga do drugiego człowieka.', '', '2020-09-08 07:14:23', 0, 0, 0),
(100, 69, 'Szlachetne zdrowie, Nikt się nie dowie, Jako smakujesz, Aż się zepsujesz…', '', '2020-09-08 09:08:30', 0, 0, 0),
(102, 71, 'Myśl o przeszłości tylko wtedy, kiedy może ci ona sprawić przyjemność.', '', '2020-09-08 09:08:51', 0, 0, 0),
(103, 72, 'Nie czyń siebie samego przedmiotem kompromisu, bo jesteś wszystkim, co masz.', '', '2020-09-08 09:09:05', 0, 0, 0),
(104, 73, 'Standardowa edukacja zapewni Ci przeżycie. Samokształcenie – fortunę.', '', '2020-09-08 09:09:21', 0, 0, 0),
(105, 73, 'Motywacja jest tym, co pozwala Ci zacząć. Nawyk jest tym, co pozwala Ci wytrwać.', '', '2020-09-08 09:10:10', 0, 0, 0),
(106, 74, 'Talent rośnie w samotności, charakter wśród ludzi.', '', '2020-09-08 09:10:25', 0, 0, 0),
(107, 75, 'Umiejętność komunikowania się, stała się w dzisiejszym świecie towarem, za który gotów jestem płacić więcej niż za jakikolwiek inny.', '', '2020-09-08 09:10:38', 0, 0, 0),
(108, 76, 'Ktokolwiek wierzy w sprawiedliwość na świecie, ten jest fałszywie poinformowany.', '', '2020-09-08 09:10:50', 0, 0, 0),
(109, 77, 'Tam gdzie jest wolność pojawia się uśmiech. Nie istnieje on tylko w totalitarnym świecie.', '', '2020-09-08 09:11:05', 0, 0, 0),
(110, 78, 'Trochę miłości to jak trochę dobrego wina. Nadmiar jednego lub drugiego szkodzi zdrowiu.', '', '2020-09-08 09:11:18', 0, 0, 0),
(111, 79, 'Cierpliwość i wytrwałość mają magiczne działanie – dzięki nim trudności znikają, a przeszkody ulatniają się.', '', '2020-09-08 09:11:32', 0, 0, 0),
(112, 80, 'Przestaliśmy szukać potworów pod naszymi łóżkami, gdy zrozumieliśmy, że one są w nas.\n', '', '2020-09-08 09:11:53', 0, 0, 0),
(113, 81, 'Zawsze bądź pierwszorzędną wersją siebie, zamiast być kiepską kopią kogoś innego.', '', '2020-09-08 09:12:06', 0, 0, 0),
(114, 82, 'Milczenie to tekst, który niezwykle łatwo jest błędnie zinterpretować.', '', '2020-09-08 09:12:25', 0, 0, 0),
(116, 84, 'Wybierz pracę, którą kochasz, a nie będziesz musiał pracować nawet przez jeden dzień w swoim życiu.', '', '2020-09-08 09:13:08', 0, 0, 0),
(117, 85, 'Drzewo, którego nie możesz objąć ramionami, było kiedyś małym nasionkiem. Stumilowa podróż zaczyna się od jednego małego kroku.', '', '2020-09-08 09:13:27', 0, 0, 0),
(118, 86, 'W centrum twojej istoty masz odpowiedź. Ty wiesz, kim jesteś i wiesz, co chcesz.', '', '2020-09-08 09:13:57', 0, 0, 0),
(119, 87, 'Podejmując nowe wyzwania odkrywamy w sobie umiejętności, których istnienia nigdy nie podejrzewaliśmy.', '', '2020-09-08 09:14:10', 0, 0, 0),
(120, 88, 'Wieczna omyłka, jakiej ulegają ludzie, to utożsamienie szczęścia ze spełnieniem marzeń.', '', '2020-09-08 09:14:29', 0, 0, 0),
(121, 88, 'Wszyscy myślą o tym aby zmienić świat ale nikt nie pomyśli o tym aby zmienić siebie.', '', '2020-09-08 09:14:46', 0, 0, 0),
(122, 89, 'Nikt nie zna granic swoich możliwości, dopóki ich nie przekroczy.', '', '2020-09-08 09:15:00', 0, 0, 0),
(123, 90, 'Świat jest dość zasobny, aby zaspokoić potrzeby wszystkich, lecz nie dość zasobny, by zaspokoić chciwość każdego.', '', '2020-09-08 09:15:21', 0, 0, 0),
(124, 90, 'Miłość jest czymś najmocniejszym na świecie, a jednak nie można wyobrazić sobie nic bardziej skromnego.', '', '2020-09-08 09:15:38', 0, 0, 0),
(125, 91, 'Zbyt wielu ludzi przecenia to, kim nie jest i nie docenia tego, kim jest.', '', '2020-09-08 09:15:54', 0, 0, 0),
(126, 92, 'Niczego w życiu nie należy się bać, należy to tylko rozumieć.', '', '2020-09-08 09:16:04', 0, 0, 0),
(127, 93, 'Spędziłem większość życia, martwiąc się o rzeczy, które nigdy się nie wydarzył.', '', '2020-09-08 09:16:20', 0, 0, 0),
(128, 93, 'Nie narzekaj, że masz pod górę, gdy zmierzasz na szczyt.', '', '2020-09-08 09:16:47', 0, 0, 0),
(129, 93, 'Bądźmy wdzięczni idiotom. Gdyby nie oni, reszta nigdy nie osiągnęłaby sukcesu.', '', '2020-09-08 09:18:56', 0, 0, 0),
(130, 94, 'Kreatywność to wymyślanie, eksperymentowanie, wzrastanie, ryzykowanie, łamanie zasad, popełnianie błędów i dobra zabawa.', '', '2020-09-08 09:19:38', 0, 0, 0),
(131, 95, 'Nie czekaj, aż pojawi się coś dużego. Zacznij w tym miejscu, w którym się znajdujesz, z tym, co masz, a zawsze dojdziesz do czegoś wspaniałego.', '', '2020-09-08 09:19:55', 0, 0, 0),
(132, 96, 'Chęć stania się kimś innym jest marnotrawstwem osoby, którą jesteś.', '', '2020-09-08 09:20:15', 0, 0, 0),
(133, 97, 'Coś co czyni Cię inną albo wręcz dziwną - to właśnie jest Twoją siłą.', '', '2020-09-08 09:20:32', 0, 0, 0),
(134, 98, 'Wszyscy są tacy sami w swoich obietnicach. Różnią się tylko w swoich uczynkach.', '', '2020-09-08 09:20:52', 0, 0, 0),
(135, 98, 'Jeśli potrafisz śmiać się z siebie: to najlepszy dowód, że masz poczucie humoru.', '', '2020-09-08 09:21:10', 0, 0, 0),
(136, 99, 'Sukces jest najgłośniejszym mówcą świata.', '', '2020-09-08 09:21:22', 0, 0, 0),
(137, 100, 'Ludzie odnoszący sukcesy, mają odnoszące sukces nawyki.', '', '2020-09-08 09:21:36', 0, 0, 0),
(138, 101, 'Bądź sobą; wszyscy inni są już zajęci.', '', '2020-09-08 09:22:05', 0, 0, 0),
(139, 101, 'Gdy popełnia się błędy, mówi się chętnie, że zbiera się doświadczenie.', '', '2020-09-08 09:22:20', 0, 0, 0),
(140, 102, 'Wśród ludzi jest więcej kopii niż oryginałów.', '', '2020-09-08 09:22:32', 0, 0, 0),
(141, 103, 'Tajemnica szczęścia ukryta jest w tym, by widzieć wszystkie cuda świata i nigdy nie zapomnieć o dwóch kroplach oliwy na łyżce.', '', '2020-09-08 09:22:52', 0, 0, 0),
(142, 103, 'To możliwość spełnienia marzeń sprawia, że życie jest tak fascynujące.', '', '2020-09-08 09:23:07', 0, 0, 0),
(143, 104, 'Za każdym razem, kiedy widzisz biznes, który odnosi sukces, oznacza to, że ktoś kiedyś podjął odważną decyzję.', '', '2020-09-08 09:23:23', 0, 0, 0),
(144, 105, 'Tak postępuj z przyjaciółmi, aby nie stali się nieprzyjaciółmi, a z nieprzyjaciółmi tak, żeby jak najprędzej stali się tobie przyjaciółmi. ', '', '2020-09-08 09:23:40', 0, 0, 0),
(145, 105, 'U przyjaciół wszystko jest wspólne.', '', '2020-09-08 09:23:50', 0, 0, 0),
(146, 105, 'Musisz sam sobie zaufać, aby zaufali ci inni.', '', '2020-09-08 09:24:01', 0, 0, 0),
(147, 105, 'Wielką jest mądrością umieć znosić głupotę innych.', '', '2020-09-08 09:24:14', 0, 0, 0),
(148, 106, 'Zdobywać majątek za cenę zdrowia znaczy to samo, co odciąć sobie nogi, by kupić za nie parę butów.', '', '2020-09-08 09:24:34', 0, 0, 0),
(149, 107, 'Przyjaciel – ktoś, przed kim można głośno myśleć.', '', '2020-09-08 09:24:56', 0, 0, 0),
(150, 107, 'Nie podążaj tam gdzie wiedzie ścieżka. Zamiast tego pójdź tam gdzie jej nie ma i wytycz szlak.', '', '2020-09-08 09:25:11', 0, 0, 0),
(151, 108, 'Wystarczy tylko się uśmiechać, by ukryć zranioną duszę i nikt nawet nie zauważy, jak bardzo cierpisz.', '', '2020-09-08 09:25:28', 0, 0, 0),
(152, 109, 'Przyjaźń należy do natury ducha, a nie posiadania.', '', '2020-09-08 09:25:41', 0, 0, 0),
(153, 110, 'Przyjaźń jest subtelną rozkoszą szlachetnych dusz.', '', '2020-09-08 09:25:57', 0, 0, 0),
(154, 111, 'Najważniejsze jest najbliższe pięć minut. Reszta to wyobraźnia.', '', '2020-09-08 09:26:12', 0, 0, 0),
(155, 112, 'Błąd jest przywilejem filozofów, tylko głupcy nie mylą się nigdy.', '', '2020-09-08 09:26:21', 0, 0, 0),
(156, 112, 'Szczęście to przyjemność, której się nie żałuje.', '', '2020-09-08 09:26:32', 0, 0, 0),
(157, 113, 'Jakie jest przeznaczenie człowieka? Być nim.', '', '2020-09-08 09:26:43', 0, 0, 0),
(158, 113, 'Wszyscy chcą Twojego dobra. Nie pozwól go sobie odebrać.', '', '2020-09-08 09:27:02', 0, 0, 0),
(159, 114, 'Do najprzyjemniejszych momentów w życiu nalezą te, kiedy nie możesz przestać uśmiechać się po spotkaniu lub rozmowie.', '', '2020-09-08 09:27:17', 0, 0, 0),
(160, 115, 'Gniew rodzi się tylko z niespełnionych pragnień. Nie oczekuję niczego od innych ludzi, toteż ich postępowanie nie może być sprzeczne z moimi życzeniami.', '', '2020-09-08 09:28:29', 0, 0, 0),
(161, 116, 'Doświadczenie uczy nas, że dzięki długiemu błądzeniu odkrywamy krótszą drogę.', '', '2020-09-08 09:28:43', 0, 0, 0),
(162, 117, 'Jakość podróży mierzy się w liczbie poznanych przyjaciół, a nie przejechanych kilometrach.', '', '2020-09-08 09:28:54', 0, 0, 0),
(163, 118, 'Ci, co wygrywają – nigdy nie odpuszczają. Ci, co odpuszczają – nigdy nie wygrywają…', '', '2020-09-08 09:29:09', 0, 0, 0),
(164, 119, 'Tylko ludzie o wielkich zaletach serca mają przyjaciół.', '', '2020-09-08 09:29:23', 0, 0, 0),
(165, 120, 'Nie ma ważniejszego zadania, jak być miłym i pełnym uroku. Krzewić radość, promieniować szczęściem, rozlewać jasność na ciemnych drogach życia… Czyż nie jest to największa przysługa dla innych?', '', '2020-09-08 09:29:43', 0, 0, 0),
(166, 121, 'Ważniejsze jest bycie ludzkim, a nie ważnym.', '', '2020-09-08 09:29:55', 0, 0, 0),
(167, 122, 'Sukces wydaje się być w dużej mierze kwestią wytrwania, gdy inni rezygnują.', '', '2020-09-08 09:30:05', 0, 0, 0),
(168, 123, 'Doniosłe wynalazki powstają w laboratorium, wspaniały produkt natomiast – w dziale marketingu.', '', '2020-09-08 09:30:18', 0, 0, 0),
(169, 124, 'Nie śmiejemy się dlatego, że jesteśmy szczęśliwi. Jesteśmy szczęśliwi, dlatego, że się śmiejemy.', '', '2020-09-08 09:30:32', 0, 0, 0),
(170, 125, 'Życie nie jest ani lepsze ani gorsze od naszych marzeń – jest tylko zupełnie inne.', '', '2020-09-08 09:30:51', 0, 0, 0),
(171, 125, 'Idź mądrze i powoli. Ci, którzy pędzą, potykają się i upadają.', '', '2020-09-08 09:31:06', 0, 0, 0),
(172, 126, 'Krytykować może każdy głupiec. I wielu to robi', '', '2020-09-08 09:31:25', 0, 0, 0),
(173, 126, 'Nigdy, nigdy, nigdy, nigdy się nie poddawaj.', '', '2020-09-08 09:31:35', 0, 0, 0),
(174, 127, 'Żyjemy dłużej, ale mniej dokładnie i krótszymi zdaniami.', '', '2020-09-08 09:31:48', 0, 0, 0),
(175, 127, 'Ktoś tutaj był i był, a potem nagle zniknął i uporczywie go nie ma.', '', '2020-09-08 09:32:00', 0, 0, 0),
(176, 128, 'Czasami ludzie wznoszą mury, nie po to, aby powstrzymać innych, ale po to, żeby zobaczyć, kto chce je rozbić.', '', '2020-09-08 09:32:12', 0, 0, 0),
(177, 129, 'Jeśli masz świadomość, czego jeszcze nie wiesz, to zyskujesz bardzo dużo pokory.', '', '2020-09-08 09:32:29', 0, 0, 0),
(178, 130, 'Niewyrażone emocje nigdy nie umierają. Zostają zakopane żywcem, aby powrócić później w znacznie gorszej postaci.', '', '2020-09-08 09:32:47', 0, 0, 0),
(179, 130, 'Czasami cygaro jest tylko cygarem i niczym więcej.', '', '2020-09-08 09:33:02', 0, 0, 0),
(180, 131, 'Boimy się zmian dlatego, że ciężko nam rozstać się z tym, z czym umiemy już sobie radzić.', '', '2020-09-08 09:33:18', 0, 0, 0),
(181, 131, 'Boję się ludzi bez poczucia humoru, bo jeszcze żywi a już sztywni.', '', '2020-09-08 09:33:31', 0, 0, 0),
(182, 131, 'Największą sztuką jest przejść przez piekło i nie stać się diabłem.', '', '2020-09-08 09:33:41', 0, 0, 0),
(183, 131, 'Prawdziwy związek jest wtedy, gdy dwoje normalnych i spokojnych ludzi tworzy wspólnie swój zwariowany świat.', '', '2020-09-08 09:33:50', 0, 0, 0),
(184, 131, 'Nie żałuj tego co sprawiło, że byłeś szczęśliwy.', '', '2020-09-08 09:33:58', 0, 0, 0),
(185, 132, 'Czasem dobrze jest potrząsnąć drzewem przyjaźni, by zrzucić zgniłe owoce.', '', '2020-09-08 09:34:21', 0, 0, 0),
(186, 133, 'Samotność - nikogo o nią nie wiń. Ona przyszła od środka.', '', '2020-09-08 09:51:14', 0, 0, 0),
(187, 134, 'W chwili, kiedy zastanawiasz się czy kogoś kochasz, przestałeś go już kochać na zawsze.', '', '2020-09-08 10:06:22', 0, 0, 0),
(188, 135, 'Miłość jest taka krótka, zapominanie jest tak długie.', '', '2020-09-08 10:06:35', 0, 0, 0),
(189, 136, 'Kochać kogoś, to przede wszystkim pozwalać mu na to, żeby był, jaki jest.', '', '2020-09-08 10:06:45', 0, 0, 0),
(190, 137, 'To smutne, że głupcy są tacy pewni siebie, a ludzie rozsądni tacy pełni wątpliwości.', '', '2020-09-08 10:07:05', 0, 0, 0),
(191, 138, 'Żaden wiatr nie jest pomyślny temu, kto nie wie, do którego portu płynie.', '', '2020-09-08 10:07:21', 0, 0, 0),
(192, 139, 'Jesteśmy tym, co w swoim życiu powtarzamy. Doskonałość nie jest jednorazowym aktem, lecz nawykiem.', '', '2020-09-08 10:07:33', 0, 0, 0),
(193, 140, 'Mogę być bardzo wściekły na to, czego nie mam, albo bardzo wdzięczny za to, co mam.', '', '2020-09-08 10:07:50', 0, 0, 0),
(194, 112, 'Poznaj samego siebie.', '', '2020-09-08 10:08:01', 0, 0, 0),
(195, 141, 'Jedyną rzeczą bardziej przygnębiającą od niemożności odnalezienia kogoś, jest bycie nieodnalezionym.', '', '2020-09-08 10:08:25', 0, 0, 0),
(196, 142, 'Większość mężczyzn zabrałaby na bezludną wyspę kobietę i na wszelki wypadek siekierę.', '', '2020-09-08 10:08:40', 0, 0, 0),
(197, 143, 'Najlepiej rozmawia się samemu ze sobą. Przynajmniej nie dochodzi do nieporozumień.', '', '2020-09-08 10:08:53', 0, 0, 0),
(198, 42, 'Dopóki nie uczynisz nieświadomego świadomym, dopóty będzie ono kierowało Twoim życiem i będziesz je nazywał losem.', '', '2020-09-08 11:55:30', 0, 0, 0),
(199, 42, 'Rozumienie jest trudne, dlatego większość ludzi ocenia.', '', '2020-09-08 11:56:18', 0, 0, 0),
(200, 144, 'Dzień bez uśmiechu jest dniem straconym.', '', '2020-09-08 11:56:50', 0, 0, 0),
(203, 147, 'Nie bój się wielkiego kroku. Nie pokonasz przepaści dwoma małymi.', '', '2020-09-08 12:05:08', 0, 0, 0),
(204, 148, 'Nawet, jeśli szczęście zapomni o tobie na chwilę, ty nigdy o nim nie zapominaj.', '', '2020-09-08 12:05:57', 0, 0, 0),
(205, 71, 'Jakże często bywa zaprzepaszczone przez zbyt długie przygotowania – głupie przygotowania!', '', '2020-09-08 12:08:40', 0, 0, 0),
(206, 84, 'Czyż można słusznej nie wysłuchać rady? Ważniejsze jest jednak to, by jej wysłuchawszy, zmienić, co złe.', '', '2020-09-08 12:14:14', 0, 0, 0),
(207, 149, 'Jeśli jakaś dłoń ma swoje miejsce w drugiej dłoni, to właśnie jest przyjaźń. ', '', '2020-09-08 12:19:00', 0, 0, 0),
(208, 155, 'Ab alio expectes, alteri quod feceris', 'Co zrobisz drugiemu, oczekuj od niego', '2020-09-10 08:48:00', 0, 0, 0),
(209, 131, 'Ab equis ad asinos', 'Z deszczu pod rynnę (dosłownie “z koni na osły”)', '2020-09-10 09:03:01', 0, 0, 0),
(210, 29, '- Na pustyni jest się trochę samotnym.\n- Równie samotnym jest się wśród ludzi.', '', '2020-09-11 10:23:27', 0, 0, 0),
(211, 156, 'Zwykli ludzie nie wiedzą ile dla kogoś zamkniętego znaczą książki.', '', '2020-09-11 10:23:38', 0, 0, 0),
(212, 157, 'Każdy samotnik, choćby się zaklinał, że tak nie jest, pozostanie samotny nie dlatego, że lubi,ale dlatego, że próbował stać się częścią świata, ale nie mógł, bo doznawał ciągłych rozczarowań ze strony ludzi.', '', '2020-09-11 10:23:50', 0, 0, 0),
(213, 103, '...bo człowiek może wytrzymać tydzień bez picia, dwa tygodnie bez jedzenia, całe lata bez dachu nad głową, ale nie może znieść samotności.', '', '2020-09-11 10:24:03', 0, 0, 0),
(214, 158, 'Nikt nie lubi samotności. Ja tylko nie próbuję się z nikim na siłę zaprzyjaźniać. To prowadzi do rozczarowań.', '', '2020-09-11 10:24:15', 0, 0, 0),
(215, 159, 'Uważam, że zdrowo jest być samemu przez większość czasu. Przebywanie w towarzystwie, nawet najlepszym, szybko staje się nużące i wyczerpujące. Uwielbiam być sam. Nigdy nie spotkałem przyjaciela, który byłby równie przyjazny jak samotność. Jesteśmy zwykle bardziej samotni, kiedy wychodzimy między ludzi, niż kiedy zostajemy w domu.', '', '2020-09-11 10:24:37', 0, 0, 0),
(216, 160, 'Samotnym jest się tylko wtedy, gdy ma się na to czas.', '', '2020-09-11 10:24:52', 0, 0, 0),
(217, 161, 'Samotność to obejmowanie kogoś, kogo kochasz. Gdy wiesz, że nigdy więcej nie obejmiesz go znowu', '', '2020-09-11 10:25:03', 0, 0, 0),
(218, 162, 'Wszystko trzeba odkryć samemu. I również przejść przez to zupełnie samemu.', '', '2020-09-11 10:25:14', 0, 0, 0),
(219, 163, 'Żyjemy tak jak śnimy – samotnie.', '', '2020-09-11 10:25:25', 0, 0, 0),
(220, 103, 'Najgorsze, co może spotkać człowieka, to żyć i umrzeć w samotności, nie kochając i nie będąc kochanym.', '', '2020-09-11 10:25:36', 0, 0, 0),
(221, 114, 'Jest taka chwila, w której, zdani sami na siebie, ludzie przestają żyć, a starają się zaledwie przeżyć.', '', '2020-09-11 10:25:52', 0, 0, 0),
(222, 158, 'Poza tym jest na świecie taki rodzaj smutku, którego nie można wyrazić łzami. Nie można go nikomu wytłumaczyć. Nie mogąc przybrać żadnego kształtu, osiada cicho na dnie serca jak śnieg podczas bezwietrznej nocy.', '', '2020-09-11 10:26:02', 0, 0, 0),
(223, 164, 'Samotność to dziwna rzecz.\nZakrada się cicho i niepostrzeżenie. ', '', '2020-09-11 10:26:15', 0, 0, 0),
(224, 55, 'Każdy powinien mieć kogoś, z kim mógłby szczerze pomówić, bo choćby człowiek był nie wiadomo jak dzielny, czasami czuje się bardzo samotny.', '', '2020-09-11 10:26:30', 0, 0, 0),
(225, 165, 'Mam niewielu przyjaciół. Myślę, że jestem typem samotnika. Tyle tylko, że to była nudna samotność. Można też na to spojrzeć z innej strony, nie wiążąc się z nikim, oszczędzasz sobie w życiu cierpienia.', '', '2020-09-11 10:26:40', 0, 0, 0),
(226, 166, 'Nie zna smaku prawdziwego życia, kto przez tunel samotności się nie przeczołgał.', '', '2020-09-11 10:26:49', 0, 0, 0),
(227, 167, 'Miłość jest pierwszą wśród nieśmiertelnych rzeczy.', '', '2020-09-11 10:27:27', 0, 0, 0),
(228, 168, 'Aby miłość trwała przez całe życie, trzeba ją pielęgnować starannie jak ogród.', '', '2020-09-11 10:27:35', 0, 0, 0),
(229, 169, 'Któż to ci powiedział, że nie ma już na świecie prawdziwej, wiernej, wiecznej miłości? A niechże wyrwą temu kłamcy jego plugawy język!\nTen, który kocha, powinien dzielić los tego, kogo kocha. ', '', '2020-09-11 10:27:52', 0, 0, 0),
(230, 170, 'Miłość jest jak kot. Chodzi własnymi drogami.', '', '2020-09-11 10:28:30', 0, 0, 0),
(231, 171, 'Równie wspaniale jest kochać, jak być kochanym. Miłości nie da się zmarnować.\nTo znaczy, że miłość jest najpotężniejszą siłą na świecie. Miłość potrafi wszystko.\n', '', '2020-09-11 10:28:42', 0, 0, 0),
(232, 103, 'Kocha się za nic. Nie istnieje żaden powód do miłości.', '', '2020-09-11 10:28:51', 0, 0, 0),
(233, 29, 'Dla całego świata możesz być nikim, dla kogoś możesz być całym światem.\nMiłość nie polega na tym, aby wzajemnie sobie się przyglądać, lecz aby patrzeć razem w tym samym kierunku.\nPrawdziwa miłość zaczyna się tam, gdzie niczego już w zamian nie oczekuje.\n', '', '2020-09-11 10:29:08', 0, 0, 0),
(234, 172, 'Ci, których kochamy nie umierają, bo miłość jest nieśmiertelna.', '', '2020-09-11 10:29:29', 0, 0, 0),
(235, 173, 'Bo w życiu to wszystko lepiej smakuje, jak jest przyprawione miłością. Trzeba jej dodawać wszędzie. Gdzie się tylko da.', '', '2020-09-11 10:29:44', 0, 0, 0),
(236, 54, 'Niedojrzała miłość mówi: kocham cię, ponieważ cię potrzebuję. Dojrzała mówi: potrzebuję cię, ponieważ cię kocham.', '', '2020-09-11 10:29:53', 0, 0, 0),
(237, 174, 'Nie wystarczy pokochać, trzeba jeszcze umieć wziąć tę miłość w ręce i przenieść ją przez całe życie.', '', '2020-09-11 10:30:08', 0, 0, 0),
(238, 175, 'Miłość jest czekaniem na szelesty, listy, na pukanie do drzwi.', '', '2020-09-11 10:30:25', 0, 0, 0),
(239, 176, 'Miłość to uczucie, którego żądać nie można; jest darem, nie osiągnięciem.', '', '2020-09-11 10:30:40', 0, 0, 0),
(240, 177, 'Miłość zmienia oblicze świata, a świat zorganizowany przez miłość zmienia nas samych.', '', '2020-09-11 10:30:49', 0, 0, 0),
(241, 114, 'Mówią, że miłość jest ślepa, ale to powiedzenie głupców. Czasami widzi zbyt dużo.', '', '2020-09-11 10:30:59', 0, 0, 0),
(242, 178, 'Miłość jest tęsknotą po utraconej połowie nas samych.', '', '2020-09-11 10:31:11', 0, 0, 0),
(243, 179, '– A jeśli pewnego dnia będę musiał odejść? – spytał Krzyś, ściskając Misiową łapkę. – Co wtedy?- Nic wielkiego. – zapewnił go Puchatek. – Posiedzę tu sobie i na Ciebie poczekam. Kiedy się kogoś kocha, to ten drugi ktoś nigdy nie znika.', '', '2020-09-11 10:32:32', 0, 0, 0),
(244, 180, '-Znam tylko jedną rzecz, która może być jednocześnie bardzo prosta i bardzo skomplikowana.\n-A co to takiego?\n-Miłość.\n', '', '2020-09-11 10:32:51', 0, 0, 0),
(245, 181, 'Dzisiaj kocham Cię jeszcze bardziej niż wczoraj, a nie możesz sobie nawet wyobrazić, jak bardzo kochałem Cię wczoraj.', '', '2020-09-11 10:33:02', 0, 0, 0),
(246, 182, 'I choć nikt mnie tego nie uczył, wiem, że na tym polega miłość. Jeśli jest prawdziwa, sprawia, że człowiek staje się kimś więcej, niż był, kimś więcej, niż wierzył, że może być.', '', '2020-09-11 10:33:11', 0, 0, 0),
(247, 26, 'O miłości wiemy niewiele. Z miłością jest jak z gruszką. Gruszka jest słodka i ma kształt. Spróbujcie zdefiniować kształt gruszki.', '', '2020-09-11 10:33:45', 0, 0, 0),
(248, 183, 'Człowiek wie, że to miłość, kiedy chce przebywać z druga osobą i czuje, że ta druga osoba chce tego samego.\nPrawdziwa miłość oznacza,że zależy ci na szczęściu drugiego człowieka bardziej niż na własnym, bez względu na to, przed jak bolesnymi wyborami stajesz.\nKochać kogoś i być kochanym to najcenniejsza rzecz na świecie\n', '', '2020-09-11 10:33:57', 0, 0, 0),
(249, 78, 'Mam Ciebie, byś troszczył się o mnie, a Ty masz mnie, bym troszczył się o Ciebie.', '', '2020-09-11 10:34:07', 0, 0, 0),
(250, 184, 'Moja miłość równie jest głęboka jak morze, równie jak ono bez końca.Im więcej Ci jej udzielam, tym więcej czuję jej w sercu.', '', '2020-09-11 10:35:18', 0, 0, 0),
(251, 136, 'Miłość to pomieszanie podziwu, szacunku i namiętności. Jeśli żywe jest choć jedno z tych uczuć, to nie ma o co robić szumu. Jeśli dwa, to nie jest to mistrzostwo świata, ale blisko. Jeśli wszystkie trzy, to śmierć jest już niepotrzebna – trafiłaś do nieba za życia.\nKochać kogoś, to przede wszystkim pozwalać mu na to, żeby był, jaki jest.\n', '', '2020-09-11 10:35:34', 0, 0, 0),
(252, 160, 'Może nie najważniejsze jest chcieć iść z kimś do łóżka, ale chcieć wstać następnego dnia rano i zrobić sobie nawzajem herbatę.', '', '2020-09-11 10:36:02', 0, 0, 0),
(253, 185, 'Miłość musi być próbowana jak złoto w ogniu prób; tylko mała miłość w ogniu prób kruszeje. Wielka oczyszcza się i rozpala.', '', '2020-09-11 10:36:13', 0, 0, 0),
(254, 134, '…ten, kto kocha naprawdę, kocha w milczeniu, uczynkiem, a nie słowami.', '', '2020-09-11 10:36:37', 0, 0, 0),
(255, 179, '– A jeśli pewnego dnia będę musiał odejść? – spytał Krzyś, ściskając Misiową łapkę. – Co wtedy?\n– Nic wielkiego – zapewnił go Puchatek. – Posiedzę tu sobie i na ciebie poczekam. Kiedy się kogoś kocha, to ten drugi ktoś nigdy nie znika.\n– Puchatku?\n– Tak Prosiaczku?\n– Nic, tylko chciałem się upewnić, że jesteś.\nPrzyjacielu, jeśli będzie ci dane żyć sto lat, to ja chciałby żyć sto lat minus jeden dzień, abym nie musiał żyć ani jednego dnia bez ciebie.\n', '', '2020-09-11 10:38:03', 0, 0, 0),
(256, 186, 'Każdy z nas potrzebuje czasami ręki, która wyciągnęłaby go z kłopotów.', '', '2020-09-11 10:38:15', 0, 0, 0),
(257, 19, 'Nie idź za mną, bo nie umiem prowadzić. Nie idź przede mną, bo mogę za Tobą nie nadążyć. Idź po prostu obok mnie i bądź moim przyjacielem. ', '', '2020-09-11 10:38:28', 0, 0, 0),
(258, 26, 'Jeśli ma się przyjaciół, a mimo to wszystko się traci, jest oczywiste, że przyjaciele ponoszą winę. Za to, co uczynili, względnie za to, czego nie uczynili. Za to, że nie wiedzieli, co należy uczynić.', '', '2020-09-11 10:38:42', 0, 0, 0),
(259, 29, 'A ponieważ nie ma magazynów z przyjaciółmi, więc ludzie nie posiadają przyjaciół.\nNawet w obliczu śmierci przyjemna jest świadomość posiadania przyjaciela.\nPrawdziwym przyjacielem jest ten, z którym człowiek zwiąże się liną.\n', '', '2020-09-11 10:38:54', 0, 0, 0),
(260, 29, 'Jedyny szacunek, który jest coś wart, to szacunek ze strony nieprzyjaciela. Szacunek przyjaciół wart jest tylko wtedy, gdy wznosi się ponad ich wdzięczność, podziękowania i wszystkie bardziej prymitywne odruchy…', '', '2020-09-11 10:39:05', 0, 0, 0),
(261, 187, 'Problem w tym, że jeśli ze strachu przed wrogiem otoczysz się murem obronnym, ten mur nie przepuści również przyjaciół.', '', '2020-09-11 10:39:14', 0, 0, 0),
(262, 134, 'Nie ufam tym, którzy są przekonani, że mają wielu przyjaciół. To znak, iż ni znają ludzi.', '', '2020-09-11 10:39:28', 0, 0, 0),
(263, 188, 'Zawsze wierzyłem w głupców. Moi przyjaciele nazywają to wiarą w samego siebie.', '', '2020-09-11 10:39:50', 0, 0, 0),
(264, 166, 'Prawdziwy przyjaciel to nie ten, który odwala za ciebie całą robotę, lecz ten który uświadomi ci, że wszystko masz zrobić sam.', '', '2020-09-11 10:40:03', 0, 0, 0),
(265, 189, 'Przyjaciel to człowiek, który wie wszystko o tobie i wciąż cię lubi.', '', '2020-09-11 10:40:51', 0, 0, 0),
(266, 55, 'Powiedz mi, kim są twoi przyjaciele, a powiem ci, kim jesteś.', '', '2020-09-11 10:41:01', 0, 0, 0),
(267, 190, 'Przyjaźń to nie tylko wspaniały prezent, lecz także ustawiczna praca.', '', '2020-09-11 10:41:12', 0, 0, 0),
(268, 191, 'Dopiero wtedy zrozumiałem, że umrzeć to znaczy już nigdy więcej nie spotkać przyjaciół.', '', '2020-09-11 10:44:24', 0, 0, 0),
(269, 158, 'Przyjaciele, z którymi zabijamy czas, to właśnie prawdziwi przyjaciele.', '', '2020-09-11 10:44:33', 0, 0, 0),
(270, 192, 'To zależy, czego od przyjaciół oczekujesz. Możesz nam zaufać, że cię nie opuścimy w dobrej czy złej doli, choćby do najgorszego końca. Możesz też nam ufać, że strzec będziemy twojej tajemnicy lepiej niż ty sam jej strzegłeś. Ale nie licz na nas, byśmy ci pozwolili samotnie stawić czoło niebezpieczeństwu i odejść od nas bez słowa. Jesteśmy twoimi przyjaciółmi. Boimy się okropnie, ale pójdziemy z tobą albo za tobą, jak psy za tropem.', '', '2020-09-11 10:44:43', 0, 0, 0),
(271, 160, 'Przyjaciel staje się fragmentem naszej biografii, jak data urodzenia, pierwsza szkoła czy imiona rodziców.', '', '2020-09-11 10:45:02', 0, 0, 0),
(272, 193, 'Przyjaźń polega na tym, także na tym, że nie dostarcza się przyjaciołom zbytecznych zgryzot.', '', '2020-09-11 10:45:11', 0, 0, 0),
(273, 194, 'Dobrych przyjaciół trudno znaleźć, a jeszcze trudniej zapomnieć.', '', '2020-09-11 10:45:20', 0, 0, 0),
(274, 195, 'Nikt chyba nie miałby przyjaciół, gdyby słyszał, co mówią oni za jego plecami.', '', '2020-09-11 10:45:34', 0, 0, 0),
(275, 196, 'Jeśli przyjaciele są wysoko na twojej liście priorytetów, to nawet gdy stracisz zdrowie, i tak zachowasz to, co liczy się najbardziej.', '', '2020-09-11 10:45:44', 0, 0, 0),
(276, 197, 'Nie interesują mnie pozorne relacje, pozór kontaktów i samozachwyt, że jesteśmy en vogue, trendy, w głównym nurcie. Nie jesteśmy. Jesteśmy w dupie. Jeśli pani nie usiądzie i nie będzie mogła porozmawiać ze swoimi bliskimi normalnie, to jest pani w dupie, za przeproszeniem. I siedem tysięcy znajomych na Facebooku nic tu nie pomoże.', '', '2020-09-11 10:45:55', 0, 0, 0),
(277, 198, 'Przyjaciel to człowiek, do którego dzwonię po wielu miesiącach milczenia, a nie pyta: dlaczego się nie odzywałaś, tylko mówi: cieszę się, że właśnie dziś słyszę Twój głos.', '', '2020-09-11 10:46:03', 0, 0, 0),
(278, 199, 'Tylko przyjaciel nie jest egoistą; w przeciwnym razie żaden z niego przyjaciel. Jedynie przyjaciel nie jest samolubny, bowiem nie dla siebie, ale dla przyjaciela pragnie wszystkiego, co dobre i piękne.', '', '2020-09-11 10:46:13', 0, 0, 0),
(279, 114, 'Tylko wrogowie mówią sobie prawdę. Przyjaciele i kochankowie bez przerwy kłamią, złapani w sieć zobowiązań.', '', '2020-09-11 10:46:23', 0, 0, 0),
(280, 200, 'Gdyby wszyscy moi przyjaciele skoczyli z mostu, ja bym z nimi nie skoczył. Stałbym na dole i czekał, żeby ich złapać.', '', '2020-09-11 10:47:01', 0, 0, 0),
(281, 201, 'Przyjaźń to strach przed samotnością, a miłość to jeszcze większy strach przed osamotnieniem.', '', '2020-09-11 10:47:11', 0, 0, 0),
(282, 202, 'Nie ten przyjaciel, kto współczuje, a ten kto pomaga.', '', '2020-09-11 10:47:57', 0, 0, 0),
(283, 162, 'Jedyne, co miało jakieś znaczenie, to to, że znalazłem mojego pierwszego przyjaciela, a tym samym zacząłem naprawdę żyć.', '', '2020-09-11 10:48:06', 0, 0, 0),
(284, 203, 'Najczęściej nasi najlepsi przyjaciele są sprawcami naszego upadku.', '', '2020-09-11 10:48:18', 0, 0, 0),
(285, 204, 'Tylko istota absolutnie silna nie potrzebuje przyjaźni; z pewnością kimś takim może być tylko Bóg.', '', '2020-09-11 10:48:27', 0, 0, 0),
(286, 205, 'Roztropnie jest posiadać przyjaciół gdzie tylko się da, czy to na tym, czy na drugim świecie.', '', '2020-09-11 10:48:39', 0, 0, 0),
(287, 206, 'Bardziej niebezpieczni są przyjaciele w swej zdradzie, niż wrogowie w swej konsekwencji.', '', '2020-09-11 10:49:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `quotes_authors`
--

CREATE TABLE `quotes_authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `quotes_authors`
--

INSERT INTO `quotes_authors` (`author_id`, `author_name`) VALUES
(17, 'Adam Mickiewicz'),
(18, 'Agnieszka Osiecka'),
(19, 'Albert Camus'),
(20, 'Albert Einstein'),
(21, 'Aldona Różanek'),
(22, 'Aleksander Dumas'),
(23, 'Aleksander Fredro'),
(24, 'Alice Munro'),
(25, 'Ambrose Bierce'),
(26, 'Andrzej Sapkowski'),
(27, 'Anthony de Mello'),
(28, 'Anthony Robbins'),
(29, 'Antoine de Saint-Exupéry'),
(30, 'Arthur Schopenhauer'),
(31, 'Audrey Hepburn'),
(32, 'Bernard Baruch'),
(33, 'Bertold Brecht'),
(34, 'Bob Marley'),
(35, 'Brian Tracy'),
(37, 'Budda'),
(38, 'Revolwer AP'),
(39, 'GG'),
(40, 'Calvin Coolidge'),
(42, 'Carl Gustav Jung'),
(43, 'Charles Revson'),
(45, 'Dalajlama'),
(46, 'Dale Carnegie'),
(48, 'Denis Saint-Pierre'),
(49, 'Demokryt'),
(50, 'Dr House'),
(51, 'Eckhart Tolle'),
(52, 'Eleonor Roosevelt'),
(53, 'Epikur'),
(54, 'Erich Fromm'),
(55, 'Ernest Hemingway'),
(56, 'Eurypides'),
(58, 'Feliks Chwalibóg'),
(59, 'Frank Sinatra'),
(60, 'Friedrich Wilhelm Nietzsche'),
(61, 'Goethe'),
(62, 'Gordon Hinckley'),
(63, 'Hans-Georg Gadamer'),
(64, 'Harold Taylor'),
(65, 'Helen Keller'),
(66, 'Henry Ford'),
(67, 'Henry Saka'),
(69, 'Jan Kochanowski'),
(71, 'Jane Austen'),
(72, 'Janis Joplin'),
(73, 'Jim Rohn'),
(74, 'Johann Wolfgang von Goethe'),
(75, 'John D. Rockefeller'),
(76, 'John F. Kennedy'),
(77, 'John Fowles'),
(78, 'John Steinbeck'),
(79, 'John Quincy Adams'),
(80, 'Joker'),
(81, 'Judy Garland'),
(82, 'Julian Tuwim'),
(84, 'Konfucjusz'),
(85, 'Lao-Tse'),
(86, 'Laozi'),
(87, 'Les Brown'),
(88, 'Lew Tołstoj'),
(89, 'Lois McMaster Bujold'),
(90, 'Mahatma Gandhi'),
(91, 'Malcolm S. Forbes'),
(92, 'Maria Skłodowska-Curie'),
(93, 'Mark Twain'),
(94, 'Mary Lou Cook'),
(95, 'Mary Monin Morrissey'),
(96, 'Marylin Monroe'),
(97, 'Meryl Streep'),
(98, 'Molier'),
(99, 'Napoleon Bonaparte'),
(100, 'Nikodem Marszałek'),
(101, 'Oscar Wilde'),
(102, 'Pablo Picasso'),
(103, 'Paulo Coelho'),
(104, 'Peter Drucker'),
(105, 'Pitagoras'),
(106, 'Prentice Mulford'),
(107, 'Ralph Waldo Emerson'),
(108, 'Robin Williams'),
(109, 'Roman Mleczko'),
(110, 'Safona'),
(111, 'Sławomir Mrożek'),
(112, 'Sokrates'),
(113, 'Stanisław Jerzy Lec'),
(114, 'Stephen King'),
(115, 'Śri Jukteśwar'),
(116, 'Thomas Hardy'),
(117, 'Tim Cahill'),
(118, 'Vince Lombardi'),
(119, 'Voltaire'),
(120, 'Wiktor Hugo'),
(121, 'Will Rogers'),
(122, 'William Feather'),
(123, 'William H. Davidow'),
(124, 'William Jones'),
(125, 'William Shakespeare'),
(126, 'Winston Churchill'),
(127, 'Wisława Szymborska'),
(128, 'Yoshimoto'),
(129, 'Zbigniew Wodecki'),
(130, 'Zygmunt Freud'),
(131, ''),
(132, 'Przysłowie afrykańskie'),
(133, 'Andrzej Piasecki'),
(134, 'Carlos Ruiz Zafón'),
(135, 'Pablo Neruda'),
(136, 'William Wharton'),
(137, 'Bertrand Russel'),
(138, 'Machiavelli'),
(139, 'arystoteles'),
(140, 'nick vujicic'),
(141, 'Cecylia Ahern'),
(142, 'Andrzej Majewski'),
(143, 'Olga Tokarczuk'),
(144, 'Charlie Chaplin'),
(147, 'David Lloyd George'),
(148, 'Jacques Prévert'),
(149, 'Adam Asnyk'),
(155, 'Seneka Młodszy'),
(156, 'Anne Frank'),
(157, 'Jodi Picoult'),
(158, 'Haruki Murakami'),
(159, 'Henry David Thoreau'),
(160, 'Janusz Leon Wiśniewski'),
(161, 'Kamil Garcia'),
(162, 'Tove Jansson'),
(163, 'Joseph Conrad'),
(164, 'Taheref Mafi'),
(165, 'Trudi Canavan'),
(166, 'Edward Stachura'),
(167, 'Dante Alighieri'),
(168, 'Henry Bordeaux'),
(169, 'Michaił Bułhakow'),
(170, 'Joanna Chmielewska'),
(171, 'Cassandra Clare'),
(172, 'Emily Dickinson'),
(173, 'Anna Ficner-Ogonowska'),
(174, 'Konstanty Ildefons Gałczyński'),
(175, 'Małgorzata Hillar'),
(176, 'Irena Jurgielewiczowa'),
(177, 'Anna Kamieńska'),
(178, 'Milan Kundera'),
(179, 'Alan Alexander Milne'),
(180, 'Guillaume Musso'),
(181, 'James Patterson '),
(182, 'Veronica Roth'),
(183, 'Nicholas Sparks'),
(184, 'William Szekspir'),
(185, 'Stefan Wyszyński'),
(186, 'Alba de Céspedes'),
(187, 'Camilla Läckberg'),
(188, 'Edgar Allan Poe'),
(189, 'Elbert Hubbard'),
(190, 'Ernst Zacharias'),
(191, 'Gabriel García Márquez'),
(192, 'J.R.R. Tolkien'),
(193, 'Jerzy Pilch'),
(194, 'John Green'),
(195, 'Małgorzata Musierowicz'),
(196, 'Regina Brett'),
(197, 'Robert Więckiewicz'),
(198, 'Roma Ligocka'),
(199, 'Sándor Márai'),
(200, 'Steve Berry'),
(201, 'Tadeusz Konwicki'),
(202, 'Thomas Fuller'),
(203, 'Victor Hugo'),
(204, 'Wasilij Grossman'),
(205, 'Wilbur Smith'),
(206, 'Władysław Grzeszczyk');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `quotes_categories`
--

CREATE TABLE `quotes_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `quotes_categories`
--

INSERT INTO `quotes_categories` (`category_id`, `category_name`) VALUES
(12, 'FILOZOFIA'),
(13, 'MIŁOŚĆ'),
(14, 'TĘSKNOTA'),
(15, 'CIERPIENIE'),
(16, 'PSYCHOLOGIA'),
(17, 'TE CHOLERNE ŻYCIE'),
(18, 'FILOZOFIA ŻYCIA'),
(19, 'PSYCHOLOGIA ŻYCIA'),
(20, 'SAMOTNOŚĆ'),
(21, 'PRZYJAŹŃ');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `quotes_categories_sets`
--

CREATE TABLE `quotes_categories_sets` (
  `quotes_categories_set_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `quotes_categories_sets`
--

INSERT INTO `quotes_categories_sets` (`quotes_categories_set_id`, `quote_id`, `category_id`) VALUES
(30, 22, 12),
(31, 23, 13),
(32, 23, 14),
(33, 23, 15),
(34, 24, 12),
(35, 25, 16),
(36, 26, 12),
(37, 27, 16),
(38, 28, 16),
(39, 29, 16),
(40, 30, 12),
(41, 31, 16),
(42, 32, 13),
(43, 32, 14),
(44, 32, 15),
(45, 33, 12),
(46, 34, 16),
(47, 35, 13),
(48, 35, 14),
(49, 35, 15),
(50, 36, 16),
(51, 37, 16),
(52, 38, 12),
(53, 39, 12),
(54, 40, 13),
(55, 40, 14),
(56, 40, 15),
(57, 41, 12),
(58, 42, 12),
(59, 43, 12),
(60, 44, 16),
(61, 45, 12),
(62, 46, 16),
(63, 47, 16),
(65, 49, 12),
(66, 50, 12),
(67, 51, 17),
(68, 52, 17),
(69, 53, 17),
(70, 54, 17),
(71, 55, 17),
(72, 56, 17),
(73, 57, 17),
(74, 58, 17),
(75, 59, 12),
(76, 60, 12),
(77, 61, 17),
(78, 62, 12),
(80, 64, 16),
(82, 66, 12),
(84, 68, 12),
(85, 69, 12),
(86, 70, 16),
(87, 71, 16),
(89, 73, 12),
(90, 74, 12),
(91, 75, 12),
(92, 76, 12),
(93, 77, 12),
(94, 78, 12),
(95, 79, 12),
(96, 80, 16),
(97, 81, 12),
(99, 83, 16),
(100, 84, 12),
(101, 85, 12),
(102, 86, 12),
(103, 87, 16),
(104, 88, 12),
(105, 89, 16),
(106, 89, 12),
(107, 90, 18),
(108, 91, 12),
(109, 92, 18),
(110, 93, 18),
(111, 94, 18),
(112, 95, 18),
(113, 96, 18),
(114, 97, 18),
(115, 98, 18),
(117, 100, 12),
(119, 102, 12),
(120, 103, 18),
(121, 104, 18),
(122, 105, 18),
(123, 106, 16),
(124, 107, 18),
(125, 108, 12),
(126, 109, 18),
(127, 110, 18),
(128, 111, 18),
(129, 112, 16),
(130, 113, 16),
(131, 114, 16),
(133, 116, 18),
(134, 117, 18),
(135, 118, 16),
(136, 119, 16),
(137, 120, 18),
(138, 121, 18),
(139, 122, 16),
(140, 123, 18),
(141, 124, 18),
(142, 125, 18),
(143, 126, 16),
(144, 127, 18),
(145, 128, 12),
(146, 129, 18),
(147, 130, 16),
(148, 131, 16),
(149, 132, 16),
(150, 133, 16),
(151, 134, 16),
(152, 135, 18),
(153, 136, 12),
(154, 137, 19),
(155, 138, 18),
(156, 139, 18),
(157, 140, 18),
(158, 141, 18),
(159, 142, 12),
(160, 143, 12),
(161, 144, 12),
(162, 145, 12),
(163, 146, 12),
(164, 147, 12),
(165, 148, 18),
(166, 149, 18),
(167, 150, 18),
(168, 151, 19),
(169, 152, 12),
(170, 153, 12),
(171, 154, 12),
(172, 155, 12),
(173, 156, 12),
(174, 157, 12),
(175, 158, 18),
(176, 159, 18),
(177, 160, 12),
(178, 161, 18),
(179, 162, 18),
(180, 163, 19),
(181, 164, 12),
(182, 165, 12),
(183, 166, 12),
(184, 167, 12),
(185, 168, 18),
(186, 169, 18),
(187, 170, 19),
(188, 171, 19),
(189, 172, 18),
(190, 173, 18),
(191, 174, 18),
(192, 175, 18),
(193, 176, 18),
(194, 177, 18),
(195, 178, 16),
(196, 179, 16),
(197, 180, 19),
(198, 181, 19),
(199, 182, 18),
(200, 183, 18),
(201, 184, 12),
(202, 185, 18),
(203, 186, 12),
(204, 187, 13),
(205, 188, 13),
(206, 189, 13),
(207, 190, 12),
(208, 191, 12),
(209, 192, 12),
(210, 193, 16),
(211, 194, 16),
(212, 195, 16),
(213, 196, 16),
(214, 197, 16),
(215, 198, 12),
(216, 199, 16),
(217, 200, 12),
(220, 203, 16),
(221, 204, 12),
(222, 205, 12),
(223, 206, 18),
(224, 207, 12),
(225, 208, 18),
(226, 209, 18),
(227, 210, 20),
(228, 211, 20),
(229, 212, 20),
(230, 213, 20),
(231, 214, 20),
(232, 215, 20),
(233, 216, 20),
(234, 217, 20),
(235, 218, 20),
(236, 219, 20),
(237, 220, 20),
(238, 221, 20),
(239, 222, 20),
(240, 223, 20),
(241, 224, 20),
(242, 225, 20),
(243, 226, 20),
(244, 227, 13),
(245, 228, 13),
(246, 229, 13),
(247, 230, 13),
(248, 231, 13),
(249, 232, 13),
(250, 233, 13),
(251, 234, 13),
(252, 235, 13),
(253, 236, 13),
(254, 237, 13),
(255, 238, 13),
(256, 239, 13),
(257, 240, 13),
(258, 241, 13),
(259, 242, 13),
(260, 243, 13),
(261, 244, 13),
(262, 245, 13),
(263, 246, 13),
(264, 247, 13),
(265, 248, 13),
(266, 249, 13),
(267, 250, 13),
(268, 251, 13),
(269, 252, 13),
(270, 253, 13),
(271, 254, 13),
(272, 255, 21),
(273, 256, 21),
(274, 257, 21),
(275, 258, 21),
(276, 259, 21),
(277, 260, 21),
(278, 261, 21),
(279, 262, 21),
(280, 263, 21),
(281, 264, 21),
(282, 265, 21),
(283, 266, 21),
(284, 267, 21),
(285, 268, 21),
(286, 269, 21),
(287, 270, 21),
(288, 271, 21),
(289, 272, 21),
(290, 273, 21),
(291, 274, 21),
(292, 275, 21),
(293, 276, 21),
(294, 277, 21),
(295, 278, 21),
(296, 279, 21),
(297, 280, 21),
(298, 281, 21),
(299, 282, 21),
(300, 283, 21),
(301, 284, 21),
(302, 285, 21),
(303, 286, 21),
(304, 287, 21);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `articles_authors`
--
ALTER TABLE `articles_authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `definitions`
--
ALTER TABLE `definitions`
  ADD PRIMARY KEY (`definition_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `definitions_authors`
--
ALTER TABLE `definitions_authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`quote_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `quotes_authors`
--
ALTER TABLE `quotes_authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `quotes_categories`
--
ALTER TABLE `quotes_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `quotes_categories_sets`
--
ALTER TABLE `quotes_categories_sets`
  ADD PRIMARY KEY (`quotes_categories_set_id`),
  ADD KEY `quote_id` (`quote_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `articles_authors`
--
ALTER TABLE `articles_authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `definitions`
--
ALTER TABLE `definitions`
  MODIFY `definition_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `definitions_authors`
--
ALTER TABLE `definitions_authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `quotes`
--
ALTER TABLE `quotes`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;
--
-- AUTO_INCREMENT dla tabeli `quotes_authors`
--
ALTER TABLE `quotes_authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT dla tabeli `quotes_categories`
--
ALTER TABLE `quotes_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT dla tabeli `quotes_categories_sets`
--
ALTER TABLE `quotes_categories_sets`
  MODIFY `quotes_categories_set_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `articles_authors` (`author_id`);

--
-- Ograniczenia dla tabeli `definitions`
--
ALTER TABLE `definitions`
  ADD CONSTRAINT `definitions_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `definitions_authors` (`author_id`);

--
-- Ograniczenia dla tabeli `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `quotes_authors` (`author_id`);

--
-- Ograniczenia dla tabeli `quotes_categories_sets`
--
ALTER TABLE `quotes_categories_sets`
  ADD CONSTRAINT `quotes_categories_sets_ibfk_1` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`quote_id`),
  ADD CONSTRAINT `quotes_categories_sets_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `quotes_categories` (`category_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
