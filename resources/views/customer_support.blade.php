<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Support</title>
    <link rel="stylesheet" href="{{ asset('assets/css/customer_support.css') }}">
</head>
<body>

<div class="container">
    <h1>Customer Support</h1>
    <div class="support-info">
        <p><strong>Email:</strong> <a href="mailto:support@example.com">support@example.com</a></p>
        <p><strong>Phone:</strong> 012-345-678</p>
        <p><strong>Business Hours:</strong> Monday to Friday, 9 AM - 5 PM</p>
    </div>

    <h2>Get Support</h2>
    <form class="support-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="issue">Describe Your Issue:</label>
        <textarea id="issue" name="issue" rows="5" required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>