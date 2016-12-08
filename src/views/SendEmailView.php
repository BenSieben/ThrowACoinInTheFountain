<?php
namespace cs174\hw5\views;

/**
 * Class SendEmailView
 * @package cs174\hw5\views
 *
 * This class shows user the view after they
 * have successfully paid for their wish. Here,
 * the user can enter email addresses to send
 * an email to, and the email has a link to
 * the wish PDF file
 */
class SendEmailView extends View {

    /**
     * Renders HTML page for user to enter emails to send
     * PDF link to to view the wish
     * @param Array $data data to use in rendering
     */
    public function render($data) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Send Wish Emails | Throw-a-Coin-in-the-Fountain</title>
    <link rel="icon" href="./src/resources/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./src/styles/stylesheet.css" />
</head>
<body>
    <h1><a href="<?= $data['base_url'] ?>">Throw-a-Coin-in-the-Fountain</a></h1>
    <h3><?= $data['send-email-text'] ?><a href="<?= $data['pdf_link'] ?>"><?= $data['here-text'] ?></a>)</h3>
    <form method="get">
        <input type="hidden" name="c" value="email" />
        <input type="hidden" name="f" value="<?= $data['f'] ?>" />
        <label for="email"><?= $data['email-text'] ?></label><input type="text" id="email" name="email" />
        <input type="submit" value="<?= $data['send-text'] ?>"/>
    </form>
<?php
        if(isset($data['email_message'])) {
?>
    <div id="serverErrorMessage"><p><?= $data['email_message'] ?></p></div>
<?php
        }
?>
</body>
</html>
<?php
    }
}
?>