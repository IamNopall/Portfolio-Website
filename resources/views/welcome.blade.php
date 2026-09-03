<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="High-end personal portfolio built with Laravel and Vue.">

        <title>{{ config('app.name', 'Portfolio') }}</title>

        <!-- Dynamic Favicon Icons -->
        <link rel="icon" type="image/png" href="/images/whitelogo.png" media="(prefers-color-scheme: dark)" />
        <link rel="icon" type="image/png" href="/images/blacklogo.png" media="(prefers-color-scheme: light)" />
        <link rel="icon" type="image/png" href="/images/whitelogo.png" />

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800,900&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=manrope:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <!--
        THESIS: Replaces the hollow cutout standee slot with an architectural monograph dossier—pairing real mountain summit portraiture with technical telemetry, live availability signals, and kinetic parallax hierarchy, refusing generic cookie-cutter portfolio cards.
        OWN-WORLD: Obsidian backdrop (#09090b), zinc-800 architectural hairlines, pure white display typography, cobalt focal accents (#2563eb), and tactile glass telemetry cards with subtle border glow.
        STORY: Visitors immediately grasp Naufal's persona as an engineering craftsman: viewing real summit photography framed by geographic coordinates, technical discipline badges, and living availability status before reading the core mission statement.
        FIRST VIEWPORT: Left: Monumental display statement ('ARCHITECTING SYSTEMS INTO REALITIES') with live coordinate badge; Center/Right: Architectural vertical dossier frame housing guwe.jpeg with parallax depth scrub and floating telemetry tags; Right/Bottom: Concise engineering manifesto and direct project index anchors.
        FORM: Editorial Architectural Monograph Dossier with kinetic scrub, seed 0904e589.
        FINISH: unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance.
        -->
        <div id="app"></div>
    </body>
</html>
