<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
	<!-- DOMjudge version <?php echo DOMJUDGE_VERSION ?> -->
	<meta charset="<?php echo DJ_CHARACTER_SET ?>"/>
	<title><?= $title ?></title>
	<style>

		/*!
		 * Styling based on:
		 * Bootstrap v4.0.0 (https://getbootstrap.com)
		 * Copyright 2011-2018 The Bootstrap Authors
		 * Copyright 2011-2018 Twitter, Inc.
		 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
		 */
		html {
			font-family: sans-serif;
			line-height: 1.15;
			-webkit-text-size-adjust: 100%;
			-ms-text-size-adjust: 100%;
			-ms-overflow-style: scrollbar;
			-webkit-tap-highlight-color: transparent;
		}

		body {
			margin: 0;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #212529;
			text-align: left;
			background-color: #fff;
		}

		table {
			border-collapse: collapse;
		}

		.table {
			width: 100%;
			max-width: 100%;
			margin-bottom: 1rem;
			background-color: transparent;
		}

		.table th,
		.table td {
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #dee2e6;
		}

		.table thead th {
			vertical-align: bottom;
			border-bottom: 2px solid #dee2e6;
		}

		.table tbody + tbody {
			border-top: 2px solid #dee2e6;
		}

		.table .table {
			background-color: #fff;
		}

		main {
			padding: 1rem 3rem;
		}

		h1, h2 {
			text-align: center;
		}

		h1 {
			font-size: 2em;
			padding-top: 3rem;
		}

		h2 {
			font-size: 1.5em;
			padding-top: 2rem;
		}
	</style>
</head>
<body>
<main role="main" class="">
	<h1><?= $title ?></h1>