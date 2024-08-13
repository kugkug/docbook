<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            text-align: center;
            padding: 20px 0;
        }
        .content h1 {
            color: #333333;
        }
        .content p {
            color: #555555;
        }
        .content .details {
            text-align: left;
            margin: 20px 0;
        }
        .content .details th, .content .details td {
            padding: 5px 10px;
            border-bottom: 1px solid #dddddd;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://via.placeholder.com/150" alt="Company Logo">
        </div>
        <div class="content">
            <h1>Payment Confirmation</h1>
            <p>Thank you for your payment. Your transaction has been completed successfully. Below are the details of your transaction:</p>
            <table class="details">
                <tr>
                    <th>Transaction ID:</th>
                    <td>123456789</td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td>July 8, 2024</td>
                </tr>
                <tr>
                    <th>Amount:</th>
                    <td>$100.00</td>
                </tr>
                <tr>
                    <th>Payment Method:</th>
                    <td>Credit Card</td>
                </tr>
            </table>
            <p>If you have any questions, please contact our support team.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
