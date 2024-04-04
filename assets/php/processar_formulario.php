<?php
// Carrega as variáveis de ambiente do arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/data-ny/portifolio/assets/php');
$dotenv->load();

// Incluir os arquivos da biblioteca PHPMailer
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verificar se o formulário foi submetido via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar os dados do formulário
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    try {
        // Criar uma instância do PHPMailer
        $mail = new PHPMailer(true);
        
        // Configurações do servidor SMTP (no seu caso, Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['email_site']; // Usa a variável de ambiente EMAIL
        $mail->Password = $_ENV['psw']; // Usa a variável de ambiente SENHA
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        // Configurações do remetente e destinatário
        $mail->setFrom($_ENV['email_site'], 'Danyelle Melo'); // Usa a variável de ambiente EMAIL como remetente
        $mail->addAddress($_ENV['psw']); // Usa a variável de ambiente EMAIL como destinatário
        
        // Conteúdo do e-mail
        $mail->isHTML(false); // Define o conteúdo como texto plano
        $mail->Subject = 'Nova mensagem do formulário de contato';
        $mail->Body = "Nome: $fullname\nEmail: $email\nMensagem:\n$message";
        
        // Envia o e-mail
        $mail->send();
        
        // Redireciona de volta para a página de contato após o envio bem-sucedido
        header("Location: contato.html");
        exit;
    } catch (Exception $e) {
        // Se ocorrer um erro durante o envio do e-mail, exibe uma mensagem de erro
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
} else {
    // Se o método de requisição não for POST, redireciona de volta para a página de contato
    header("Location: contato.html");
    exit;
}
?>