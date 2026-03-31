-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2026 at 02:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wadesaresto`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `photo`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Wadesa', 'admin@gmail.com', 'admin/DyLn0gzDZlNc0U9dfFrweSNc3RXCWNN7mo00aZPg.jpg', '$2y$12$0f.oWlEwDKnKKKyidOyoQOkMnaxkIylzIqbbbOVD3npJcsgJCv44y', '2026-02-11 01:44:53', '2026-02-16 10:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id_area` int(11) UNSIGNED NOT NULL,
  `nama_area` varchar(50) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `tipe` enum('meja','ruangan') NOT NULL DEFAULT 'meja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id_area`, `nama_area`, `kapasitas`, `tipe`) VALUES
(1, 'Indoor', 20, 'meja'),
(3, 'Outdoor', 20, 'meja'),
(4, 'Meeting Room', 20, 'ruangan'),
(5, 'VIP', 10, 'meja'),
(6, 'Garden', 20, 'ruangan');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(14, '3cff9b3f-66e6-4642-b5c7-8deac4ff87b6', 'database', 'default', '{\"uuid\":\"3cff9b3f-66e6-4642-b5c7-8deac4ff87b6\",\"displayName\":\"App\\\\Mail\\\\ReservasiMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ReservasiMail\\\":3:{s:4:\\\"data\\\";a:10:{s:4:\\\"nama\\\";s:9:\\\"ibu putri\\\";s:5:\\\"email\\\";s:19:\\\"stutnasne@gmail.com\\\";s:7:\\\"tanggal\\\";s:10:\\\"2026-02-26\\\";s:3:\\\"jam\\\";s:5:\\\"13.00\\\";s:6:\\\"jumlah\\\";i:6;s:4:\\\"kode\\\";s:11:\\\"WD-BDB97D68\\\";s:4:\\\"area\\\";s:6:\\\"Indoor\\\";s:4:\\\"meja\\\";s:2:\\\"I1\\\";s:7:\\\"catatan\\\";N;s:6:\\\"status\\\";s:7:\\\"pending\\\";}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"stutnasne@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1771753898,\"delay\":null}', 'ErrorException: Undefined variable $reservasi in C:\\xampp\\htdocs\\wadesaresto\\storage\\framework\\views\\c573ac0d8a48c9c84b8a42f076806977.php:10\nStack trace:\n#0 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Bootstrap\\HandleExceptions.php(258): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined varia...\', \'C:\\\\xampp\\\\htdocs...\', 10)\n#1 C:\\xampp\\htdocs\\wadesaresto\\storage\\framework\\views\\c573ac0d8a48c9c84b8a42f076806977.php(10): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined varia...\', \'C:\\\\xampp\\\\htdocs...\', 10)\n#2 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(123): require(\'C:\\\\xampp\\\\htdocs...\')\n#3 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(124): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#4 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(57): Illuminate\\Filesystem\\Filesystem->getRequire(\'C:\\\\xampp\\\\htdocs...\', Array)\n#5 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'C:\\\\xampp\\\\htdocs...\', Array)\n#6 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'C:\\\\xampp\\\\htdocs...\', Array)\n#7 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(191): Illuminate\\View\\View->getContents()\n#8 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(160): Illuminate\\View\\View->renderContents()\n#9 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(444): Illuminate\\View\\View->render()\n#10 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(\'emails.reservas...\', Array)\n#11 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), \'emails.reservas...\', NULL, NULL, Array)\n#12 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(\'emails.reservas...\', Array, Object(Closure))\n#13 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#14 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#15 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#16 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#17 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#18 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#19 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#20 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#21 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Container\\Container->call(Array)\n#22 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#24 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(133): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#25 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(135): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#26 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#27 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#28 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(128): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#29 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#30 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#31 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#32 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#33 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#34 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#35 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#36 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#37 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#38 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#39 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#40 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#41 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#42 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#43 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#44 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 C:\\xampp\\htdocs\\wadesaresto\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#50 {main}\n\nNext Illuminate\\View\\ViewException: Undefined variable $reservasi (View: C:\\xampp\\htdocs\\wadesaresto\\resources\\views\\emails\\reservasi.blade.php) in C:\\xampp\\htdocs\\wadesaresto\\storage\\framework\\views\\c573ac0d8a48c9c84b8a42f076806977.php:10\nStack trace:\n#0 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(59): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(ErrorException), 0)\n#1 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'C:\\\\xampp\\\\htdocs...\', Array)\n#2 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'C:\\\\xampp\\\\htdocs...\', Array)\n#3 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(191): Illuminate\\View\\View->getContents()\n#4 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(160): Illuminate\\View\\View->renderContents()\n#5 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(444): Illuminate\\View\\View->render()\n#6 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(\'emails.reservas...\', Array)\n#7 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), \'emails.reservas...\', NULL, NULL, Array)\n#8 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(\'emails.reservas...\', Array, Object(Closure))\n#9 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#10 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#11 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#12 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#13 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Container\\Container->call(Array)\n#18 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#19 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#20 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(133): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#21 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(135): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#22 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#24 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(128): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#25 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#26 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#27 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#28 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#29 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#31 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#32 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#33 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#34 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#35 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#36 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#37 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#38 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#40 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 C:\\xampp\\htdocs\\wadesaresto\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#46 {main}', '2026-02-22 09:51:41'),
(15, '733df424-a544-431c-9c69-3c8f0e2eb7ea', 'database', 'default', '{\"uuid\":\"733df424-a544-431c-9c69-3c8f0e2eb7ea\",\"displayName\":\"App\\\\Mail\\\\ReservasiMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ReservasiMail\\\":3:{s:4:\\\"data\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:20:\\\"App\\\\Models\\\\Reservasi\\\";s:2:\\\"id\\\";i:71;s:9:\\\"relations\\\";a:2:{i:0;s:4:\\\"area\\\";i:1;s:4:\\\"meja\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"stutnasne@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1771753898,\"delay\":null}', 'TypeError: Illegal offset type in C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php:953\nStack trace:\n#0 C:\\xampp\\htdocs\\wadesaresto\\app\\Mail\\ReservasiMail.php(25): Illuminate\\Mail\\Mailable->with(Object(App\\Models\\Reservasi))\n#1 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Mail\\ReservasiMail->build()\n#2 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#3 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#4 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#5 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#6 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(1691): Illuminate\\Container\\Container->call(Array)\n#7 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(201): Illuminate\\Mail\\Mailable->prepareMailableForDelivery()\n#8 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#9 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#10 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#11 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#12 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#14 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#15 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#16 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Container\\Container->call(Array)\n#17 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#18 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#19 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(133): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#20 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(135): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#21 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#22 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(128): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#25 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#26 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#28 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#29 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#31 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#34 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#35 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#36 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#37 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#38 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 C:\\xampp\\htdocs\\wadesaresto\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#45 {main}', '2026-02-22 09:51:42');
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(16, '34e6f21f-7a53-4d68-bbf1-41b90b160979', 'database', 'default', '{\"uuid\":\"34e6f21f-7a53-4d68-bbf1-41b90b160979\",\"displayName\":\"App\\\\Mail\\\\ReservasiMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ReservasiMail\\\":4:{s:9:\\\"reservasi\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:20:\\\"App\\\\Models\\\\Reservasi\\\";s:2:\\\"id\\\";i:96;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"cancelUrl\\\";s:134:\\\"http:\\/\\/localhost:8000\\/cancel\\/WD-E80A960C?expires=1771935190&signature=b5d5ea9c67a0b0e4de1dd4b9be92b4cabeab726150835df30ccaa9672b989e17\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"ambhurajadeevan@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1771927990,\"delay\":null}', 'ErrorException: Undefined variable $cancelUrl in C:\\xampp\\htdocs\\wadesaresto\\storage\\framework\\views\\c573ac0d8a48c9c84b8a42f076806977.php:53\nStack trace:\n#0 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Bootstrap\\HandleExceptions.php(258): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined varia...\', \'C:\\\\xampp\\\\htdocs...\', 53)\n#1 C:\\xampp\\htdocs\\wadesaresto\\storage\\framework\\views\\c573ac0d8a48c9c84b8a42f076806977.php(53): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined varia...\', \'C:\\\\xampp\\\\htdocs...\', 53)\n#2 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(123): require(\'C:\\\\xampp\\\\htdocs...\')\n#3 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(124): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#4 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(57): Illuminate\\Filesystem\\Filesystem->getRequire(\'C:\\\\xampp\\\\htdocs...\', Array)\n#5 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(88): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'C:\\\\xampp\\\\htdocs...\', Array)\n#6 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'C:\\\\xampp\\\\htdocs...\', Array)\n#7 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(191): Illuminate\\View\\View->getContents()\n#8 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(160): Illuminate\\View\\View->renderContents()\n#9 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(444): Illuminate\\View\\View->render()\n#10 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(\'emails.reservas...\', Array)\n#11 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), \'emails.reservas...\', NULL, NULL, Array)\n#12 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(\'emails.reservas...\', Array, Object(Closure))\n#13 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#14 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#15 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#16 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#17 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#18 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#19 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#20 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#21 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Container\\Container->call(Array)\n#22 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#24 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(133): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#25 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(135): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#26 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#27 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#28 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(128): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#29 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#30 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#31 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#32 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#33 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#34 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#35 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#36 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#37 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#38 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#39 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#40 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#41 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#42 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#43 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#44 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 C:\\xampp\\htdocs\\wadesaresto\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#50 {main}\n\nNext Illuminate\\View\\ViewException: Undefined variable $cancelUrl (View: C:\\xampp\\htdocs\\wadesaresto\\resources\\views\\emails\\reservasi.blade.php) in C:\\xampp\\htdocs\\wadesaresto\\storage\\framework\\views\\c573ac0d8a48c9c84b8a42f076806977.php:53\nStack trace:\n#0 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(59): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(ErrorException), 0)\n#1 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(88): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'C:\\\\xampp\\\\htdocs...\', Array)\n#2 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'C:\\\\xampp\\\\htdocs...\', Array)\n#3 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(191): Illuminate\\View\\View->getContents()\n#4 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(160): Illuminate\\View\\View->renderContents()\n#5 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(444): Illuminate\\View\\View->render()\n#6 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(\'emails.reservas...\', Array)\n#7 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), \'emails.reservas...\', NULL, NULL, Array)\n#8 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(\'emails.reservas...\', Array, Object(Closure))\n#9 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#10 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#11 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#12 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#13 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Container\\Container->call(Array)\n#18 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#19 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#20 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(133): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#21 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(135): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#22 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#24 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(128): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#25 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#26 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#27 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#28 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#29 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#31 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#32 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#33 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#34 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#35 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#36 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#37 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#38 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#40 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 C:\\xampp\\htdocs\\wadesaresto\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#46 {main}', '2026-02-24 10:13:14'),
(17, '377b16f5-c7ce-4b7b-922a-64ab1f97d284', 'database', 'default', '{\"uuid\":\"377b16f5-c7ce-4b7b-922a-64ab1f97d284\",\"displayName\":\"App\\\\Mail\\\\ReservasiMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:22:\\\"App\\\\Mail\\\\ReservasiMail\\\":4:{s:9:\\\"reservasi\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:20:\\\"App\\\\Models\\\\Reservasi\\\";s:2:\\\"id\\\";i:97;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:9:\\\"cancelUrl\\\";s:134:\\\"http:\\/\\/localhost:8000\\/cancel\\/WD-FEB860CB?expires=1771935311&signature=b94ffbde45034b92daed34890c4800a47b19f6eadf326b459ed59262d7144b2d\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"ambhurajadeevan@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1771928111,\"delay\":null}', 'ErrorException: Undefined variable $cancelUrl in C:\\xampp\\htdocs\\wadesaresto\\storage\\framework\\views\\c573ac0d8a48c9c84b8a42f076806977.php:53\nStack trace:\n#0 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Bootstrap\\HandleExceptions.php(258): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(2, \'Undefined varia...\', \'C:\\\\xampp\\\\htdocs...\', 53)\n#1 C:\\xampp\\htdocs\\wadesaresto\\storage\\framework\\views\\c573ac0d8a48c9c84b8a42f076806977.php(53): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->Illuminate\\Foundation\\Bootstrap\\{closure}(2, \'Undefined varia...\', \'C:\\\\xampp\\\\htdocs...\', 53)\n#2 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(123): require(\'C:\\\\xampp\\\\htdocs...\')\n#3 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Filesystem\\Filesystem.php(124): Illuminate\\Filesystem\\Filesystem::Illuminate\\Filesystem\\{closure}()\n#4 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(57): Illuminate\\Filesystem\\Filesystem->getRequire(\'C:\\\\xampp\\\\htdocs...\', Array)\n#5 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'C:\\\\xampp\\\\htdocs...\', Array)\n#6 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'C:\\\\xampp\\\\htdocs...\', Array)\n#7 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(191): Illuminate\\View\\View->getContents()\n#8 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(160): Illuminate\\View\\View->renderContents()\n#9 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(444): Illuminate\\View\\View->render()\n#10 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(\'emails.reservas...\', Array)\n#11 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), \'emails.reservas...\', NULL, NULL, Array)\n#12 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(\'emails.reservas...\', Array, Object(Closure))\n#13 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#14 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#15 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#16 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#17 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#18 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#19 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#20 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#21 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Container\\Container->call(Array)\n#22 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#24 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(133): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#25 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(135): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#26 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#27 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#28 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(128): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#29 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#30 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#31 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#32 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#33 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#34 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#35 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#36 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#37 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#38 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#39 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#40 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#41 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#42 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#43 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#44 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#46 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#47 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#48 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#49 C:\\xampp\\htdocs\\wadesaresto\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#50 {main}\n\nNext Illuminate\\View\\ViewException: Undefined variable $cancelUrl (View: C:\\xampp\\htdocs\\wadesaresto\\resources\\views\\emails\\reservasi.blade.php) in C:\\xampp\\htdocs\\wadesaresto\\storage\\framework\\views\\c573ac0d8a48c9c84b8a42f076806977.php:53\nStack trace:\n#0 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\PhpEngine.php(59): Illuminate\\View\\Engines\\CompilerEngine->handleViewException(Object(ErrorException), 0)\n#1 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Engines\\CompilerEngine.php(76): Illuminate\\View\\Engines\\PhpEngine->evaluatePath(\'C:\\\\xampp\\\\htdocs...\', Array)\n#2 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(208): Illuminate\\View\\Engines\\CompilerEngine->get(\'C:\\\\xampp\\\\htdocs...\', Array)\n#3 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(191): Illuminate\\View\\View->getContents()\n#4 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\View\\View.php(160): Illuminate\\View\\View->renderContents()\n#5 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(444): Illuminate\\View\\View->render()\n#6 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(419): Illuminate\\Mail\\Mailer->renderView(\'emails.reservas...\', Array)\n#7 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailer.php(312): Illuminate\\Mail\\Mailer->addContent(Object(Illuminate\\Mail\\Message), \'emails.reservas...\', NULL, NULL, Array)\n#8 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(207): Illuminate\\Mail\\Mailer->send(\'emails.reservas...\', Array, Object(Closure))\n#9 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Traits\\Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#10 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\Mailable.php(200): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#11 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Mail\\SendQueuedMailable.php(82): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\MailManager))\n#12 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Mail\\SendQueuedMailable->handle(Object(Illuminate\\Mail\\MailManager))\n#13 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(129): Illuminate\\Container\\Container->call(Array)\n#18 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#19 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#20 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(133): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#21 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(135): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Illuminate\\Mail\\SendQueuedMailable), false)\n#22 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(180): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#23 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(137): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Mail\\SendQueuedMailable))\n#24 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(128): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#25 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Mail\\SendQueuedMailable))\n#26 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#27 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(485): Illuminate\\Queue\\Jobs\\Job->fire()\n#28 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(435): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#29 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(201): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#30 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(148): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#31 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(131): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#32 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#33 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(43): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#34 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(96): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#35 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#36 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(799): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#37 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#38 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Command\\Command.php(341): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#39 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#40 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(1102): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(356): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 C:\\xampp\\htdocs\\wadesaresto\\vendor\\symfony\\console\\Application.php(195): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#43 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(198): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#44 C:\\xampp\\htdocs\\wadesaresto\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php(1235): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#45 C:\\xampp\\htdocs\\wadesaresto\\artisan(16): Illuminate\\Foundation\\Application->handleCommand(Object(Symfony\\Component\\Console\\Input\\ArgvInput))\n#46 {main}', '2026-02-24 10:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'galeri/191wclfVSi3Wni6EAMbSsmm8vOCMkdzeuSuAqrGa.jpg', '2026-02-11 02:12:22', '2026-02-11 02:12:22'),
(2, 'galeri/SNJGdWC2pxAXPJtBwUVMTSmosryrdBxsxdiReIW8.jpg', '2026-02-11 02:12:35', '2026-02-11 02:12:35'),
(3, 'galeri/lmeVmVM1j2LWwiRlyGioCDLyQjCsYi1zSjUiGDJE.jpg', '2026-02-11 02:12:54', '2026-02-11 02:12:54'),
(4, 'galeri/J2ZGfsnOm15Fry0b8cgWTt2gwUSDvI5iFsz1PnvA.jpg', '2026-02-11 02:13:17', '2026-02-11 02:13:17'),
(5, 'galeri/gjKlYIIKik6oVkTNAWix1fLb0kKlb05nphe6mpdK.jpg', '2026-02-11 02:13:30', '2026-02-11 02:13:30'),
(6, 'galeri/wM5eJbZ55OZ5y7GKMC0cINpqPTmDLuAVUiK1gotI.jpg', '2026-02-11 02:13:46', '2026-02-11 02:13:46'),
(7, 'galeri/eO5ps29OU42bkVqMBaxtVrIdyOcUaOI8LFp2HrFj.jpg', '2026-02-11 02:13:59', '2026-02-11 02:13:59'),
(8, 'galeri/1uejVLUDp9FqBYl1hOU9kgHCjYqLt3owebVaMtES.jpg', '2026-02-11 02:14:13', '2026-02-11 02:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id_meja` int(11) UNSIGNED NOT NULL,
  `id_area` int(11) UNSIGNED DEFAULT NULL,
  `kode_meja` varchar(10) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `id_area`, `kode_meja`, `kapasitas`) VALUES
(1, 1, 'I1', 4),
(2, 1, 'I2', 4),
(3, 1, 'I3', 4),
(4, 1, 'I4', 4),
(5, 3, 'O1', 4),
(6, 3, 'O2', 4),
(7, 3, 'O3', 2),
(15, 5, 'V1', 2),
(19, 5, 'V2', 2),
(21, 1, 'I5', 2),
(22, 1, 'I6', 2),
(23, 3, 'O4', 4),
(24, 3, 'O5', 4),
(25, 3, 'O6', 2),
(26, 5, 'V3', 2),
(30, 5, 'V4', 4);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `kategori`, `harga`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Nasi Goreng', 'makanan', 24000.00, 'menu/84dbVXYJ3JXyrCchbhV9kDSvXzNVky1xkKOMBqK9.jpg', '2026-02-11 01:52:34', '2026-02-11 01:52:34'),
(2, 'Pinacolada', 'minuman', 28000.00, 'menu/m3PDx0zLyzkJVjgl8xzklQBzozKCPkmmqxhOaRxK.jpg', '2026-02-11 01:53:21', '2026-02-11 01:53:21'),
(3, 'Coctail Salad', 'makanan', 30000.00, 'menu/jg4Iw2aT23tlKJA6Q5D2QNnxtwfZysxKv7WwW1au.jpg', '2026-02-11 01:54:15', '2026-02-11 01:54:15'),
(4, 'Bebek Betutu', 'makanan', 50000.00, 'menu/6KJaARJASbctT4pYid9Aj48L9SsQC5Q86P3ojhHv.jpg', '2026-02-11 01:55:22', '2026-02-11 01:55:22'),
(5, 'Fuyung Hay', 'makanan', 18000.00, 'menu/QuFdvLgQKCYIgb0fl98GbTIXcUTQMYdpS7CjdieA.jpg', '2026-02-11 01:55:48', '2026-02-11 01:55:48'),
(6, 'Bebek Bakar', 'makanan', 42000.00, 'menu/cc7ICLK1vydXXKF4YsvMgFrORVgdDvcx7qBxTiON.jpg', '2026-02-11 01:56:22', '2026-02-11 01:56:22'),
(7, 'Chicken Vegetable Spring Rolls', 'makanan', 16000.00, 'menu/stkHdQTvLd31ZvhllL5CnWyL8YERA5JSDxrrccZ7.jpg', '2026-02-11 01:57:47', '2026-02-11 01:57:47'),
(8, 'Club Sandwich Chicken', 'makanan', 26000.00, 'menu/yMy1BrSceiJRrA9jjYVdjikYSrkWJtlU9D4lDWa5.jpg', '2026-02-11 01:58:18', '2026-02-11 01:58:18'),
(9, 'Red Velvet Full Cream Milk', 'minuman', 28000.00, 'menu/3tDB7SCI2eO5Lzc73gE3fPcre50n2O1HLxY6BIX1.jpg', '2026-02-11 01:58:53', '2026-02-11 01:58:53'),
(10, 'Wadesa Black Charcoal Frape', 'minuman', 32000.00, 'menu/MMuktjAxlEbZys8KGQmwrI6WaxNKy1UJVkcrh3ul.jpg', '2026-02-11 01:59:39', '2026-02-11 01:59:39'),
(11, 'Chococip Frape', 'minuman', 26000.00, 'menu/ImQrdV5yCwaMYHi90INDJjwhnwAN7RnzS5GuG6XZ.jpg', '2026-02-11 02:00:12', '2026-02-11 02:00:12'),
(12, 'Ice Caramel with Caramel Sauce', 'minuman', 28000.00, 'menu/dWPnoWGJv8DMx6QOaVqZScjdyboL9eRuecXRJYBw.jpg', '2026-02-11 02:00:53', '2026-02-11 02:00:53'),
(13, 'Chicken Burger', 'makanan', 28000.00, 'menu/pXrfRdntvFs7DEU0wqY81qIMeMUrxWzCfPw8itdB.jpg', '2026-02-11 02:02:17', '2026-02-11 02:02:17'),
(14, 'Citrus Cosmopolitan Wadesa Cocktails', 'minuman', 32000.00, 'menu/xVu5Lxv5Kxj6sMtFIpeuLJ22ZgKu87glV4hW6H11.jpg', '2026-02-11 02:03:15', '2026-02-11 02:03:15'),
(15, 'Banana Pancake', 'makanan', 18000.00, 'menu/OtFISMjM9wmxc8iPBdJUfDAOiwoTR9dNz9mxSn30.jpg', '2026-02-11 02:03:55', '2026-02-11 02:03:55'),
(16, 'Pisang Goreng', 'makanan', 16000.00, 'menu/5sw6InSdDJwLx57Ww5Vw8qXugy6rSRcDtUGRRIrq.jpg', '2026-02-11 02:04:46', '2026-02-11 02:04:46'),
(17, 'Wadesa Tuna Steak with Teriyaki Sauce', 'makanan', 45000.00, 'menu/JtoYDjm3wS5qV2jDFo7AynZLti5hro5Do9FRlH2q.jpg', '2026-02-11 02:05:29', '2026-02-11 02:05:29'),
(18, 'Beef Burger', 'makanan', 28000.00, 'menu/Bi0A63wpn7hY7dkjZGUTuW7AoHL2q2hLW2I0Yd6i.jpg', '2026-02-11 02:06:00', '2026-02-11 02:06:00'),
(19, 'Bolognaise Sphagetti', 'makanan', 22000.00, 'menu/kW5Un1SZUHUXJi4I3R0jzwpRlBvXayTRlzCaRDI0.jpg', '2026-02-11 02:06:38', '2026-02-11 02:06:38'),
(20, 'Matcha Latte', 'minuman', 24000.00, 'menu/t1FCvNfqPDuyZit0E8LRgRPjSgHaxmxe15suSHd3.jpg', '2026-02-11 02:07:05', '2026-02-11 02:07:05'),
(21, 'Verdura Pizza', 'makanan', 80000.00, 'menu/4OItVPqK3ypBk7kCfE0YjQumdWhRG0B50rEJ6r5q.jpg', '2026-02-11 02:07:30', '2026-02-11 02:07:30'),
(22, 'Caramel Machiato', 'minuman', 26000.00, 'menu/mGdDLobpAgYmx7XYw72tOQil34c7Gp0Y8XUXNCb2.jpg', '2026-02-11 02:08:18', '2026-02-11 02:08:18'),
(23, 'Coffe Latte', 'minuman', 24000.00, 'menu/P1ynbuTcov2Itysdl5sxISEDTybGKs2yqpBJXMmr.jpg', '2026-02-11 02:09:06', '2026-02-11 02:09:06'),
(24, 'Ice Coffe Aren Sugar', 'minuman', 24000.00, 'menu/FDcCl1pYhkL8KH8aruPmB2Cr8esepyxUSKGczliE.jpg', '2026-02-11 02:09:48', '2026-02-11 02:09:48'),
(25, 'Ice Choco Hazelnut', 'minuman', 22000.00, 'menu/pMXYR2ztJ97rQUPmhzWDNwD9DgKU5i3y6Zc2nIUW.jpg', '2026-02-11 02:10:22', '2026-02-11 02:10:22'),
(26, 'Sunday Red Velvet', 'minuman', 26000.00, 'menu/wy8c2naF6Rb8gC6d420QP8X4B5MTIZqvsIPNcyFO.jpg', '2026-02-11 02:10:57', '2026-02-11 02:10:57'),
(27, 'Chocolate Frape', 'minuman', 22000.00, 'menu/hk36bIYyNWLXv5F6L7NhUomh5fYgOiVKjNRJgoxy.jpg', '2026-02-11 07:48:07', '2026-02-11 07:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_06_062058_create_reservasis_table', 1),
(5, '2026_02_06_062222_create_reservasis_table', 1),
(6, '2026_02_06_065938_create_admins_table', 1),
(7, '2026_02_06_074425_create_menus_table', 1),
(8, '2026_02_07_102522_create_galeris_table', 1),
(9, '2026_02_09_101036_add_photo_to_users_table', 1),
(10, '2026_02_22_195047_create_areas_table', 1),
(11, '2026_02_22_201559_create_meja_table', 1),
(12, '2026_02_23_222445_create_reservation_holds_table', 2),
(13, '2026_02_23_224059_add_hold_token_to_reservasi', 3),
(14, '2026_02_24_210404_create_kategoris_table', 4),
(15, '2026_02_24_233941_add_tipe_to_areas_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$SjjtWSh4SP8kb3dN/0M8DOLtWiQQ62zk.lUGn4Kfbup.2zEEfKuTK', '2026-02-11 03:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` bigint(20) UNSIGNED NOT NULL,
  `kode_booking` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `tanggal_reservasi` date NOT NULL,
  `jam_reservasi` time NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `id_area` int(11) UNSIGNED DEFAULT NULL,
  `id_meja` int(11) UNSIGNED DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hold_token` varchar(255) DEFAULT NULL,
  `hold_expired` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `kode_booking`, `nama_pelanggan`, `email`, `no_hp`, `tanggal_reservasi`, `jam_reservasi`, `jumlah_orang`, `id_area`, `id_meja`, `catatan`, `status`, `is_read`, `created_at`, `updated_at`, `hold_token`, `hold_expired`) VALUES
(2, 'WD-F60755AF', 'Joe', 'joebudden703@gmail.com', '0895413476633', '2026-02-12', '08:00:00', 6, NULL, NULL, 'siapkan parkir', 'cancelled', 0, '2026-02-11 09:11:59', '2026-02-11 09:18:05', NULL, NULL),
(3, 'WD-C6797DE7', 'ketut', 'stutnasne@gmail.com', '0895413476633', '2026-02-12', '14:00:00', 2, NULL, NULL, NULL, 'confirmed', 0, '2026-02-11 09:17:46', '2026-02-11 09:18:12', NULL, NULL),
(4, 'WD-60EA0213', 'nyoman', 'nyoman@gmail.com', '212121212112', '2026-02-12', '11:00:00', 4, NULL, NULL, NULL, 'cancelled', 0, '2026-02-11 09:20:04', '2026-02-11 09:24:18', NULL, NULL),
(5, 'WD-CD087843', 'made', 'made@gmail.com', '0895413476633', '2026-02-13', '15:00:00', 10, NULL, NULL, NULL, 'cancelled', 0, '2026-02-11 09:24:56', '2026-02-11 09:25:57', NULL, NULL),
(6, 'WD-68FFD498', 'gede', 'gede@gmail.com', '3232323', '2026-02-14', '15:00:00', 4, NULL, NULL, NULL, 'cancelled', 0, '2026-02-11 09:25:36', '2026-02-11 09:25:52', NULL, NULL),
(7, 'WD-7D468438', 'wira', 'kadwir@gmail.com', '1212121121122', '2026-02-14', '13:00:00', 2, NULL, NULL, 'ulang tahun pacar', 'confirmed', 0, '2026-02-13 02:13:18', '2026-02-13 02:15:06', NULL, NULL),
(8, 'WD-E9C78E05', 'made', 'made@gmail.com', '2112121212', '2026-02-14', '11:00:00', 28, NULL, NULL, NULL, 'cancelled', 0, '2026-02-13 13:29:15', '2026-02-13 15:45:10', NULL, NULL),
(9, 'WD-1FD9C005', 'kadek', 'kadek@gmail.com', '1212121212', '2026-02-14', '11:00:00', 4, NULL, NULL, NULL, 'cancelled', 0, '2026-02-13 15:58:18', '2026-02-13 16:00:36', NULL, NULL),
(10, 'WD-DF748B93', 'kadek1', 'kadek@gmail.com', '1212121212', '2026-02-14', '11:00:00', 26, NULL, NULL, NULL, 'confirmed', 0, '2026-02-13 15:58:41', '2026-02-13 16:00:45', NULL, NULL),
(11, 'WD-E6D55535', 'kadek2', 'kadek@gmail.com', '1212121212', '2026-02-15', '09:00:00', 2, NULL, NULL, NULL, 'cancelled', 0, '2026-02-14 15:10:08', '2026-02-16 06:30:46', NULL, NULL),
(12, 'WD-7C5C02E9', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-16', '17:00:00', 2, NULL, NULL, 'ulang tahun', 'cancelled', 0, '2026-02-16 07:59:22', '2026-02-17 06:59:21', NULL, NULL),
(13, 'WD-E0EE16F9', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmaill.com', '0895413476633', '2026-02-17', '08:00:00', 2, NULL, NULL, 'meja belakang', 'confirmed', 0, '2026-02-16 10:24:27', '2026-02-17 06:59:29', NULL, NULL),
(14, 'WD-24A7E94F', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmailll.com', '0895413476633', '2026-02-17', '08:00:00', 2, NULL, NULL, NULL, 'cancelled', 0, '2026-02-16 10:28:37', '2026-02-19 10:40:29', NULL, NULL),
(15, 'WD-B903DF4E', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-17', '09:00:00', 2, NULL, NULL, NULL, 'confirmed', 0, '2026-02-16 10:48:31', '2026-02-19 10:02:43', NULL, NULL),
(16, 'WD-30576513', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-17', '16:00:00', 28, NULL, NULL, NULL, 'confirmed', 0, '2026-02-17 07:33:04', '2026-02-19 09:57:06', NULL, NULL),
(17, 'WD-636E1BD9', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-19', '18:00:00', 28, NULL, NULL, NULL, 'cancelled', 0, '2026-02-19 09:14:29', '2026-02-19 09:27:20', NULL, NULL),
(18, 'WD-9C5A3EBC', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-19', '19:00:00', 20, NULL, NULL, 'bla bla bla', 'confirmed', 0, '2026-02-19 09:30:40', '2026-02-19 09:44:05', NULL, NULL),
(19, 'WD-59CB4715', 'MADE AMBHURAJA DEEVAN', 'stutnasne@gmail.com', '0895413476633', '2026-02-20', '19:00:00', 20, NULL, NULL, 'ulang tahun', 'confirmed', 0, '2026-02-19 10:03:59', '2026-02-19 10:40:19', NULL, NULL),
(20, 'WD-66239779', 'MADE', 'stutnasne@gmail.com', '0895413476633', '2026-02-20', '19:00:00', 5, NULL, NULL, 'mmskasmkamsak', 'confirmed', 0, '2026-02-19 10:11:42', '2026-02-19 10:40:04', NULL, NULL),
(21, 'WD-A14E2F2E', 'MADE', 'stutnasne@gmail.com', '0895413476633', '2026-02-21', '08:00:00', 5, NULL, NULL, NULL, 'confirmed', 0, '2026-02-19 10:16:20', '2026-02-19 10:37:44', NULL, NULL),
(22, 'WD-67DF7F1B', 'joe', 'stutnasne@gmail.com', '0895413476633', '2026-02-21', '08:00:00', 5, NULL, NULL, NULL, 'cancelled', 0, '2026-02-19 10:19:18', '2026-02-19 10:21:22', NULL, NULL),
(23, 'WD-0084E6FC', 'pak joe', 'stutnasne@gmail.com', '0895413476633', '2026-02-24', '18:00:00', 5, NULL, NULL, 'abbbababa', 'confirmed', 0, '2026-02-19 10:31:06', '2026-02-19 10:31:40', NULL, NULL),
(24, 'WD-C4F3D037', 'joe budden', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-24', '16:00:00', 2, NULL, NULL, 'sbasbansabs', 'confirmed', 0, '2026-02-19 10:40:55', '2026-02-19 10:41:06', NULL, NULL),
(25, 'WD-CACFCCA7', 'fatjoe', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-28', '09:00:00', 2, NULL, NULL, 'wwwwwwwwwwww', 'confirmed', 0, '2026-02-19 10:46:36', '2026-02-19 10:46:44', NULL, NULL),
(26, 'WD-8941D7A0', 'DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-26', '18:00:00', 3, NULL, NULL, 'bhhhhhhh', 'confirmed', 0, '2026-02-19 10:47:27', '2026-02-19 10:50:31', NULL, NULL),
(27, 'WD-5C0B6836', 'raja', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-20', '15:00:00', 3, NULL, NULL, 'asssssssss', 'confirmed', 0, '2026-02-19 11:11:58', '2026-02-19 11:12:14', NULL, NULL),
(28, 'WD-A72FB276', 'deevan', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-20', '14:00:00', 3, NULL, NULL, 'cccccccccc', 'cancelled', 0, '2026-02-19 12:02:38', '2026-02-19 12:18:39', NULL, NULL),
(29, 'WD-66F5C2EF', 'deevan', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-20', '14:00:00', 3, NULL, NULL, 'cccccccccc', 'confirmed', 0, '2026-02-19 12:02:47', '2026-02-19 12:03:24', NULL, NULL),
(30, 'WD-9D6703F8', 'asu', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-20', '18:00:00', 3, NULL, NULL, NULL, 'confirmed', 0, '2026-02-19 12:14:47', '2026-02-19 12:19:41', NULL, NULL),
(31, 'WD-50D11EFD', 'asu', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-20', '18:00:00', 3, NULL, NULL, NULL, 'confirmed', 0, '2026-02-19 12:18:20', '2026-02-19 12:18:45', NULL, NULL),
(32, 'WD-12C86986', 'joeeeee', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-21', '08:00:00', 2, NULL, NULL, 'ajsjsjsj', 'confirmed', 0, '2026-02-19 12:25:31', '2026-02-19 12:25:51', NULL, NULL),
(33, 'WD-FCDF88AB', 'asu', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '10:00:00', 2, NULL, NULL, 'aaa', 'confirmed', 0, '2026-02-19 14:01:50', '2026-02-19 14:02:06', NULL, NULL),
(34, 'WD-2E893033', 'trisna', 'komangtrisna1401@gmail.com', '0895413476633', '2026-02-21', '13:00:00', 2, NULL, NULL, 'ulang tahun ppacar', 'confirmed', 0, '2026-02-20 14:04:33', '2026-02-20 14:05:27', NULL, NULL),
(35, 'WD-030F0947', 'asu', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-21', '09:00:00', 2, NULL, NULL, NULL, 'confirmed', 0, '2026-02-20 14:26:36', '2026-02-20 14:26:47', NULL, NULL),
(36, 'WD-97A581BD', 'trisna', 'komangtrisna1401@gmail.com', '0895413476633', '2026-02-21', '10:00:00', 2, NULL, NULL, NULL, 'confirmed', 0, '2026-02-20 14:35:36', '2026-02-20 14:35:46', NULL, NULL),
(37, 'WD-CC148C74', 'trisna', 'komangtrisna1401@gmail.com', '0895413476633', '2026-02-21', '16:00:00', 2, NULL, NULL, 'aa', 'confirmed', 0, '2026-02-20 14:41:49', '2026-02-20 14:41:57', NULL, NULL),
(38, 'WD-86509D76', 'trisna', 'komangtrisna1401@gmail.com', '0895413476633', '2026-02-21', '16:00:00', 2, NULL, NULL, 'aa', 'confirmed', 0, '2026-02-20 14:55:56', '2026-02-20 14:56:06', NULL, NULL),
(39, 'WD-B4317496', 'asu', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-27', '18:00:00', 2, NULL, NULL, NULL, 'confirmed', 0, '2026-02-20 14:56:43', '2026-02-20 14:56:58', NULL, NULL),
(40, 'WD-67F988DE', 'trisna', 'komangtrisna1401@gmail.com', '0895413476633', '2026-02-21', '09:00:00', 2, NULL, NULL, 'aa', 'confirmed', 0, '2026-02-20 15:01:21', '2026-02-20 15:01:28', NULL, NULL),
(41, 'WD-11BEF48C', 'trisna', 'komangtrisna1401@gmail.com', '0895413476633', '2026-02-21', '19:00:00', 2, NULL, NULL, NULL, 'confirmed', 0, '2026-02-20 15:05:15', '2026-02-20 15:05:22', NULL, NULL),
(42, 'WD-88E742EB', 'asu', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-21', '18:00:00', 2, NULL, NULL, NULL, 'confirmed', 0, '2026-02-20 15:06:39', '2026-02-20 15:06:49', NULL, NULL),
(43, 'WD-E7BE8A3C', 'komang trisna', 'komangtrisna1401@gmail.com', '0895413476633', '2026-02-22', '14:00:00', 10, NULL, NULL, 'acara keluarga', 'cancelled', 0, '2026-02-20 15:11:15', '2026-02-20 15:12:12', NULL, NULL),
(44, 'WD-01392F8C', 'asu', 'suastikadharmaputra@gmail.com', '0897867676', '2026-02-22', '10:00:00', 2, NULL, NULL, NULL, 'confirmed', 0, '2026-02-21 10:30:42', '2026-02-21 10:30:50', NULL, NULL),
(45, 'WD-AC9FD131', 'suastika', 'suastikadharmaputra@gmail.com', '0897867676', '2026-02-22', '13:00:00', 2, NULL, NULL, 'hgh', 'confirmed', 0, '2026-02-21 10:32:54', '2026-02-21 10:33:00', NULL, NULL),
(46, 'WD-85C638CD', 'suastika', 'suastikadharmaputra@gmail.com', '0897867676', '2026-02-27', '09:00:00', 2, NULL, NULL, NULL, 'confirmed', 0, '2026-02-21 10:36:21', '2026-02-21 10:36:28', NULL, NULL),
(48, 'WD-9ABFC627', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '13:00:00', 15, NULL, NULL, NULL, 'cancelled', 0, '2026-02-21 12:11:21', '2026-02-21 14:20:37', NULL, NULL),
(49, 'WD-F0C9D3E8', 'joe', 'ambhurajadeevan@gmail.com', '0897867676', '2026-02-22', '13:00:00', 10, NULL, NULL, NULL, 'cancelled', 0, '2026-02-21 12:12:20', '2026-02-21 14:20:31', NULL, NULL),
(50, 'WD-0AE72C87', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '08:00:00', 15, NULL, NULL, NULL, 'cancelled', 0, '2026-02-21 12:23:02', '2026-02-21 14:20:27', NULL, NULL),
(51, 'WD-C76831F2', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '08:00:00', 15, NULL, NULL, NULL, 'cancelled', 0, '2026-02-21 12:23:19', '2026-02-21 14:20:24', NULL, NULL),
(52, 'WD-DFEB78B6', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '08:00:00', 15, NULL, NULL, NULL, 'cancelled', 0, '2026-02-21 12:34:18', '2026-02-21 14:20:20', NULL, NULL),
(53, 'WD-52095735', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '08:00:00', 15, NULL, NULL, NULL, 'cancelled', 0, '2026-02-21 12:34:37', '2026-02-21 14:20:13', NULL, NULL),
(55, 'WD-10235C4E', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '08:00:00', 15, 4, NULL, NULL, 'cancelled', 0, '2026-02-21 12:51:58', '2026-02-21 14:20:08', NULL, NULL),
(56, 'WD-4C6EADB3', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '08:00:00', 15, 4, NULL, NULL, 'cancelled', 0, '2026-02-21 12:52:14', '2026-02-21 14:20:04', NULL, NULL),
(57, 'WD-DDA45D68', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '08:00:00', 15, 4, NULL, NULL, 'cancelled', 0, '2026-02-21 12:59:51', '2026-02-21 14:19:59', NULL, NULL),
(58, 'WD-513A752A', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '08:00:00', 15, 4, NULL, NULL, 'cancelled', 0, '2026-02-21 13:00:07', '2026-02-21 14:19:52', NULL, NULL),
(59, 'WD-7413EA7D', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-23', '08:00:00', 15, 4, NULL, NULL, 'cancelled', 0, '2026-02-21 13:07:37', '2026-02-21 14:19:17', NULL, NULL),
(60, 'WD-6EC10DA9', 'joe', 'joe@gmail.com', '0897867676', '2026-02-22', '09:00:00', 10, 4, NULL, NULL, 'cancelled', 0, '2026-02-21 13:08:15', '2026-02-21 14:19:10', NULL, NULL),
(61, 'WD-437C3A1D', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-26', '12:00:00', 15, 4, NULL, NULL, 'cancelled', 0, '2026-02-21 13:25:30', '2026-02-21 14:19:06', NULL, NULL),
(62, 'WD-A529242E', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '16:00:00', 3, 1, 3, 'aaa', 'cancelled', 0, '2026-02-21 14:00:25', '2026-02-21 14:19:02', NULL, NULL),
(64, 'WD-77D5793C', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-25', '18:00:00', 10, 4, NULL, 'aaa', 'confirmed', 0, '2026-02-21 14:11:32', '2026-02-21 14:12:51', NULL, NULL),
(65, 'WD-77707EF5', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-25', '11:00:00', 3, 3, 5, NULL, 'confirmed', 0, '2026-02-22 07:21:17', '2026-02-22 09:40:01', NULL, NULL),
(66, 'WD-C193F4E6', 'DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-23', '09:00:00', 2, 1, 3, 'halo', 'confirmed', 0, '2026-02-22 07:57:26', '2026-02-22 09:36:23', NULL, NULL),
(67, 'WD-7C903AFC', 'pak joe ganteng', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-23', '08:00:00', 4, 1, 4, 'hai', 'confirmed', 0, '2026-02-22 08:12:05', '2026-02-22 09:33:53', NULL, NULL),
(68, 'WD-FF5B99AD', 'ibu putri', 'stutnasne@gmail.com', '082134678998', '2026-02-23', '15:00:00', 6, 1, 1, 'halo wadesa', 'confirmed', 0, '2026-02-22 09:09:29', '2026-02-22 09:11:59', NULL, NULL),
(69, 'WD-5676C68B', 'JOE BUDDEN', 'joebudden703@gmail.com', '087883412345', '2026-02-27', '16:00:00', 6, 1, 2, 'HAI RESTO WADESA', 'confirmed', 0, '2026-02-22 09:35:25', '2026-02-22 09:35:31', NULL, NULL),
(70, 'WD-87750934', 'ibu putri', 'stutnasne@gmail.com', '082134678998', '2026-02-23', '09:00:00', 6, 1, 2, NULL, 'confirmed', 0, '2026-02-22 09:40:57', '2026-02-22 09:41:03', NULL, NULL),
(71, 'WD-BDB97D68', 'ibu putri', 'stutnasne@gmail.com', '082134678998', '2026-02-26', '13:00:00', 6, 1, 1, NULL, 'confirmed', 0, '2026-02-22 09:51:31', '2026-02-22 09:51:38', NULL, NULL),
(72, 'WD-5AEB8DD1', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-28', '09:00:00', 6, 1, 1, 'hai', 'confirmed', 0, '2026-02-22 10:10:46', '2026-02-22 10:10:52', NULL, NULL),
(73, 'WD-C5B065F0', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-24', '08:00:00', 6, 1, 1, NULL, 'confirmed', 0, '2026-02-22 10:14:59', '2026-02-22 10:15:04', NULL, NULL),
(74, 'WD-2237B73A', 'joe', 'joebudden703@gmail.com', '0897867676', '2026-02-23', '19:00:00', 6, 1, 2, 'yo wadesa', 'confirmed', 0, '2026-02-22 10:17:12', '2026-02-22 10:17:17', NULL, NULL),
(75, 'WD-20388D36', 'Made', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '19:00:00', 4, 3, 6, 'beri pengalaman terbaik ya!!', 'confirmed', 0, '2026-02-22 10:21:32', '2026-02-22 10:21:38', NULL, NULL),
(76, 'WD-A57FD31E', 'Made', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-22', '19:00:00', 4, 3, 5, NULL, 'confirmed', 0, '2026-02-22 10:25:13', '2026-02-22 10:25:20', NULL, NULL),
(77, 'WD-64E1E500', 'aditya pramadiksa', 'adityapramadiksa18@gmail.com', '0895413476633', '2026-02-23', '10:00:00', 4, 1, 3, 'keluarga', 'confirmed', 0, '2026-02-22 10:53:32', '2026-02-22 10:53:51', NULL, NULL),
(78, 'WD-2E5ECC03', 'suastika dharma', 'suastikadharmaputra@gmail.com', '212121212112', '2026-02-23', '18:00:00', 2, 3, 7, NULL, 'confirmed', 0, '2026-02-23 09:00:47', '2026-02-23 09:01:31', NULL, NULL),
(79, 'WD-CE2FD938', 'rahyog', 'yogatriana423@gmail.com', '9018729912121', '2026-02-27', '16:00:00', 2, 3, 7, NULL, 'confirmed', 0, '2026-02-23 09:31:59', '2026-02-23 09:44:53', NULL, NULL),
(80, 'WD-3D76B863', 'rahyog', 'yogatriana423@gmail.com', '9018729912121', '2026-02-25', '19:00:00', 4, 1, 4, 'vuvuuvvu', 'cancelled', 0, '2026-02-23 09:32:48', '2026-02-23 09:43:44', NULL, NULL),
(81, 'WD-484CF0BD', 'rahyog', 'yogatriana423@gmail.com', '9018729912121', '2026-02-26', '19:00:00', 2, 1, 1, 'aniv pacar', 'confirmed', 0, '2026-02-23 09:38:30', '2026-02-23 09:39:12', NULL, NULL),
(82, 'WD-14CB1225', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-27', '18:00:00', 2, 1, 3, NULL, 'cancelled', 0, '2026-02-23 10:02:16', '2026-02-23 10:02:55', NULL, NULL),
(83, 'WD-7826C2B0', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-25', '15:00:00', 2, 3, 6, NULL, 'cancelled', 0, '2026-02-23 16:00:30', '2026-02-23 16:04:22', NULL, NULL),
(84, 'WD-FC6F96D8', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-26', '15:00:00', 2, 3, 6, NULL, 'confirmed', 0, '2026-02-23 16:06:16', '2026-02-23 16:06:28', NULL, NULL),
(87, 'WD-7D30F6D4', 'made joe', 'ambhurajadeevan@gmail.com', '12121212121212', '2026-02-25', '08:00:00', 2, 1, 1, 'bla', 'confirmed', 0, '2026-02-23 17:38:36', '2026-02-23 17:38:36', NULL, NULL),
(88, 'WD-8AF0D44D', 'aris', 'imadearis6@gmail.com', '121212121211', '2026-02-25', '13:00:00', 2, 3, 6, 'aniv pacar', 'confirmed', 0, '2026-02-23 17:42:30', '2026-02-23 17:42:30', NULL, NULL),
(89, 'WD-A6CE197E', 'joe', 'ambhurajadeevan@gmail.com', '211111111111111111111', '2026-02-25', '13:00:00', 2, 5, 15, 'ssssss', 'confirmed', 0, '2026-02-23 17:54:33', '2026-02-23 17:54:33', NULL, NULL),
(90, 'WD-6904A7D8', 'joe', 'ambhurajadeevan@gmail.com', '211111111111111111111', '2026-02-27', '14:00:00', 4, 1, 2, 'qqq', 'confirmed', 0, '2026-02-23 18:03:43', '2026-02-23 18:03:43', NULL, NULL),
(91, 'WD-66598A72', 'joe', 'ambhurajadeevan@gmail.com', '211111111111111111111', '2026-02-25', '16:00:00', 6, 1, 2, NULL, 'confirmed', 0, '2026-02-23 18:07:00', '2026-02-23 18:07:00', NULL, NULL),
(92, 'WD-90C2A06A', 'joe', 'ambhurajadeevan@gmail.com', '211111111111111111111', '2026-02-27', '17:00:00', 6, 1, 1, NULL, 'confirmed', 0, '2026-02-24 08:14:30', '2026-02-24 08:14:30', NULL, NULL),
(93, 'WD-0BA900A3', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-25', '17:00:00', 4, 1, 2, 'tamu inggris', 'cancelled', 0, '2026-02-24 09:33:05', '2026-02-24 09:35:54', NULL, NULL),
(94, 'WD-C83C715D', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-03-02', '17:00:00', 5, 1, 1, 'b', 'confirmed', 0, '2026-02-24 09:51:56', '2026-02-24 09:51:56', NULL, NULL),
(95, 'WD-87947860', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-03-05', '12:00:00', 5, 6, NULL, NULL, 'confirmed', 0, '2026-02-24 10:01:08', '2026-02-24 10:01:08', NULL, NULL),
(96, 'WD-E80A960C', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-03-04', '14:00:00', 2, 3, 7, NULL, 'confirmed', 0, '2026-02-24 10:13:10', '2026-02-24 10:13:10', NULL, NULL),
(97, 'WD-FEB860CB', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-03-06', '19:00:00', 17, 4, NULL, NULL, 'confirmed', 0, '2026-02-24 10:15:11', '2026-02-24 10:15:11', NULL, NULL),
(98, 'WD-8E59F6DA', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-27', '17:00:00', 2, 1, 3, NULL, 'cancelled', 0, '2026-02-24 10:18:48', '2026-02-24 10:19:58', NULL, NULL),
(99, 'WD-B3AE380E', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-03-12', '15:00:00', 7, 6, NULL, NULL, 'cancelled', 0, '2026-02-24 10:24:13', '2026-02-24 10:24:36', NULL, NULL),
(100, 'WD-4C5F35ED', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-25', '17:00:00', 2, 3, 7, NULL, 'cancelled', 0, '2026-02-24 10:28:54', '2026-02-24 10:29:19', NULL, NULL),
(101, 'WD-7BEE1E2A', 'pt ambhuraja', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-03-11', '16:00:00', 20, 4, NULL, NULL, 'cancelled', 0, '2026-02-24 10:34:59', '2026-02-24 10:35:22', NULL, NULL),
(102, 'WD-3C977A36', 'pt ambhuraja', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-03-03', '15:00:00', 4, 1, 3, NULL, 'cancelled', 0, '2026-02-24 10:38:32', '2026-02-24 10:38:47', NULL, NULL),
(103, 'WD-009384B4', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-03-05', '14:00:00', 8, 4, NULL, NULL, 'cancelled', 0, '2026-02-24 10:39:52', '2026-02-24 10:51:27', NULL, NULL),
(104, 'WD-67D836F3', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-03-04', '16:00:00', 6, 1, 1, NULL, 'cancelled', 0, '2026-02-24 10:52:49', '2026-02-24 10:53:07', NULL, NULL),
(105, 'WD-41F9BE24', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-25', '08:00:00', 3, 1, 3, NULL, 'cancelled', 0, '2026-02-24 10:55:40', '2026-02-24 10:55:55', NULL, NULL),
(106, 'WD-15035F1D', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-03-07', '09:00:00', 4, 1, 4, NULL, 'cancelled', 0, '2026-02-24 10:56:25', '2026-02-24 10:56:36', NULL, NULL),
(107, 'WD-94F9280E', 'pt jasamarga', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-26', '13:00:00', 16, 4, NULL, NULL, 'confirmed', 0, '2026-02-24 11:00:03', '2026-02-24 11:00:03', NULL, NULL),
(108, 'WD-6994D2B2', 'pt jasamarga', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-27', '15:00:00', 13, 4, NULL, NULL, 'cancelled', 0, '2026-02-24 11:30:18', '2026-02-24 11:30:35', NULL, NULL),
(109, 'WD-287CD54C', 'pt jasamarga', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-27', '16:00:00', 2, 5, 19, NULL, 'confirmed', 0, '2026-02-24 14:04:15', '2026-02-24 14:04:15', NULL, NULL),
(110, 'WD-A6BB3B74', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-28', '11:00:00', 5, 5, 15, 'bbbbb', 'confirmed', 0, '2026-02-24 14:40:24', '2026-02-24 14:40:24', NULL, NULL),
(111, 'WD-FC59E583', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-26', '12:00:00', 4, 1, 1, 'tambah lagi 2 kursi', 'cancelled', 0, '2026-02-24 16:25:57', '2026-02-24 16:32:07', NULL, NULL),
(113, 'WD-22E687A5', 'MADE AMBHURAJA DEEVAN', 'ambhurajadeevan@gmail.com', '0895413476633', '2026-02-26', '17:00:00', 4, 1, 1, 'hai', 'confirmed', 0, '2026-02-25 06:57:56', '2026-02-25 06:57:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservasis`
--

CREATE TABLE `reservasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_holds`
--

CREATE TABLE `reservation_holds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adult` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_area` bigint(20) UNSIGNED NOT NULL,
  `id_meja` bigint(20) UNSIGNED DEFAULT NULL,
  `hold_token` varchar(255) NOT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rRRm7xAtqY9awr4awit9201eOU6m0lPbfaEp22aT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZzAwUHljVnVlRVNGamFsV1RCb2xQYzdGQ2Y2Y3BpWWtNT3R4cUdzMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9yZXNlcnZhc2kvanNvbiI7czo1OiJyb3V0ZSI7czoyMDoiYWRtaW4ucmVzZXJ2YXNpLmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1772004306);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$ogTidAGN.fpciBvxI2YL7.Z3VNtHy5ZnoMIVzbAaxmyIEyJhZd52q', NULL, '2026-02-11 01:24:26', '2026-02-11 01:24:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`),
  ADD KEY `id_area` (`id_area`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD UNIQUE KEY `reservasi_kode_booking_unique` (`kode_booking`),
  ADD KEY `fk_reservasi_area` (`id_area`),
  ADD KEY `fk_reservasi_meja` (`id_meja`);

--
-- Indexes for table `reservasis`
--
ALTER TABLE `reservasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation_holds`
--
ALTER TABLE `reservation_holds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservation_holds_hold_token_unique` (`hold_token`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id_meja` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `reservasis`
--
ALTER TABLE `reservasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_holds`
--
ALTER TABLE `reservation_holds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `fk_reservasi_area` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservasi_meja` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
