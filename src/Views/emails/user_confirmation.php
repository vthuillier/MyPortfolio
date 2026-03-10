<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #0c0a09;
            color: #f5f5f4;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1a1918;
            border: 1px solid rgba(250, 204, 21, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .header {
            border-bottom: 2px solid #facc15;
            padding: 30px;
        }

        .header h1 {
            color: #facc15;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 4px;
            font-size: 20px;
            font-weight: 900;
        }

        .header span {
            color: #78716c;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .content {
            padding: 30px;
        }

        .greeting {
            color: #f5f5f4;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .text {
            color: #a8a29e;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .payload-label {
            color: #facc15;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: block;
        }

        .message-box {
            background-color: #000000;
            padding: 25px;
            border-left: 4px solid #facc15;
            color: #d6d3d1;
            font-size: 14px;
            line-height: 1.7;
            position: relative;
        }

        .footer {
            padding: 20px 30px;
            border-top: 1px solid #333;
        }

        .footer p {
            color: #78716c;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <span>
                <?= htmlspecialchars($appName) ?>
            </span>
            <h1>SYSTEM ACKNOWLEDGEMENT</h1>
        </div>

        <div class="content">
            <div class="greeting">Bonjour <strong>
                    <?= htmlspecialchars($name) ?>
                </strong>,</div>

            <div class="text">
                Votre transmission a été reçue avec succès par nos serveurs. Une unité d'intervention a été dépêchée
                pour analyser votre requête.
            </div>

            <span class="payload-label">Recapitulatif_du_payload:</span>
            <div class="message-box">
                <?= nl2br(htmlspecialchars($message)) ?>
            </div>

            <div class="text" style="margin-top: 30px;">
                Je reviendrai vers vous dans les plus brefs délais via le canal de communication fourni.
            </div>
        </div>

        <div class="footer">
            <p>//
                <?= htmlspecialchars($userName) ?>
            </p>
        </div>
    </div>
</body>

</html>