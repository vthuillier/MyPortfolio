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
            border: 1px solid rgba(239, 68, 68, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .header {
            border-bottom: 2px solid #ef4444;
            padding: 30px;
        }

        .header h1 {
            color: #ef4444;
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

        .meta {
            color: #a8a29e;
            font-size: 14px;
            margin-bottom: 30px;
            border-left: 2px solid #444;
            padding-left: 20px;
        }

        .meta strong {
            color: #f5f5f4;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1px;
        }

        .message-box {
            background-color: #000000;
            padding: 25px;
            border-left: 4px solid #ef4444;
            margin: 30px 0;
            color: #d6d3d1;
            font-size: 14px;
            line-height: 1.7;
            position: relative;
        }

        .message-box::before {
            content: "DATA_START";
            position: absolute;
            top: -10px;
            right: 20px;
            background: #ef4444;
            color: #000;
            font-size: 8px;
            font-weight: 900;
            padding: 2px 6px;
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
            font-family: monospace;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <span>PORTFOLIO_SYSTEM_ALERT</span>
            <h1>INCOMING TRANSMISSION</h1>
        </div>

        <div class="content">
            <div class="meta">
                <strong>Origin:</strong>
                <?= htmlspecialchars($name) ?> &lt;
                <?= htmlspecialchars($email) ?>&gt;<br>
                <strong>Priority:</strong> HIGH_LEVEL<br>
                <strong>Status:</strong> QUEUED_FOR_REVIEW
            </div>

            <div class="message-box">
                <?= nl2br(htmlspecialchars($message)) ?>
            </div>
        </div>

        <div class="footer">
            <p>// END_OF_PAYLOAD [HASH:
                <?= substr(md5(time()), 0, 8) ?>]
            </p>
        </div>
    </div>
</body>

</html>