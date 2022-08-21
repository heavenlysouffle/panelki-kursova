<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Panel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class PayController extends Controller {

    public function pay_postValidator(Request $request) {
        session_start();
        $card = $request -> input('card');
        $first_name = $request -> input('first_name');
        $second_name = $request -> input('second_name');
        $card_arr = str_split($card);
        $first_name_arr = str_split($first_name);
        $second_name_arr = str_split($second_name);
        $phone = $request->phone;
        $errors = [];
        $order_obj = new Order();
        $orders = $order_obj->all();
        $panelObj = new Panel();
        $panels = $panelObj->all();

        if (count($card_arr) != 16) {
            $errors[] = 'Неправильно заповнений номер карти';
        }

        if (!$first_name) {
            $errors[] = 'Неправильно заповнене поле імені';
        }

        if (!$second_name) {
            $errors[] = 'Неправильно заповнене поле фамілії';
        }

        foreach ($first_name_arr as $item) {
            if (is_numeric($item) && !in_array('Неправильно заповнене поле імені', $errors)) {
                $errors[] = 'Неправильно заповнене поле імені';
            }
        }

        foreach ($second_name_arr as $item) {
            if (is_numeric($item) && !in_array('Неправильно заповнене поле фамілії', $errors)) {
                $errors[] = 'Неправильно заповнене поле фамілії';
            }
        }

        if (count($errors) === 0) {

            if ($orders->isEmpty()) {
                $id_order = 1;
            } else {
                $last_order = $orders[count($orders)-1];
                $id_order = $last_order->order_id;
            }

            foreach ($_SESSION['order_array'] as $item_arr) {
                foreach ($panels as $panel) {
                    if ($panel->name == $item_arr['name']) {
                        DB::table('orders')->insert([
                            [
                                'order_id' => $id_order,
                                'panel_id' => $item_arr['name'],
                                'price' => $panel->price,
                                'first_name' => $first_name,
                                'second_name' => $second_name,
                                'phone' => $phone,
                                "created_at" => Carbon::now(), # new \Datetime()
                                "updated_at" => Carbon::now(),  # new \Datetime()
                            ],
                        ]);
                    }
                }
            }

            setcookie("message", "Ваше замовлення сплачено успішно!", 0, '/');
            session_destroy();
            return redirect()->route('index');

        } else {
            return view('form_pay', ['errors' => $errors, 'panels'=>$panels] );
        }
    }
}
