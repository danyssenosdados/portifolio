<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $to = "dnyelle.dados@gmail.com";
    $subject = "Nova mensagem do formulário de contato";
    $body = "Nome: $fullname\n";
    $body .= "Email: $email\n";
    $body .= "Mensagem:\n$message";
    
    // Envie o e-mail
    mail($to, $subject, $body);
    
    // Redirecione de volta para a página de contato
    header("Location: contato.html");
} else {
    // Se o método de requisição não for POST, redirecione de volta para a página de contato
    header("Location: contato.html");
}
?>
