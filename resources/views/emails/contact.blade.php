<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Pesan Kontak Website</title>
</head>

<body style="font-family: Arial, sans-serif; color: #111827; line-height: 1.6;">
    <h2 style="margin-bottom: 16px;">Pesan Kontak Website</h2>

    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subjek:</strong> {{ $data['subject'] }}</p>

    <p><strong>Pesan:</strong></p>
    <p>{!! nl2br(e($data['message'])) !!}</p>
</body>

</html>
