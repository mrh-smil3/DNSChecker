<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Ketersediaan Domain</title>
</head>
<body>
    <h1>Cek Ketersediaan Domain</h1>
    <form action="{{ route('checkDomainAvailability') }}" method="post">
        @csrf
        <label for="domain">Masukkan Nama Domain:</label>
        <input type="text" id="domain" name="domain" required>
        <button type="submit">Cek Domain</button>
    </form>

    @isset($message)
        <p>{{ $message }}</p>
    @endisset
</body>
</html>
