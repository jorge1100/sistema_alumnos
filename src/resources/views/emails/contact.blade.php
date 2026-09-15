<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nuevo mensaje de contacto</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8f9fa; padding: 30px; border-radius: 8px;">
        <h2 style="color: #2c3e50; margin-top: 0;">Nuevo mensaje de contacto</h2>
        
        <div style="background: white; padding: 20px; border-radius: 6px; margin: 20px 0;">
            <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Asunto:</strong> {{ $data['subject'] }}</p>
        </div>
        
        <div style="background: white; padding: 20px; border-radius: 6px;">
            <h3 style="margin-top: 0; color: #2c3e50;">Mensaje:</h3>
            <p style="white-space: pre-wrap;">{{ $data['message'] }}</p>
        </div>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="color: #666; font-size: 12px; margin: 0;">
            Este mensaje fue enviado desde el formulario de contacto de {{ config('app.name') }}.
        </p>
    </div>
</body>
</html>