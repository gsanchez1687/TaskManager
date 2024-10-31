<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .header {
            background-color: #16243d;
            color: #ffffff;
            padding: 15px 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
        }
        .contact-info {
            margin-bottom: 20px;
        }
        .contact-info h3 {
            color: #16243d;
            margin-bottom: 10px;
        }
        .contact-info p {
            margin: 5px 0;
        }
        .message {
            margin-top: 20px;
        }
        .message h3 {
            color: #16243d;
            margin-bottom: 10px;
        }
        .footer {
            text-align: center;
            padding: 15px 20px;
            color: #777777;
            font-size: 14px;
        }
        a {
            color: #16243d;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Notification assigned Household chores</h1>
            <p>{{ date('Y-m-d H:i:s') }}</p>
        </div>
        <div class="content">
            <div class="contact-info">
                
            </div>
            <div class="message">
                <div class="card" style="width: 100%">
                    <div class="card-header">
                        <h2>You've been assigned a new household chores</h2>
                    </div>
                    <table style="width: 100%">
                        <tr>
                            <td>{{ __('Title:') }}</td>
                            <td>{{ $data->task->title }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Description:') }}</td>
                            <td>{{ $data->task->description }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Expedition Date:') }}</td>
                            <td>{{ $data->task->expiration_date }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Status:') }}</td>
                            <td>{{ $data->task->statu->name }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Credit for this household chores:') }}</td>
                            <td>{{ $data->credit }}</td>
                        </tr>
                    </table>
                  </div>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} ChoresAppGE. All rights reserved.</p>
            <p><a href="">ChoresAppGE</a></p>
        </div>
    </div>
</body>
</html>