<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inbox</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .row {
            display: flex;
        }

        .col-3 {
            flex: 2;
            padding: 10px;
        }

        .col-9 {
            flex: 9
        }

        label {
            display: block
        }

        input,
        textarea {
            width: 100%;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .bg-gary {
            background-color: #eee;
        }

        .alert {
            padding: 10px;
            margin-bottom: 10px;
        }

        .alert-success {
            background-color: #4CAF50;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="row">

        <div class="col-3 bg-gary">
            <h3>Send Email</h3>

            {{-- error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- message --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/send" method="POST">
                @csrf
                <div>
                    <label for="to">To:</label>
                    <input type="text" name="to" id="to" />
                </div>

                <div>
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" id="subject" />
                </div>

                <div>
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </div>

                <button class="submit">Send</button>
            </form>
        </div>

        <div class="col-9">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event</th>
                        <th>Recipient</th>
                        <th>Subject</th>
                        <th>Tag</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messageList as $index => $message)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $message['Status'] }}</td>
                            <td>
                                <span>To:</span>
                                @foreach ($message['To'] as $to)
                                    <span>{{ $to['Email'] }}</span>
                                @endforeach
                            </td>
                            <td>{{ $message['Subject'] }}</td>
                            <td></td>
                            <td>{{ $message['ReceivedAt'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
