<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #0c0a09;
            color: #f5f5f4;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #1c1917;
            border: 1px solid #292524;
            padding: 40px;
        }

        .header {
            border-bottom: 2px solid #facc15;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #facc15;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }

        .content {
            line-height: 1.6;
            font-size: 15px;
            color: #d6d3d1;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #292524;
            font-size: 12px;
            color: #78716c;
        }

        .original {
            margin-top: 30px;
            padding: 20px;
            background: #0c0a09;
            border-left: 3px solid #444;
            font-style: italic;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Transmission Reply //
                <?php echo htmlspecialchars($appName); ?>
            </h1>
        </div>
        <div class="content">
            <?php echo nl2br(htmlspecialchars($message)); ?>
        </div>

        <?php if ($originalMessage): ?>
            <div class="original">
                <div
                    style="color: #78716c; margin-bottom: 10px; font-weight: bold; text-transform: uppercase; font-size: 10px;">
                    Original Transmission:</div>
                <?php echo nl2br(htmlspecialchars($originalMessage)); ?>
            </div>
        <?php endif; ?>

        <div class="footer">
            //
            <?php echo htmlspecialchars($userName); ?><br>
            Sent from my automated terminal.
        </div>
    </div>
</body>

</html>