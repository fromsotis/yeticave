<?php
$query = "SELECT id, title FROM lots WHERE winner IS NULL AND date_expire <= CURRENT_DATE();";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
// массив с просроченными лотами и NULL в поле winner
$lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($lots) {
    foreach ($lots as $key => $lot) {
        // Победитель лота c id = $lots['id']
        $query = "SELECT
                        bets.lot_id,
                        bets.price,
                        bets.user_id,
                        users.name,
                        users.email,
                        lots.title
                 FROM bets
                 JOIN lots ON bets.lot_id = lots.id
                 JOIN users ON bets.user_id = users.id
                 WHERE lots.id = {$lot['id']}
                 ORDER BY bets.price DESC
                 LIMIT 1";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $winner = mysqli_fetch_assoc($result);
        // если лот истек а ставки нет, то условие ниже не сработает
        if ($winner) {
            $email = "<h1>Поздравляем с победой</h1>
                     <p>Здравствуйте, {$winner['name']}!</p>
                     <p>Ваша ставка для лота <a href=\"http://yeticave/lot.php?id={$winner['lot_id']}\">{$winner['title']}</a> победила.</p>
                     <p>Перейдите по ссылке <a href=\"http://yeticave/my-lots.php\">мои ставки</a>, чтобы связаться с автором объявления.</p>
                     <small>Интернет-аукцион «YetiCave»</small>";
            
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
              ->setUsername('fromyeticave@gmail.com')
              ->setPassword('!@Qw123456789');
           
            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message('Ваша ставка победила'))
              ->setFrom(['fromyeticave@gmail.com' => 'Yeticave'])
              ->setTo([$winner['email'], $winner['email'] => $winner['name']])
              ->setBody($email, 'text/html');

            $mailer->send($message);
            // если gmail заблокирует отправку письма, то скрипт прервется на первой итерации, в базу ни чего на запишется
            // UPDATE не сработает
            mysqli_query($link, "UPDATE lots SET winner = {$winner['user_id']} WHERE id = {$winner['lot_id']};") or die(mysqli_error($link));
        }
    }
}