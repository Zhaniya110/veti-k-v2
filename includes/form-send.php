<?php
/**
 * Отправка заказа
 */
add_action( 'wp_ajax_form_send', 'form_send' );
add_action( 'wp_ajax_nopriv_form_send', 'form_send' );

function form_send($order_id = false){
    global $wpdb;

    if($order_id){
        $posts = $wpdb->get_row("SELECT order_data, blog_id FROM wp_orders_email WHERE order_id = '$order_id'");
        $_POST = (array) json_decode($posts->order_data);

        switch_to_blog( $posts->blog_id );
    }
    else{
        $order_id = 'order_id_' . uniqid();
        $wpdb->insert("{$wpdb->base_prefix}orders_email", [
            'order_id' => $order_id,
            'blog_id' => get_current_blog_id(),
            'order_data' => json_encode($_POST),
        ]);
    }

    $name = isset( $_POST['name'] ) ? $_POST['name'] : '';
    $phone = isset( $_POST['phone'] ) ? $_POST['phone'] : '';
    $liqPayStatus = isset( $_POST['liqpay_status'] ) ? $_POST['liqpay_status'] : '';
    $payBy = isset( $_POST['payment-method'] ) ? $_POST['payment-method'] : '';
    $sum = isset( $_POST['sum'] ) ? $_POST['sum'] : '';
    $street = isset( $_POST['street'] ) ? $_POST['street'] : '';
    $house = isset( $_POST['house'] ) ? $_POST['house'] : '';
    $apartment = isset( $_POST['apartment'] ) ? $_POST['apartment'] : '';
    $user_coment = isset( $_POST['user_coment'] ) ? $_POST['user_coment'] : '';
    $people_count = isset( $_POST['people_qty'] ) ? $_POST['people_qty'] : '';
    $phone_me = isset( $_POST['call_me'] ) ? $_POST['call_me'] : '';
    $eco = isset( $_POST['eco'] ) ? $_POST['eco'] : false;
    $utm = isset( $_POST['utp2'] ) ? $_POST['utp2'] : '';
    $order_data = isset( $_POST['order-data'] ) ? json_decode(stripslashes($_POST['order-data']), true) : '';

    $delivery= $order_data['deliveryPrice'];
    $totalPrice = $order_data['price'];

    $promocode = isset( $order_data['promocode'] ) && !empty($order_data['promocode']) ? $order_data['promocode'] : '';

    // проверяем одноразовый промокод и делаем не активным
    promocod_one($order_data);

    /*
     **** КАТЕГОРИЧЕСКИ НЕ ТРОГАТЬ!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     */
    require(__DIR__.'/MIGFrontpadIntegration.php'); // ПОДКЛЮЧЕНИЕ ИНТЕГРАЦИИ С FrontPad
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


    // Order table
    $order_table = '<table style="border-collapse: collapse; border: solid 1px;">
    <tr>
        <th style="border: solid 1px; padding: 10px;">Бургер</th>
        <th style="border: solid 1px; padding: 10px;">Котлета</th>
        <th style="border: solid 1px; padding: 10px;">Подвійна котлета</th>
        <th style="border: solid 1px; padding: 10px;">Ступінь прожарки</th>
        <th style="border: solid 1px; padding: 10px;">Кількість</th>
        <th style="border: solid 1px; padding: 10px;">Ціна</th>
    </tr>';

    foreach ($order_data['burgers'] as $burger) {
        $flevel = '';
        if (1 == (int)$burger['fireLevel'])
            $flevel = 'rare';
        elseif (2 == (int)$burger['fireLevel'])
            $flevel = 'medium';
        elseif (3 == (int)$burger['fireLevel'])
            $flevel = 'well done';
        $order_table .= "<tr>
                        <td style='border: solid 1px; padding: 10px;'>{$burger['name']}</td>
                        <td style='border: solid 1px; padding: 10px;'>{$burger['meatType']}</td>
                        <td style='border: solid 1px; padding: 10px;'>" . ($burger['isDouble'] ? 'Так' : 'Ні') . "</td>
                        <td style='border: solid 1px; padding: 10px;'>{$flevel}</td>
                        <td style='border: solid 1px; padding: 10px;'>{$burger['quantity']}</td>
                        <td style='border: solid 1px; padding: 10px;'>{$burger['burgerTotalPrice']}</td>
                    </tr>";
    }
    $order_table .= '</table>';

    // Extra order table
    $extra_order_table = '<table style="border-collapse: collapse; border: solid 1px;">
    <tr>
        <th style="border: solid 1px; padding: 10px;">Назва</th>
        <th style="border: solid 1px; padding: 10px;">Кількість</th>
        <th style="border: solid 1px; padding: 10px;">Ціна</th>
    </tr>';

    foreach ($order_data['extraProducts'] as $extra) {
        $extra_order_table .= "<tr>
                        <td style='border: solid 1px; padding: 10px;'>{$extra['name']}</td>
                        <td style='border: solid 1px; padding: 10px;'>{$extra['quantity']}</td>
                        <td style='border: solid 1px; padding: 10px;'>{$extra['extraProductTotalPrice']}</td>
                    </tr>";
    }
    $extra_order_table .= '</table>';
    

    $to = get_field('email_order', 'option');
    $subject = "Замовлення з Kraft Burger";

    $message = '<h4>Основные данные</h4><table style="border-collapse: collapse; border: solid 1px;">';
    $message .= "
    <tr><td style='border: solid 1px; padding: 10px;'>Utm:</td><td style='border: solid 1px; padding: 10px;'>$utm</td></tr>
    <tr><td style='border: solid 1px; padding: 10px;'>Ім'я:</td><td style='border: solid 1px; padding: 10px;'>$name</td></tr>
    <tr><td style='border: solid 1px; padding: 10px;'>Номер телефону:</td> <td style='border: solid 1px; padding: 10px;'>$phone</td></tr>
    <tr><td style='border: solid 1px; padding: 10px;'>Тип оплати:</td> <td style='border: solid 1px; padding: 10px;'>$payBy</td></tr>";

    $message .= "<tr><td style='border: solid 1px; padding: 10px;'>Статус LiqPay:</td> <td style='border: solid 1px; padding: 10px;'>".($liqPayStatus != 'false') ? $liqPayStatus : ''."</td></tr>";

    $message .= "
    <tr><td style='border: solid 1px; padding: 10px;'>Сума з якої потрібна решта:</td><td style='border: solid 1px; padding: 10px;'>$sum</td></tr>
    <tr><td style='border: solid 1px; padding: 10px;'>Еко упаковка:</td><td style='border: solid 1px; padding: 10px;'>" . ($eco ? 'Так' : 'Ні') . "</td></tr>
    <tr><td style='border: solid 1px; padding: 10px;'>Вулиця:</td><td style='border: solid 1px; padding: 10px;'>$street</td></tr>
    <tr><td style='border: solid 1px; padding: 10px;'>Будинок:</td><td style='border: solid 1px; padding: 10px;'>$house</td></tr>
    <tr><td style='border: solid 1px; padding: 10px;'>Квартира:</td><td style='border: solid 1px; padding: 10px;'>$apartment</td></tr>
    <tr><td style='border: solid 1px; padding: 10px;'>Кількість осіб:</td><td style='border: solid 1px; padding: 10px;'>$people_count</td></tr>
    <tr><td style='border: solid 1px; padding: 10px;'>Телефонувати для підтвердження:</td><td style='border: solid 1px; padding: 10px;'>" . (!$phone_me ? 'Так' : 'Ні') . "</td></tr>
    </table>";

    $message .= '<br><h4>Коментар</h4>'.$user_coment;
    $message .= '<br><h4>Замовлення</h4>'.$order_table;
    $message .= '<br><h4>Додаткові продукти:</h4>'.$extra_order_table.'<br>';
    $message .= ($promocode ? '<h2>Активовано промокод:</h2> ' . $promocode . '<br>' : '');
    $message .= '<h3>Ціна доставка: '.$delivery.'</h3>';
    $message .= '<h3>Загальна ціна разом з доставкою: '.$totalPrice.'</h3>';


    add_filter( 'wp_mail_content_type', 'set_html_content_type' );

    if (wp_mail($to,$subject,$message) ){
        echo get_blog_option(get_current_blog_id(), 'siteurl').'/thanks/?order='.$wpdb->insert_id;

        // Сбросим content-type, чтобы избежать возможного конфликта
        remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
    }
    else{
        echo "error";
    }

    restore_current_blog();
    die;
}

/**
 * Html письмо
 * @return string
 */
function set_html_content_type() {
    return 'text/html';
}

/**
 * Данные для оплаты через LiqPay
 */
add_action('wp_ajax_payments_data', 'payments_data_callback');
add_action('wp_ajax_nopriv_payments_data', 'payments_data_callback');

function payments_data_callback() {
    $price = $_POST['price'];

    $order_id = 'order_id_' . uniqid();

    global $wpdb;

    $wpdb->insert("{$wpdb->base_prefix}orders_email", [
        'order_id' => $order_id,
        'blog_id' => get_current_blog_id(),
        'order_data' => json_encode($_POST),
    ]);


    // lviv
    if(get_current_blog_id() == 4){
        $name = 'Lviv';
        $LIQPAY_PUBLIK_KEY = 'i55862220452';
        $LIQPAY_PRIVAT_KEY = 'WYgPiG4xlNIHuLKI4NILT8EdqtMDC7U4Ic1D5oI7';
    }
    // киев
    elseif(get_current_blog_id() == 5){
        $name = 'Kyiv';
        $LIQPAY_PUBLIK_KEY = 'i86220841260';
        $LIQPAY_PRIVAT_KEY = 'pEzKvlf9WaTk1v75q7n06SI2TOWwtuMgM36bKOsQ';
    }
    // odessa
    else{
        $name = 'Odessa';
        $LIQPAY_PUBLIK_KEY = 'i12272434366';
        $LIQPAY_PRIVAT_KEY = 'OjOc3gT0oPkLqQugKfpmJdWR7Mh4fCbNyYMK52i8';
    }


    $liqpay = new LiqPay($LIQPAY_PUBLIK_KEY, $LIQPAY_PRIVAT_KEY);
    $liqData = $liqpay->get_data_and_signature([
        'action'      => 'pay',
        'amount'      => $price,
        'currency'    => 'UAH',
        'description' => 'Оплата заказа KruftBurger ' . $name,
        'order_id'    => $order_id,
        'version'     => '3',
        'result_url'  => get_blog_option(get_current_blog_id(), 'siteurl').'/thanks/?order='.$wpdb->insert_id,
//        'sandbox'     => '1'
    ]);

    echo json_encode([
        'data' => $liqData['data'],
        'signature' => $liqData['signature'],
        'order_id' => $order_id
    ]);

    wp_die();
}