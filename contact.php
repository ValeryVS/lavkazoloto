<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $contact = strip_tags(trim($_POST["contact"]));
        $contact = str_replace(array("\r","\n"),array(" "," "),$contact);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($contact) ) {
            // Set a 400 (bad request) response code and exit.
            // http_response_code(400);
            header('X-PHP-Response-Code: 400', true, 400);
            echo "Ошибка.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "picma.alice@gmail.com, 2me@enjoy-it.ru, valery.vs.va@gmail.com";

        // Set the email subject.
        $subject = "Заказ от $name";

        // Build the email content.
        $email_content = "Имя: $name\n";
        $email_content .= "Контакт: $contact\n";

        // Send the email.
        if (mail($recipient, $subject, $email_content, '')) {
            // Set a 200 (okay) response code.
            // http_response_code(200);
            header('X-PHP-Response-Code: 200', true, 200);
            echo "Спасибо! Ваша заявка была получена.";
        } else {
            // Set a 500 (internal server error) response code.
            // http_response_code(500);
            header('X-PHP-Response-Code: 500', true, 500);
            echo "Ошибка.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        // http_response_code(403);
        header('X-PHP-Response-Code: 403', true, 403);
        echo "Ошибка.";
    }

?>
