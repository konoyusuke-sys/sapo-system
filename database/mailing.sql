-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Авг 26 2024 г., 16:17
-- Версия сервера: 10.6.18-MariaDB-cll-lve
-- Версия PHP: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mailing`
--

-- --------------------------------------------------------

--
-- Структура таблицы `configs`
--

CREATE TABLE `configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_name` varchar(191) NOT NULL,
  `app_name_abv` varchar(191) NOT NULL,
  `app_slogan` varchar(191) DEFAULT NULL,
  `captcha` varchar(191) NOT NULL,
  `datasitekey` varchar(191) DEFAULT NULL,
  `recaptcha_secret` varchar(191) DEFAULT NULL,
  `img_login` varchar(191) NOT NULL,
  `caminho_img_login` varchar(191) DEFAULT NULL,
  `tamanho_img_login` int(11) DEFAULT NULL,
  `titulo_login` varchar(191) NOT NULL,
  `layout` varchar(191) NOT NULL,
  `skin` varchar(191) NOT NULL,
  `favicon` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `default_role_id` varchar(191) NOT NULL DEFAULT '2',
  `register` varchar(191) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `configs`
--

INSERT INTO `configs` (`id`, `app_name`, `app_name_abv`, `app_slogan`, `captcha`, `datasitekey`, `recaptcha_secret`, `img_login`, `caminho_img_login`, `tamanho_img_login`, `titulo_login`, `layout`, `skin`, `favicon`, `created_at`, `updated_at`, `default_role_id`, `register`) VALUES
(1, 'ライフコネクト', 'ラ', 'ライフコネクト', 'F', NULL, NULL, 'T', 'img/config/logo.png', 40, '<a href=\"#\" ><b>ライフコネクト</b> </a>', 'fixed', 'blue', 'img/config/favicon.png', '2024-08-05 21:44:27', '2024-08-18 23:04:05', '2', 'T');

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_admin`
--

CREATE TABLE `dtb_admin` (
  `id` bigint(20) NOT NULL COMMENT 'id',
  `division_id` int(11) NOT NULL DEFAULT 0 COMMENT '権限ID',
  `name` text DEFAULT NULL COMMENT '氏名',
  `email` varchar(255) NOT NULL COMMENT 'E-Mail',
  `password` varchar(255) NOT NULL COMMENT 'パスワード',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `del_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ 1=>削除',
  `last_update_date` datetime NOT NULL COMMENT '最終更新日時',
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='運営者管理';

--
-- Дамп данных таблицы `dtb_admin`
--

INSERT INTO `dtb_admin` (`id`, `division_id`, `name`, `email`, `password`, `status`, `del_flg`, `last_update_date`, `update_date`, `create_date`) VALUES
(1, 1, 'システム管理者', 'actign@gmail.com', 'a33d71dc254e94f5cf8ba6ccb819118ab071b0713c417b1e724b87480d790bbd', 1, 0, '2016-06-04 12:21:21', '2016-06-04 16:21:21', '2016-06-04 16:21:21'),
(2, 1, '運営者', 'app@actign.jp', '1b256deb559d84ddf9f73e7d9cb25cfd2bbbf75ac63038e15484d25ff93a4c2b', 1, 0, '2017-03-01 12:55:56', '2017-03-22 14:43:16', '2017-03-01 17:55:56'),
(3, 1, '事務局', 'sokuyushi@sokuyushi.net', 'e6b4754a0c81786e4664a947c0a685eb783e6dd6d07d432f5aa4225af952c0b3', 1, 0, '2017-03-22 10:48:33', '2017-03-22 14:48:33', '2017-03-22 14:48:33');

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_config`
--

CREATE TABLE `dtb_config` (
  `id` bigint(20) NOT NULL COMMENT 'id',
  `config_id` int(11) NOT NULL DEFAULT 0 COMMENT '設定ID',
  `data` text DEFAULT NULL COMMENT '設定値',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `del_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ 1=>削除',
  `last_update_date` datetime NOT NULL COMMENT '最終更新日時',
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='各種設定管理';

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_file`
--

CREATE TABLE `dtb_file` (
  `id` bigint(20) NOT NULL COMMENT 'id',
  `resource_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=>メディア管理 2=>サポート 3=>課題',
  `resource_id` bigint(20) DEFAULT NULL COMMENT 'リソースID',
  `user_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '作成者 1=>管理者 2=>運営者 3=>メンバー',
  `user_id` bigint(20) NOT NULL DEFAULT 0 COMMENT 'ユーザーID',
  `file_type` varchar(255) DEFAULT NULL COMMENT 'ファイルタイプ MIME-Type',
  `file_name` text DEFAULT NULL COMMENT '元ファイル名',
  `file_rename` varchar(255) DEFAULT NULL COMMENT '保存ファイル名',
  `file_extension` varchar(255) DEFAULT NULL COMMENT '拡張子',
  `secret_key` varchar(255) DEFAULT NULL COMMENT '秘密キー',
  `save_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '保存フラグ 0=>一時保存 1=>本保存',
  `memo` text DEFAULT NULL COMMENT '備考欄',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `del_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ',
  `last_update_date` datetime NOT NULL COMMENT '最終更新日時',
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='ファイル管理';

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_form`
--

CREATE TABLE `dtb_form` (
  `id` int(11) NOT NULL COMMENT 'id',
  `slug` text NOT NULL COMMENT 'スラッグ名',
  `name` text NOT NULL COMMENT 'タイトル',
  `comment` text DEFAULT NULL COMMENT '本文',
  `mail_title` text DEFAULT NULL COMMENT 'メールタイトル',
  `mail_body` text DEFAULT NULL COMMENT 'メール本文',
  `from_name` text DEFAULT NULL COMMENT '送信者名',
  `from_email` text DEFAULT NULL COMMENT '送信者E-Mail',
  `stand_expa` varchar(255) DEFAULT NULL COMMENT 'メールスタンド連携エキスパ',
  `memo` text DEFAULT NULL COMMENT 'メモ',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `del_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ 1=>削除',
  `last_update_date` datetime NOT NULL COMMENT '最終更新日時',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `created_at` timestamp NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='フォーム管理';

--
-- Дамп данных таблицы `dtb_form`
--

INSERT INTO `dtb_form` (`id`, `slug`, `name`, `comment`, `mail_title`, `mail_body`, `from_name`, `from_email`, `stand_expa`, `memo`, `status`, `del_flg`, `last_update_date`, `updated_at`, `created_at`) VALUES
(1, 'form', '申し込みフォーム', NULL, '【ライフコネクト】お申込みを受け付けました', '%%name%%様\r\n\r\nこの度は「ライフコネクト」に\r\n審査依頼を頂き、誠にありがとうございます。\r\n\r\n申込みから10分前後で\r\n融資可能業者から連絡が入ります。\r\n\r\n審査待ちの時間が待てないという方は\r\n個人間融資直通の電話番号を\r\n記載しておきますので直接お問い合わせください。\r\n\r\nTEL 080-2685-2436\r\n\r\nヒヤリング後、\r\nご自身の返済計画と合いそうな場合のみ\r\nお申込みください。\r\n\r\n「連絡がつながらない」\r\n\r\n「電話番号の入力が間違っている」\r\n\r\nなどの不備がございますと、\r\n融資を受けられなくなりますので、\r\nご注意ください。\r\n\r\n------------------------\r\n\r\nお申込みを下記のとおり\r\n受付しました。\r\n\r\n------------------------\r\n\r\n\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n\r\n－－－－－－－－－－－－－－－－－－－－－－－\r\nライフコネクト\r\n－－－－－－－－－－－－－－－－－－－－－－－', 'ライフコネクト', 'admin@supatla.com', NULL, NULL, 1, 0, '2019-03-15 10:08:26', '2024-08-18 22:34:58', '2017-03-16 01:47:29');

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_form_sender`
--

CREATE TABLE `dtb_form_sender` (
  `id` int(11) NOT NULL COMMENT 'id',
  `form_id` int(11) NOT NULL DEFAULT 0 COMMENT 'フォームID',
  `group_id` int(11) NOT NULL DEFAULT 0 COMMENT 'グループID',
  `email` varchar(255) NOT NULL COMMENT 'E-Mail',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '表示順',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `del_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ 1=>削除',
  `last_update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最終更新日時',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='フォーム送信先管理';

--
-- Дамп данных таблицы `dtb_form_sender`
--

INSERT INTO `dtb_form_sender` (`id`, `form_id`, `group_id`, `email`, `sort`, `status`, `del_flg`, `last_update_date`, `updated_at`, `created_at`) VALUES
(6, 1, 27, 'xwhph14705@yahoo.co.jp', 0, 1, 0, '2024-08-23 07:52:59', '2024-08-23 07:52:59', '2024-08-20 08:12:31');

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_form_sender_group`
--

CREATE TABLE `dtb_form_sender_group` (
  `id` int(11) NOT NULL COMMENT 'id',
  `form_id` int(11) NOT NULL DEFAULT 0 COMMENT 'フォームID',
  `category_id` int(11) DEFAULT NULL COMMENT 'カテゴリID',
  `name` text NOT NULL COMMENT 'タイトル',
  `comment` text DEFAULT NULL COMMENT 'コメント',
  `mail_title` text DEFAULT NULL COMMENT 'メールタイトル',
  `mail_body` text DEFAULT NULL COMMENT 'メール本文',
  `from_name` text DEFAULT NULL COMMENT '送信者名',
  `from_email` text DEFAULT NULL COMMENT '送信者E-Mail',
  `sent_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '配信済フラグ',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '表示順',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `except_year` varchar(20) DEFAULT '',
  `except_job` varchar(255) DEFAULT NULL,
  `except_expectation` varchar(255) DEFAULT NULL,
  `except_pref` varchar(255) DEFAULT NULL,
  `del_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ 1=>削除',
  `last_update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最終更新日時',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='フォーム送信先グループ管理';

--
-- Дамп данных таблицы `dtb_form_sender_group`
--

INSERT INTO `dtb_form_sender_group` (`id`, `form_id`, `category_id`, `name`, `comment`, `mail_title`, `mail_body`, `from_name`, `from_email`, `sent_flg`, `sort`, `status`, `except_year`, `except_job`, `except_expectation`, `except_pref`, `del_flg`, `last_update_date`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 'A管理者専用', NULL, '【ライフコネクト】A管理', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'admin@supatla.com', 0, 1, 1, '', '', '', '', 0, '2024-08-21 02:43:19', '2024-08-21 15:43:19', '2017-03-16 21:21:42'),
(2, 1, 3, 'B管理者専用', NULL, '【ライフコネクト】B軍全体', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', 'ライフコネクト', 'sokuyushi@sokuyushi.net', 0, 2, 1, '', '', '', '', 0, '2024-08-19 06:48:13', '2024-08-18 21:48:13', '2017-03-17 00:04:44'),
(3, 1, 2, 'A転送先', NULL, '申し込みがありました', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'takahashitakahashi19800101@gmail.com', 0, 3, 1, '2000', '', '', '', 0, '2024-08-22 02:00:26', '2024-08-22 15:00:26', '2017-03-17 00:05:53'),
(5, 1, 4, 'B転送先', NULL, '申し込みがありました', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申し込み情報', 'sokuyushi@sokuyushi.net', 0, 5, 1, '', '', '', '', 0, '2024-08-22 01:34:20', '2024-08-22 14:34:20', '2017-03-17 00:06:26'),
(7, 1, 5, 'C管理者専用', NULL, '【即日融資の窓口】C軍全体', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 7, 1, '', '', '', '', 0, '2024-08-19 06:48:42', '2024-08-18 21:48:42', '2017-06-27 20:40:39'),
(8, 1, 6, 'C転送先', NULL, '申し込みがありました', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 8, 1, '', '', '', '', 0, '2024-08-19 06:48:51', '2024-08-18 21:48:51', '2017-06-27 20:40:39'),
(10, 1, 7, 'D管理者専用', NULL, '【即日融資の窓口】D軍全体', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 10, 0, '', '', '', '', 0, '2024-08-19 06:49:00', '2024-08-18 21:49:00', '2018-02-01 03:54:47'),
(11, 1, 8, 'D転送先', NULL, '申し込みがありました', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 11, 1, '', '', '', '', 0, '2024-08-22 01:18:32', '2024-08-22 14:18:32', '2018-02-01 03:55:52'),
(13, 1, 9, 'E管理者専用', NULL, '【即日融資の窓口】E軍全体', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 1, 13, 1, '', '', '', '', 0, '2024-08-19 06:49:27', '2024-08-18 21:49:27', '2018-02-01 03:58:01'),
(14, 1, 10, 'E転送先', NULL, '申し込みがありました', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 1, 14, 1, '', '', '', '', 0, '2024-08-19 06:49:36', '2024-08-18 21:49:36', '2018-02-01 03:58:41'),
(16, 1, 11, 'F管理者専用', NULL, '【即日融資の窓口】F軍全体', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 16, 1, '', '', '', '', 0, '2024-08-19 06:49:49', '2024-08-18 21:49:49', '2018-02-01 04:02:10'),
(17, 1, 12, 'F転送先', NULL, '申し込みがありました', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 17, 0, '', '', '', '', 0, '2024-08-19 06:49:57', '2024-08-18 21:49:57', '2018-02-01 04:02:59'),
(19, 1, 13, 'G管理者専用', NULL, '【即日融資の窓口】G軍全体', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 19, 0, '', '', '', '', 0, '2024-08-19 06:50:04', '2024-08-18 21:50:04', '2018-07-19 15:46:37'),
(20, 1, 14, 'G転送先', NULL, '申し込みがありました', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 20, 0, '', '', '', '', 0, '2024-08-19 06:50:13', '2024-08-18 21:50:13', '2018-07-19 15:47:13'),
(22, 1, 15, 'H管理者専用', NULL, '【ライフコネクト】H軍全体', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 22, 0, '', '', '', '', 0, '2024-08-19 06:50:22', '2024-08-18 21:50:22', '2018-07-19 15:46:37'),
(23, 1, 16, 'H転送先', NULL, '申し込みがありました', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 23, 0, '', '', '', '', 0, '2024-08-19 06:50:31', '2024-08-18 21:50:31', '2018-07-19 15:47:13'),
(25, 1, 17, 'I管理者専用', NULL, '【ライフコネクト】H軍全体', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 0, 1, '', '', '', '', 0, '2024-08-19 06:50:40', '2024-08-18 21:50:40', '2024-08-13 12:58:27'),
(26, 1, 18, 'I転送先', NULL, '【ライフコネクト】I軍全体', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'sokuyushi@sokuyushi.net', 0, 0, 0, '', '', '', '', 0, '2024-08-19 06:50:48', '2024-08-18 21:50:48', '2024-08-13 13:00:29'),
(27, 1, 0, '全リスト', NULL, '【ライフコネクト】', 'ライフコネクトに、申し込みがありました。\r\n\r\n受付日時：%%created_at%%\r\n\r\n------------------------------------------------------\r\n■申し込み情報\r\n------------------------------------------------------\r\nメールアドレス：%%email%%\r\nお名前：%%name%%\r\nお名前ふりがな：%%kana%%\r\nお勤め先会社名：%%company_name%%\r\n電話番号：%%tel%%\r\n生年月日：%%birthday%%\r\n都道府県：%%pref_id%%\r\n市区町村：%%addr1%%\r\n番地等：%%addr2%%\r\n建物名・部屋番号：%%addr3%%\r\n\r\n職業：%%job_type%%\r\nおよその月収：%%income%%\r\n\r\n他社借入件数：%%debt_count%%\r\n他社借入金額：%%debt_amount%%\r\n\r\n希望額：%%expectation_amount%%\r\n希望連絡時間帯：%%connect_hour_type%%\r\n\r\nその他ご要望など：\r\n%%comment%%\r\n------------------------------------------------------\r\n\r\n------------------------------------------------------\r\n■ユーザー情報\r\n------------------------------------------------------\r\nIPアドレス　　：%%user_ip%%\r\nホスト名　　　：%%user_host%%\r\nエージェント名：%%user_agent%%\r\n------------------------------------------------------', '申込み情報', 'admin@supatla.com', 0, 0, 1, '', '', '', '', 0, '2024-08-19 18:46:09', '2024-08-19 22:46:09', '2024-08-13 17:08:26');

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_history_form`
--

CREATE TABLE `dtb_history_form` (
  `id` int(11) NOT NULL COMMENT 'id',
  `form_id` int(11) NOT NULL DEFAULT 0 COMMENT 'フォームID',
  `name` text NOT NULL COMMENT '氏名',
  `kana` text DEFAULT NULL COMMENT 'フリガナ',
  `email` varchar(255) NOT NULL COMMENT 'E-Mail',
  `line_id` varchar(255) DEFAULT NULL,
  `company_name` text DEFAULT NULL COMMENT '会社名',
  `company_tel` varchar(20) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL COMMENT '性別',
  `birth_year` varchar(10) DEFAULT NULL,
  `birth_month` varchar(10) DEFAULT NULL,
  `birth_date` varchar(10) DEFAULT NULL,
  `postal_code` varchar(15) DEFAULT NULL,
  `pref_id` int(11) DEFAULT NULL COMMENT '都道府県',
  `addr1` text DEFAULT NULL COMMENT '住所1',
  `addr2` text DEFAULT NULL COMMENT '住所2',
  `addr3` text DEFAULT NULL COMMENT '住所3',
  `mobile` varchar(20) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL COMMENT 'TEL',
  `comment` text DEFAULT NULL COMMENT '本文',
  `salary_type` text DEFAULT NULL COMMENT '自由項目1',
  `industry_type` text DEFAULT NULL COMMENT '自由項目2',
  `job_type` int(5) DEFAULT NULL COMMENT '自由項目3',
  `income_type` text DEFAULT NULL COMMENT '自由項目4',
  `debt_count` text DEFAULT NULL COMMENT '自由項目5',
  `debt_amount` text DEFAULT NULL COMMENT '自由項目6',
  `expectation_amount` int(5) DEFAULT NULL COMMENT '自由項目7',
  `connect_hour_type` int(5) DEFAULT NULL COMMENT '自由項目8',
  `memo` text DEFAULT NULL COMMENT 'メモ',
  `user_ip` text DEFAULT NULL COMMENT 'IPアドレス',
  `user_host` text DEFAULT NULL COMMENT 'ホスト名',
  `user_agent` text DEFAULT NULL COMMENT 'エージェント名',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `sent_category_id` int(10) DEFAULT 0,
  `del_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ 1=>削除',
  `last_update_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '最終更新日時',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='フォーム履歴管理';

--
-- Дамп данных таблицы `dtb_history_form`
--

INSERT INTO `dtb_history_form` (`id`, `form_id`, `name`, `kana`, `email`, `line_id`, `company_name`, `company_tel`, `sex`, `birth_year`, `birth_month`, `birth_date`, `postal_code`, `pref_id`, `addr1`, `addr2`, `addr3`, `mobile`, `tel`, `comment`, `salary_type`, `industry_type`, `job_type`, `income_type`, `debt_count`, `debt_amount`, `expectation_amount`, `connect_hour_type`, `memo`, `user_ip`, `user_host`, `user_agent`, `status`, `sent_category_id`, `del_flg`, `last_update_date`, `updated_at`, `created_at`) VALUES
(15, 1, 'テストいち', 'てすといち', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1965', '7', '11', '111111', 1, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト１', '31～40万円', NULL, 1, NULL, '１', '１００', 4, 1, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/71DEA7', 0, 0, 0, '2024-08-20 10:45:22', '2024-08-20 14:50:15', '2024-08-20 14:45:22'),
(16, 1, 'テストに', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1949', '1', '1', '11111111', 14, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト２', '21～30万円', NULL, 5, NULL, '１', '１００', 4, 3, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/71DEA7', 0, 0, 0, '2024-08-20 10:47:41', '2024-08-20 14:50:24', '2024-08-20 14:47:41'),
(17, 1, 'テストさん', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1941', '1', '1', '111111', 13, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト３', '21～30万円', NULL, 9, NULL, '１', '１００', 2, 4, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/71DEA7', 0, 1, 0, '2024-08-20 10:49:01', '2024-08-20 17:04:39', '2024-08-20 14:49:01'),
(18, 1, 'テスト大樹', 'てすとたろう', 'ayogo1234@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1952', '9', '15', '11111111', 9, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト４', '41万円以上', NULL, 2, NULL, '１', '１００', 4, 3, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/71DEA7', 0, 1, 0, '2024-08-20 10:50:02', '2024-08-20 17:04:33', '2024-08-20 14:50:02'),
(19, 1, 'テストテスト', 'きたむら　だいき', 'ayogo1234@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1947', '5', '14', '11111111', 11, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '10万円以下', NULL, 8, NULL, '１', '１００', 1, 3, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/71DEA7', 0, 1, 0, '2024-08-20 10:57:05', '2024-08-20 17:04:22', '2024-08-20 14:57:05'),
(20, 1, 'テストテスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1942', '2', '1', '11111111', 9, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト１', '21～30万円', NULL, 8, NULL, '１', '１００', 2, 2, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/0AB3B7', 0, 4, 0, '2024-08-21 00:28:41', '2024-08-21 13:30:07', '2024-08-21 13:28:41'),
(21, 1, 'テスト大樹', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1953', '10', '5', '11111111', 4, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト２', '21～30万円', NULL, 8, NULL, '１', '１００', 4, 4, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/0AB3B7', 0, 6, 0, '2024-08-21 00:30:05', '2024-08-21 13:35:06', '2024-08-21 13:30:05'),
(22, 1, '鈴木いち', 'きたむら　だいき', 'test@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1952', '9', '13', '111111', 10, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト３', '11～20万円', NULL, 2, NULL, '１', '１００', 3, 4, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/0AB3B7', 0, 0, 0, '2024-08-21 00:31:12', '2024-08-21 13:35:09', '2024-08-21 13:31:12'),
(23, 1, '北村テスト', 'てすといち', 'ayogo1234@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1950', '4', '15', '111111', 13, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト４', '31～40万円', NULL, 1, NULL, '１', '１００', 4, 5, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/0AB3B7', 0, 2, 0, '2024-08-21 00:32:22', '2024-08-21 13:35:15', '2024-08-21 13:32:22'),
(24, 1, 'テスト５テスト', 'きたむら　だいき', 'ayogo1234@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1947', '10', '11', '11111111', 13, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト５', '31～40万円', NULL, 4, NULL, '１', '１００', 4, 3, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/0AB3B7', 0, 4, 0, '2024-08-21 00:33:26', '2024-08-21 13:35:18', '2024-08-21 13:33:26'),
(25, 1, 'テスト６テスト', 'きたむら　だいき', 'ayogo1234@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1953', '7', '8', '11111111', 5, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト６', '41万円以上', NULL, 4, NULL, '１', '１００', 3, 2, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/0AB3B7', 0, 6, 0, '2024-08-21 00:34:37', '2024-08-21 13:35:22', '2024-08-21 13:34:37'),
(26, 1, 'テスト７テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1942', '7', '2', '11111111', 10, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト７', '21～30万円', NULL, 9, NULL, '１', '１００', 3, 1, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 8, 0, '2024-08-21 01:23:52', '2024-08-21 14:25:06', '2024-08-21 14:23:52'),
(27, 1, 'テストAテスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1947', '9', '7', '11111111', 14, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト１', '31～40万円', NULL, 8, NULL, '１', '１００', 2, 5, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 0, 0, '2024-08-21 01:46:58', '2024-08-21 14:50:04', '2024-08-21 14:46:58'),
(28, 1, 'テストBテスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1950', '9', '11', '111111', 4, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト２', '31～40万円', NULL, 2, NULL, '１', '１００', 3, 2, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 2, 0, '2024-08-21 01:47:52', '2024-08-21 14:50:10', '2024-08-21 14:47:52'),
(29, 1, 'テストCテスト', 'てすとたろう', 'ayogo1234@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1952', '8', '14', '111111', 10, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト３', '41万円以上', NULL, 2, NULL, '１', '１００', 3, 3, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 4, 0, '2024-08-21 01:48:52', '2024-08-21 14:50:14', '2024-08-21 14:48:52'),
(30, 1, 'テスト４大樹', 'てすといち', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1949', '11', '16', '11111111', 2, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, 'テスト４', '21～30万円', NULL, 7, NULL, '１', '１００', 5, 1, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 6, 0, '2024-08-21 01:49:58', '2024-08-21 14:50:18', '2024-08-21 14:49:58'),
(31, 1, 'テスト１テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1949', '10', '14', '11111111', 1, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 7, NULL, '１', '１００', 4, 3, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 8, 0, '2024-08-21 02:37:31', '2024-08-21 15:40:07', '2024-08-21 15:37:31'),
(32, 1, 'テスト2テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1955', '11', '16', '111111', 1, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '31～40万円', NULL, 3, NULL, '１', '１００', 2, 2, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 0, 0, '2024-08-21 02:38:27', '2024-08-21 15:40:09', '2024-08-21 15:38:27'),
(33, 1, 'テスト3テスト', 'てすといち', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1950', '7', '9', '111111', 8, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '21～30万円', NULL, 8, NULL, '１', '１００', 4, 2, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 2, 0, '2024-08-21 02:39:21', '2024-08-21 15:40:14', '2024-08-21 15:39:21'),
(34, 1, 'テスト4テスト', 'きたむら　だいき', 'ayogo1234@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1949', '8', '2', '11111111', 8, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '21～30万円', NULL, 5, NULL, '１', '１００', 3, 2, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 4, 0, '2024-08-21 02:40:19', '2024-08-21 15:45:08', '2024-08-21 15:40:19'),
(35, 1, 'テスト5テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1953', '9', '15', '11111111', 6, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '31～40万円', NULL, 7, NULL, '１', '１００', 5, 3, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 6, 0, '2024-08-21 02:41:18', '2024-08-21 15:45:11', '2024-08-21 15:41:18'),
(36, 1, 'テスト6テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1942', '5', '5', '111111', 12, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '10万円以下', NULL, 8, NULL, '１', '１００', 4, 2, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 8, 0, '2024-08-21 02:42:12', '2024-08-21 15:45:15', '2024-08-21 15:42:12'),
(37, 1, 'テスト１テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1948', '7', '14', '11111111', 9, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 6, NULL, '１', '１００', 2, 1, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 0, 0, '2024-08-21 02:55:17', '2024-08-21 16:00:07', '2024-08-21 15:55:17'),
(38, 1, 'テスト2テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1949', '7', '16', '11111111', 2, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 5, NULL, '１', '１００', 5, 4, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 2, 0, '2024-08-21 02:56:09', '2024-08-21 16:00:13', '2024-08-21 15:56:09'),
(39, 1, 'テスト3いち', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1950', '5', '9', '11111111', 16, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '41万円以上', NULL, 8, NULL, '１', '１００', 5, 3, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 4, 0, '2024-08-21 02:57:05', '2024-08-21 16:00:17', '2024-08-21 15:57:05'),
(40, 1, 'テスト4大樹', 'てすとたろう', 'ayogo1234@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1941', '4', '6', '11111111', 14, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '21～30万円', NULL, 4, NULL, '１', '１００', 3, 3, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 6, 0, '2024-08-21 02:58:02', '2024-08-21 16:00:20', '2024-08-21 15:58:02'),
(41, 1, 'テスト5テスト', 'てすとたろう', 'ayogo1234@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1954', '10', '17', '11111111', 12, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '41万円以上', NULL, 9, NULL, '１', '１００', 4, 1, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 8, 0, '2024-08-21 02:58:55', '2024-08-21 16:00:24', '2024-08-21 15:58:55'),
(42, 1, 'テスト6テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1949', '7', '13', '11111111', 10, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 7, NULL, '１', '１００', 2, 3, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 0, 0, '2024-08-21 02:59:46', '2024-08-21 16:00:26', '2024-08-21 15:59:46'),
(43, 1, 'テスト7テスト', 'きたむら　だいき', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1952', '7', '13', '11111111', 11, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '21～30万円', NULL, 3, NULL, '１', '１００', 4, 4, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 2, 0, '2024-08-21 03:00:47', '2024-08-21 16:05:11', '2024-08-21 16:00:47'),
(44, 1, 'テスト8テスト', 'きたむら　だいき', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1953', '4', '11', '11111111', 3, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '21～30万円', NULL, 7, NULL, '１', '１００', 6, 4, NULL, '219.100.37.233', 'public-nat-01.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/C32F6C', 0, 4, 0, '2024-08-21 03:01:44', '2024-08-21 16:05:14', '2024-08-21 16:01:44'),
(45, 1, 'テスト１テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1951', '8', '12', '11111111', 13, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 5, NULL, '１', '１００', 4, 4, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/7C18D7', 0, 5, 0, '2024-08-21 08:51:45', '2024-08-21 21:55:04', '2024-08-21 21:51:45'),
(46, 1, 'テスト2テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1955', '7', '9', '11111111', 14, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 4, NULL, '１', '１００', 3, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/7C18D7', 0, 7, 0, '2024-08-21 08:52:44', '2024-08-21 21:55:08', '2024-08-21 21:52:44'),
(47, 1, 'テスト3テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1952', '9', '16', '111111', 12, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '31～40万円', NULL, 2, NULL, '１', '１００', 3, 2, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/7C18D7', 0, -1, 0, '2024-08-21 08:53:38', '2024-08-21 21:55:12', '2024-08-21 21:53:38'),
(48, 1, 'テスト4テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1953', '6', '11', '11111111', 5, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '10万円以下', NULL, 3, NULL, '１', '１００', 4, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/7C18D7', 0, 1, 0, '2024-08-21 08:54:38', '2024-08-21 21:55:14', '2024-08-21 21:54:38'),
(49, 1, '55', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1941', '3', '4', '11111111', 10, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 2, NULL, '１', '１００', 3, 1, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/7C18D7', 0, 3, 0, '2024-08-21 08:55:45', '2024-08-21 22:00:05', '2024-08-21 21:55:45'),
(50, 1, '66', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1951', '7', '12', '11111111', 6, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '21～30万円', NULL, 6, NULL, '１', '１００', 4, 2, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/7C18D7', 0, 5, 0, '2024-08-21 08:56:40', '2024-08-21 22:00:09', '2024-08-21 21:56:40'),
(51, 1, '77', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1947', '11', '13', '11111111', 13, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '31～40万円', NULL, 7, NULL, '34', '１００', 3, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/7C18D7', 0, 7, 0, '2024-08-21 08:57:38', '2024-08-21 22:00:13', '2024-08-21 21:57:38'),
(53, 1, 'テスト１テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1952', '2', '5', '111111', 13, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '31～40万円', NULL, 5, NULL, '34', '１００', 3, 2, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/BE3EFE', 0, 1, 0, '2024-08-21 22:50:43', '2024-08-22 11:55:04', '2024-08-22 11:50:43'),
(54, 1, 'テスト2テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1949', '6', '8', '111111', 8, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '31～40万円', NULL, 4, NULL, '34', '１００', 3, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/BE3EFE', 0, 3, 0, '2024-08-21 22:52:48', '2024-08-22 11:55:09', '2024-08-22 11:52:48'),
(55, 1, '3テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1953', '10', '15', '111111', 10, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 5, NULL, '１', '１００', 2, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/BE3EFE', 0, 5, 0, '2024-08-21 22:54:00', '2024-08-22 11:55:13', '2024-08-22 11:54:00'),
(56, 1, '4テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1951', '9', '15', '111111', 10, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 6, NULL, '34', '１００', 3, 2, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/BE3EFE', 0, 7, 0, '2024-08-21 22:55:05', '2024-08-22 12:00:05', '2024-08-22 11:55:05'),
(57, 1, '5テスト', 'てすとたろう', 'ayogo1234@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1941', '2', '6', '111111', 12, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 4, NULL, '34', '１００', 5, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/BE3EFE', 0, 1, 0, '2024-08-21 22:56:06', '2024-08-22 12:00:09', '2024-08-22 11:56:06'),
(58, 1, '６テスト', 'きたむら　だいき', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1954', '3', '9', '111111', 4, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 3, NULL, '34', '１００', 4, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/BE3EFE', 0, 3, 0, '2024-08-21 22:57:04', '2024-08-22 12:00:15', '2024-08-22 11:57:04'),
(59, 1, '７テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1947', '6', '10', '111111', 7, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '31～40万円', NULL, 5, NULL, '34', '１００', 5, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/BE3EFE', 0, 5, 0, '2024-08-21 22:57:59', '2024-08-22 12:00:19', '2024-08-22 11:57:59'),
(60, 1, '８テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1952', '4', '10', '111111', 8, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '21～30万円', NULL, 1, NULL, '34', '１００', 6, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/BE3EFE', 0, 7, 0, '2024-08-21 22:58:54', '2024-08-22 12:00:22', '2024-08-22 11:58:54'),
(61, 1, '除外テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '2001', '1', '1', '11111111', 13, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 1, NULL, '34', '１００', 4, 1, NULL, '219.100.37.239', 'public-nat-07.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/371B17', 0, 1, 0, '2024-08-22 00:14:08', '2024-08-22 13:15:06', '2024-08-22 13:14:08'),
(62, 1, '除外金額', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1949', '5', '14', '111111', 7, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 3, NULL, '１', '１００', 1, 2, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/59712A', 0, 5, 0, '2024-08-22 00:50:08', '2024-08-22 13:55:04', '2024-08-22 13:50:08'),
(63, 1, '除外職業', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1948', '9', '12', '111111', 6, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '10万円以下', NULL, 5, NULL, '34', '１００', 5, 2, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/59712A', 0, 1, 0, '2024-08-22 01:01:56', '2024-08-22 14:05:05', '2024-08-22 14:01:56'),
(64, 1, '除外都道府県', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1949', '10', '15', '11111111', 4, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '21～30万円', NULL, 6, NULL, '34', '１００', 4, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/59712A', 0, 5, 0, '2024-08-22 01:20:49', '2024-08-22 14:25:05', '2024-08-22 14:20:49'),
(65, 1, '除外テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1948', '5', '16', '11111111', 13, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 7, NULL, '34', '１００', 4, 4, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/59712A', 0, 6, 0, '2024-08-22 02:01:20', '2024-08-22 15:05:05', '2024-08-22 15:01:20'),
(66, 1, '除外テスト', 'きたむら　だいき', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '2001', '1', '1', '11111111', 11, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 6, NULL, '34', '１００', 4, 3, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/59712A', 0, 8, 0, '2024-08-22 02:02:22', '2024-08-22 15:05:09', '2024-08-22 15:02:22'),
(67, 1, '除外テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '2001', '1', '1', '11111111', 14, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '21～30万円', NULL, 8, NULL, '34', '１００', 3, 2, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/59712A', 0, 1, 0, '2024-08-22 02:26:00', '2024-08-22 15:30:09', '2024-08-22 15:26:00'),
(68, 1, '除外テスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '2001', '10', '17', '111111', 8, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '41万円以上', NULL, 9, NULL, '34', '１００', 5, 1, NULL, '219.100.37.238', 'public-nat-06.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/59712A', 0, 4, 0, '2024-08-22 03:15:15', '2024-08-22 16:20:06', '2024-08-22 16:15:15'),
(69, 1, 'テストテスト', 'テスト', 'gatm\'pjawTjod@gmail.com', NULL, 'テスト', '123', NULL, '1944', '6', '7', 'テスト', 4, 'テスト', 'テスト', NULL, '123', NULL, NULL, '11～20万円', NULL, 3, NULL, '123', '123', 3, 2, NULL, '126.158.226.19', 'om126158226019.30.openmobile.ne.jp', 'Mozilla/5.0 (Linux; Android 12; A202ZT) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Mobile Safari/537.36', 0, 6, 0, '2024-08-25 21:38:53', '2024-08-26 17:15:17', '2024-08-26 13:38:53'),
(70, 1, '近藤高朗', 'こんどうたかあき', 'taka-akira1977111@au.com', NULL, '近物レックス大阪営業所', '0666815585', NULL, '1977', '11', '10', '5570004', 27, '大阪市西成区玉出中', '１-15-5', 'グランシャルム302', '08088425490', NULL, '直ぐに貸して欲しい。\r\n文章を読むのは大変なので、返済方法等、電話で説明してもらえると良い。', '21～30万円', NULL, 1, NULL, '0', '0', 2, 1, NULL, '162.247.74.204', 'billsf.tor-exit.calyxinstitute.org', 'Mozilla/5.0 (Windows NT 10.0; rv:109.0) Gecko/20100101 Firefox/115.0', 0, 8, 0, '2024-08-26 00:47:31', '2024-08-26 17:15:31', '2024-08-26 16:47:31'),
(71, 1, 'テストテスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1952', '9', '15', '11111111', 14, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '41万円以上', NULL, 8, NULL, '34', '１００', 2, 5, NULL, '219.100.37.234', 'public-nat-02.vpngate.v4.open.ad.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 0, 2, 0, '2024-08-26 00:48:58', '2024-08-26 17:15:45', '2024-08-26 16:48:58'),
(72, 1, 'testtest', 'test', 'misnoyh511@gmail.com', '1234', 'test', '0801234567', NULL, '1954', '11', '17', '5230023', 11, 'test', 'test', '000', '0801234567', '0801234567', NULL, '11～20万円', NULL, 4, NULL, '2', '100', 3, 3, NULL, '37.120.210.2', '37.120.210.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 0, 4, 0, '2024-08-26 00:49:24', '2024-08-26 17:15:59', '2024-08-26 16:49:24'),
(73, 1, 'testtest', 'test', 'misnoyh511@gmail.com', '1234', 'test', '0801234567', NULL, '1954', '11', '17', '5230023', 11, 'test', 'test', '000', '0801234567', '0801234567', NULL, '11～20万円', NULL, 4, NULL, '2', '100', 3, 3, NULL, '37.120.210.2', '37.120.210.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 0, 6, 0, '2024-08-26 00:57:44', '2024-08-26 17:16:13', '2024-08-26 16:57:44'),
(74, 1, 'testtest', 'test', 'misnoyh511@gmail.com', '1234', '0801234567', '0801234567', NULL, '1954', '11', '17', '5230023', 13, 'test', 'test', '000', '0801234567', '0801234567', NULL, '11～20万円', NULL, 9, NULL, '2', '100', 3, 2, NULL, '37.120.210.2', '37.120.210.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 0, 8, 0, '2024-08-26 00:59:26', '2024-08-26 17:16:27', '2024-08-26 16:59:26'),
(75, 1, 'testtest', 'test', 'misnoyh511@gmail.com', '1234', 'test', '0801234567', NULL, '1951', '4', '13', '5230023', 7, 'test', 'test', '000', '0801234567', '0801234567', NULL, '21～30万円', NULL, 8, NULL, '2', '100', 4, 4, NULL, '37.120.210.2', '37.120.210.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 0, 2, 0, '2024-08-26 01:03:39', '2024-08-26 17:16:41', '2024-08-26 17:03:39'),
(76, 1, 'testtest', 'test', 'misnoyh511@gmail.com', '1234', 'test', '0801234567', NULL, '1954', '11', '16', '5230023', 13, 'test', 'test', '000', '0801234567', '0801234567', NULL, '21～30万円', NULL, 9, NULL, '2', '100', 3, 4, NULL, '37.120.210.2', '37.120.210.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 0, 4, 0, '2024-08-26 01:06:41', '2024-08-26 17:16:55', '2024-08-26 17:06:41'),
(77, 1, 'testtest', 'test', 'misnoyh511@gmail.com', '1234', 'test', '0801234567', NULL, '1954', '11', '16', '5230023', 13, 'test', 'test', '000', '0801234567', '0801234567', NULL, '21～30万円', NULL, 9, NULL, '2', '100', 3, 4, NULL, '37.120.210.2', '37.120.210.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 0, 6, 0, '2024-08-26 01:08:08', '2024-08-26 17:17:09', '2024-08-26 17:08:08'),
(78, 1, 'testtest', 'test', 'misnoyh511@gmail.com', '1234', 'test', '0801234567', NULL, '1954', '11', '16', '5230023', 13, 'test', 'test', '000', '0801234567', '0801234567', NULL, '21～30万円', NULL, 9, NULL, '2', '100', 3, 4, NULL, '37.120.210.2', '37.120.210.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 0, 8, 0, '2024-08-26 01:09:01', '2024-08-26 17:17:23', '2024-08-26 17:09:01'),
(79, 1, 'testtest', 'test', 'misnoyh511@gmail.com', '1234', '0801234567', '0801234567', NULL, '1951', '4', '13', '5230023', 12, 'test', 'test', '000', '0801234567', '0801234567', NULL, '11～20万円', NULL, 8, NULL, '2', '100', 4, 4, NULL, '37.120.210.2', '37.120.210.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 0, 2, 0, '2024-08-26 01:12:48', '2024-08-26 17:17:37', '2024-08-26 17:12:48'),
(80, 1, 'テストテスト', 'テスト', 'gatm\'pjawTjod@gmail.com', NULL, 'テスト', '123', NULL, '1945', '8', '8', '123', 6, '123', '123', NULL, '123', NULL, NULL, '10万円以下', NULL, 5, NULL, '123', '123', 2, 2, NULL, '126.158.226.19', 'om126158226019.30.openmobile.ne.jp', 'Mozilla/5.0 (Linux; Android 12; A202ZT) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Mobile Safari/537.36', 0, 0, 0, '2024-08-26 01:52:29', '2024-08-26 17:55:09', '2024-08-26 17:52:29'),
(81, 1, 'テストテスト', 'テスト', 'gatm\'pjawTjod@gmail.com', NULL, 'テスト', '123', NULL, '1944', '6', '7', '123', 5, 'テスト', '123', NULL, '123', NULL, NULL, '10万円以下', NULL, 4, NULL, '123', '123', 1, 2, NULL, '126.158.226.19', 'om126158226019.30.openmobile.ne.jp', 'Mozilla/5.0 (Linux; Android 12; A202ZT) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Mobile Safari/537.36', 0, 0, 0, '2024-08-26 05:19:18', '2024-08-26 21:20:16', '2024-08-26 21:19:18'),
(82, 1, '田中暁貴', 'たなか　としき', 'onepiece-c-1103@i.softbank.jp', NULL, '株式会社フォーラムエンジニア', '0524144050', NULL, '1991', '11', '3', '4840066', 23, '犬山市五郎丸', '前畑10-2', 'リヴェール106', '08051364704', NULL, '70万借りたいです。', '21～30万円', NULL, 1, NULL, '3件', '120万', 6, 4, NULL, '126.182.137.52', 'pw126182137052.27.panda-world.ne.jp', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5 Mobile/15E148 Safari/604.1', 0, 0, 0, '2024-08-26 05:38:31', '2024-08-26 21:40:10', '2024-08-26 21:38:31'),
(83, 1, '中井大也', 'なかいだいや', 'd.1216s.0630@gmail.com', NULL, '居酒屋 鶴喜屋', '08064543893', NULL, '1988', '12', '16', '5700015', 27, '守口市梶町', '二丁目16-15', 'なし', '08064543893', NULL, 'よろしくお願い致します。', '41万円以上', NULL, 3, NULL, '2件', '100万円', 6, 2, NULL, '103.5.140.156', '156.140.5.103.wi-fi.wi2.ne.jp', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5 Mobile/15E148 Safari/604.1', 0, 0, 0, '2024-08-26 07:22:32', '2024-08-26 23:25:10', '2024-08-26 23:22:32'),
(84, 1, 'テストテスト', 'てすとたろう', 'aaaaaa@gmail.com', NULL, '株式会社テスト', '１１１１１１１１１', NULL, '1949', '8', '14', '11111111', 8, '札幌市１１１１１１１', '１１１１１１１', NULL, '０９０１１１１１１１１', NULL, NULL, '11～20万円', NULL, 9, NULL, '34', '１００', 3, 1, NULL, '210.146.136.101', '210-146-136-101.east.fdn.vectant.ne.jp', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 0, 0, 0, '2024-08-26 22:02:03', '2024-08-27 14:05:09', '2024-08-27 14:02:03');

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_history_login`
--

CREATE TABLE `dtb_history_login` (
  `id` bigint(20) NOT NULL COMMENT 'id',
  `user_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ユーザータイプ 0=>不明　1=>管理者 3=>メンバー',
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT 'ユーザーID',
  `user_ip` text DEFAULT NULL COMMENT 'IPアドレス',
  `user_host` text DEFAULT NULL COMMENT 'ホスト名',
  `user_agent` text DEFAULT NULL COMMENT 'エージェント名',
  `result_flg` tinyint(1) NOT NULL COMMENT '結果 0=>失敗 1=>成功',
  `log` text DEFAULT NULL COMMENT 'ログ',
  `login_date` datetime DEFAULT NULL COMMENT 'ログイン日時',
  `logout_date` datetime DEFAULT NULL COMMENT 'ログアウト日時',
  `status` tinyint(1) NOT NULL COMMENT 'ステータス 0=>無効 1=>有効',
  `del_flg` tinyint(1) NOT NULL COMMENT '削除フラグ 1=>削除',
  `last_update_date` datetime NOT NULL COMMENT '最終更新日時',
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='ログイン履歴管理';

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_history_sender`
--

CREATE TABLE `dtb_history_sender` (
  `id` int(11) NOT NULL COMMENT 'id',
  `form_id` int(11) NOT NULL DEFAULT 0 COMMENT 'フォームID',
  `group_id` int(11) NOT NULL DEFAULT 0 COMMENT 'グループID',
  `sender_id` int(11) NOT NULL DEFAULT 0 COMMENT '送信先ID',
  `email` varchar(255) NOT NULL COMMENT 'E-Mail',
  `result_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '送信結果',
  `log` text DEFAULT NULL COMMENT 'ログ',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `del_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ 1=>削除',
  `last_update_date` datetime NOT NULL COMMENT '最終更新日時',
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='フォーム通知履歴';

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_history_stand`
--

CREATE TABLE `dtb_history_stand` (
  `id` int(11) NOT NULL COMMENT 'id',
  `form_id` int(11) NOT NULL COMMENT 'フォームID',
  `register_id` int(11) NOT NULL COMMENT '登録ID',
  `stand_type` tinyint(1) DEFAULT 0 COMMENT 'スタンドタイプ 1=>エキスパ',
  `stand_url` varchar(255) DEFAULT NULL COMMENT 'スタンド登録URL',
  `result_code` tinyint(1) DEFAULT 0 COMMENT '結果 0=>失敗 1=>成功',
  `status_code` int(11) DEFAULT NULL COMMENT 'レスポンスコード',
  `param` text DEFAULT NULL COMMENT 'パラメーター',
  `memo` text DEFAULT NULL COMMENT 'ログメッセージ',
  `status` tinyint(1) DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `del_flg` tinyint(1) DEFAULT 0 COMMENT '削除フラグ 1=>削除',
  `last_update_date` datetime DEFAULT NULL COMMENT '最終更新日時',
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='メールスタンド連携履歴管理';

-- --------------------------------------------------------

--
-- Структура таблицы `dtb_site`
--

CREATE TABLE `dtb_site` (
  `id` bigint(20) NOT NULL COMMENT 'id',
  `site_name` text DEFAULT NULL COMMENT 'サイト名',
  `company_name` text DEFAULT NULL COMMENT '会社名',
  `zip` varchar(45) DEFAULT NULL COMMENT '郵便番号',
  `pref_id` int(11) DEFAULT NULL COMMENT '都道府県ID',
  `addr1` text DEFAULT NULL COMMENT '住所1',
  `tel` varchar(45) DEFAULT NULL COMMENT 'TEL',
  `email` varchar(255) DEFAULT NULL COMMENT 'E-Mail',
  `from_email` varchar(255) DEFAULT NULL COMMENT '送信元E-Mail',
  `from_name` text DEFAULT NULL COMMENT '送信者名',
  `memo` text DEFAULT NULL COMMENT '備考欄',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `del_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ 1=>削除',
  `last_update_date` datetime NOT NULL COMMENT '最終更新日時',
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '作成日時',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='サイト管理';

--
-- Дамп данных таблицы `dtb_site`
--

INSERT INTO `dtb_site` (`id`, `site_name`, `company_name`, `zip`, `pref_id`, `addr1`, `tel`, `email`, `from_email`, `from_name`, `memo`, `status`, `del_flg`, `last_update_date`, `update_date`, `create_date`) VALUES
(1, '即日融資の窓口【全国対応】', 'サンプル会社', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2017-03-15 13:45:22', '2017-03-15 17:45:22', '2017-03-15 17:45:22');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_09_172746_create_configs_table', 1),
(4, '2018_04_28_115529_create_roles_table', 1),
(5, '2018_04_28_115600_create_permissions_table', 1),
(6, '2023_10_04_141357_add_default_role_id_to_configs_table', 1),
(7, '2023_10_04_171516_add_register_to_configs_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `mtb_mail_template`
--

CREATE TABLE `mtb_mail_template` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` text DEFAULT NULL COMMENT 'テンプレート名',
  `title` text DEFAULT NULL COMMENT 'タイトル',
  `comment` text DEFAULT NULL COMMENT '本文',
  `param` text DEFAULT NULL COMMENT '利用可能変数',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '表示順',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ステータス 0=>無効 1=>有効',
  `del_flg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ 1=>削除',
  `last_update_date` datetime NOT NULL COMMENT '最終更新日時',
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新日時',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='メールテンプレートマスター管理';

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_group_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `label` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `permission_group_id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 1, 'root-dev', 'Developer Permission', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(2, 2, 'edit-config', 'Edit System Settings', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(3, 3, 'show-user', 'View User', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(4, 3, 'create-user', 'Add User', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(5, 3, 'edit-user', 'Edit User', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(6, 3, 'destroy-user', 'Delete User', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(7, 4, 'show-role', 'View Permission', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(8, 4, 'create-role', 'Add Permission', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(9, 4, 'edit-role', 'Edit Permission', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(10, 4, 'destroy-role', 'Delete Permission', '2024-08-05 21:44:27', '2024-08-05 21:44:27');

-- --------------------------------------------------------

--
-- Структура таблицы `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Developer Settings', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(2, 'System Settings', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(3, 'Users', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(4, 'Permissions', '2024-08-05 21:44:27', '2024-08-05 21:44:27');

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 2, 2),
(12, 3, 2),
(13, 4, 2),
(14, 5, 2),
(15, 6, 2),
(16, 7, 2),
(17, 8, 2),
(18, 9, 2),
(19, 10, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `label` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 'System Developer', '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(2, 'Administrators', 'System Administrators', '2024-08-05 21:44:27', '2024-08-05 21:44:27');

-- --------------------------------------------------------

--
-- Структура таблицы `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `avatar` varchar(191) NOT NULL DEFAULT 'img/config/nopic.png',
  `active` tinyint(1) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 'dev@dev.com', NULL, '$2y$10$.0KpWaodW62i2o2fuyHul.rOHBKjJMewYaQIrLOpgLv9H5y.bv.qC', 'img/config/nopic.png', 1, NULL, '2024-08-05 21:44:27', '2024-08-05 21:44:27'),
(2, 'Administrator', 'admin@admin.com', NULL, '$2y$10$h3oWYWF9jVqMpuPuG9IH8uKh76oTXGfyIweyWxOMFVbqxiTqmZWeS', 'img/config/nopic.png', 1, NULL, '2024-08-05 21:44:27', '2024-08-05 21:44:27');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dtb_admin`
--
ALTER TABLE `dtb_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `division_id` (`division_id`),
  ADD KEY `status` (`status`),
  ADD KEY `del_flg` (`del_flg`);

--
-- Индексы таблицы `dtb_config`
--
ALTER TABLE `dtb_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `config_id` (`config_id`),
  ADD KEY `status` (`status`),
  ADD KEY `del_flg` (`del_flg`);

--
-- Индексы таблицы `dtb_file`
--
ALTER TABLE `dtb_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_type` (`resource_type`),
  ADD KEY `resource_id` (`resource_id`),
  ADD KEY `user_type` (`user_type`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `save_flg` (`save_flg`),
  ADD KEY `status` (`status`),
  ADD KEY `del_flg` (`del_flg`);

--
-- Индексы таблицы `dtb_form`
--
ALTER TABLE `dtb_form`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dtb_form_sender`
--
ALTER TABLE `dtb_form_sender`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dtb_form_sender_group`
--
ALTER TABLE `dtb_form_sender_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dtb_history_form`
--
ALTER TABLE `dtb_history_form`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dtb_history_login`
--
ALTER TABLE `dtb_history_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type` (`user_type`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `result_flg` (`result_flg`),
  ADD KEY `status` (`status`),
  ADD KEY `del_flg` (`del_flg`);

--
-- Индексы таблицы `dtb_history_sender`
--
ALTER TABLE `dtb_history_sender`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Индексы таблицы `dtb_history_stand`
--
ALTER TABLE `dtb_history_stand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `dtb_site`
--
ALTER TABLE `dtb_site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `del_flg` (`del_flg`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mtb_mail_template`
--
ALTER TABLE `mtb_mail_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `del_flg` (`del_flg`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_permission_group_id_foreign` (`permission_group_id`);

--
-- Индексы таблицы `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dtb_admin`
--
ALTER TABLE `dtb_admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `dtb_config`
--
ALTER TABLE `dtb_config`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT для таблицы `dtb_file`
--
ALTER TABLE `dtb_file`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT для таблицы `dtb_form`
--
ALTER TABLE `dtb_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dtb_form_sender`
--
ALTER TABLE `dtb_form_sender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `dtb_form_sender_group`
--
ALTER TABLE `dtb_form_sender_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `dtb_history_form`
--
ALTER TABLE `dtb_history_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT для таблицы `dtb_history_login`
--
ALTER TABLE `dtb_history_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT для таблицы `dtb_history_sender`
--
ALTER TABLE `dtb_history_sender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT для таблицы `dtb_history_stand`
--
ALTER TABLE `dtb_history_stand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT для таблицы `dtb_site`
--
ALTER TABLE `dtb_site`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `mtb_mail_template`
--
ALTER TABLE `mtb_mail_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `dtb_history_sender`
--
ALTER TABLE `dtb_history_sender`
  ADD CONSTRAINT `group_id` FOREIGN KEY (`group_id`) REFERENCES `dtb_form_sender_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_permission_group_id_foreign` FOREIGN KEY (`permission_group_id`) REFERENCES `permission_groups` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
