<?php


namespace App\Services;


use App\Mail\DeleteOrderUser;
use App\Mail\NewBooking;
use App\Mail\RejectOrder;
use App\Mail\SendBooking;
use App\Mail\SendRegister;
use App\Mail\SendUserDeleteOrder;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\DocBlock\Serializer;

class MailService extends Serializer
{

    public function SendRegister(string $nameUser, string $email, string $password)
    {
        $params = [
            'user_name' => $nameUser,
            'email' => $email,
            'password' => $password,
        ];
        $subject = 'Регистрация на сайте';
        $toEmail = $_POST['email'];
        Mail::to($toEmail)->send(new SendRegister($subject, $params));
    }

    public function RejectOrder(object $data){
        $data = [
            'user_name' => $data->user_name,
            'in' => $data->no_in,
            'out' => $data->no_out,
            'sum' => $data->total
        ];
        $subject = 'Бронирование не подтверждено';
        $toEmail = preg_replace("/\s+/", "", $data->email);
        Mail::to($toEmail)->send(new RejectOrder($subject, $data));
    }

    public function NewBooking(array $params, string $userName, string $email)
    {
        $data = [
            'in' => $params['startDate'],
            'out' => $params['endDate'],
            'user_name' => $userName,
            'id' => $params['id'],
            'url' => request()->root(),
        ];

        $subject = 'Бронирование дат';
        $toEmail = $email;
        Mail::to($toEmail)->send(new SendBooking($subject, $data)); // Письмо пользователю обуспешном бронировании

        $sub = 'Новое бронирование';
        $email_admin = '0120912@mail.ru';
        Mail::to($email_admin)->send(new NewBooking($sub, $data));// Письмо админу о новом бронировании
        $message = "Предварительное бронирование прошло успешно. <br> Ожидайте подтверждения администратором. На вашу почту, которую вы указали - <b>$email</b>, было отправлено письмо. Проверьте, пожалуйста, почту...<br> Если письма нет в папке 
'Входящие', проверьте папку 'Спам'. <div style='color: red'>Важно!!!</div> Если письмо поступило в папку 'Спам' и для того, чтобы письма в дальнейшем приходили в папку 'Входящие', и Вы получали оповещения, отметьте в ящике, что данное письмо не является спамом.<br>
Статус данного бронирования, вы сможете проверить в своём <a href='/profile'> Личном кабинете.</a>";
        return $message;
    }

    public function DeleteOrderUser(array $data){
        $subject = 'Удаление бронирования';
        $toEmail = '0120912@mail.ru';
        $user_email = $data['email'];
        Mail::to($toEmail)->send(new DeleteOrderUser($subject, $data));
        Mail::to($user_email)->send(new SendUserDeleteOrder($subject, $data));
    }
}