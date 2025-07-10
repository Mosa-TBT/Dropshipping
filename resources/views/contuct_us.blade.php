<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="{{ asset('assets/css/contuct_us.css') }}">

</head>
<body>

<div class="container">
    <h1>Contact Us</h1>
    <div class="contact-info">
        <p><strong>Email:</strong> <a href="mailto:sidiqj42@gmail.com">sidiqj42@gmail.com</a></p>
        <p><strong>Phone:</strong> +93788081145</p>
        <p><strong>Address:</strong> 123 Main Street, City, Country</p>
    </div>

    <h2>Get in Touch</h2>
    <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>