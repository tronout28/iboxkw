<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="" rel="stylesheet">

    <title>Catalog</title>
</head>
<body>
    @include('home.header')
    @include('see all.watchiphone')
    <div style="border-top: 2px solid #e5e7eb; width: 100%;"></div>
    <h1 style="padding: 20px 0 20px 80px; font-size: 34px;">iPhone 15 Pro</h1>
    <div style="border-top: 2px solid #e5e7eb; width: 100%;"></div>
    @include('catalog.container')
    <div style="border-top: 2px solid #e5e7eb; width: 100%;"></div>
    @include('catalog.container')
    <div style="border-top: 2px solid #e5e7eb; width: 100%;"></div>
</body>