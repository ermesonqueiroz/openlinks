<meta charset="UTF-8" />
<meta
    name="viewport"
    content="width=device-width,initial-scale=1"
/>
<meta
    name="csrf-token"
    content="{{ csrf_token() }}"
/>
<meta
    name="description"
    content="{{ config('app.name', 'OpenLinks') }} - The open-source link infrastructure for creators."
    data-rh="true"
/>

<title>{{ config('app.name', 'OpenLinks') }} - The open-source link infrastructure for creators.</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

<style>
    @font-face {
        font-family: "Space Grotesk", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }
</style>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
