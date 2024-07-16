<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Program;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }


    function programRegister($id)
    {
        $program = Program::with('period')->where('is_active', 1)->find($id);

        return view('registration.program.index', compact('program'));
    }

    function prosesDaftar(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|unique:users|max:255',
            'phone_number'  => 'required',
            'gender'        => 'required|string',
            'address'       => 'required|string|max:255',
            'program_id'    => 'required',
            'period_id'     => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt('password'),
                'level'     => 2,
            ]);

            $student = Student::create([
                'user_id'       => $user->id,
                'phone_number'  => $request->phone_number,
                'gender'        => $request->gender,
                'address'       => $request->address
            ]);

            $program = Program::where('id', $request->program_id)->first();
            $transaction = Transaction::create([
                'user_id'               => $user->id,
                'total_purchases'       => $program->price,
                'maximum_payment_time'  => Carbon::now()->addDays(1),
                'code'                  => Transaction::generateCode(),
                'transaction_status'    => 'pending',
                'invoice'               => 'EB.' . date('dmy') . '.' . rand(1000, 9999),
                'program_id'            => $request->program_id,
                'period_id'             => $request->period_id,
                'program_date'          => $request->program_date,
                'program_time'          => $request->program_time,
                'note'                  => $request->message,
                'discount'              => 0
            ]);

            // $payload = [
            //     'transaction_details' => [
            //         'order_id'     => $transaction->invoice,
            //         'gross_amount' => $program->price,
            //     ],
            //     'customer_details' => [
            //         'first_name'    => $user->name,
            //         'email'         => $user->email,
            //     ],
            //     'item_details' => [
            //         [
            //             'id'            => $transaction->invoice,
            //             'price'         => $program->price,
            //             'quantity'      => 1,
            //             'name'          => 'Program ' . $program->name,
            //             'brand'         => 'English Booster',
            //             'category'      => 'English Course',
            //             'merchant_name' => config('app.name'),
            //         ],
            //     ],
            // ];

            // $snapToken = \Midtrans\Snap::getSnapToken($payload);
            // $transaction->snap_token = $snapToken;
            // $transaction->save();

            // $admin = User::find('20b2a4122c614bb68e41b1a6f3f37780');
            // $admin->notify(new SendNewUserNotification($user));

            // $message = "*Mohon dibaca dan dipahami!*\n\n_Hallo, saya admin dari English Booster Kampung Inggris, akun kamu telah terdaftar di platform kami dengan data_\n\nNama: " . $user->name . "\nEmail: " . $user->email . "\n\nBerikut link pembayaran dan verifikasi kamu\n" . env('APP_URL') . "/payment/" . $transaction->id . "\n\n*Jika link tidak bisa diklik, silakan simpan dulu nomor ini atau copy dan paste dibrowser kamu.*\n\n_terimakasih telah menjadi bagian dari kami, semoga English Booster Kampung Inggris dapat membantu proses belajar kamu. aamiin._";
            // sendWhatsappNotification($student->phone_number, $message);


            DB::commit();

            return redirect('payment/' . $transaction->id);
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ];
        }
    }

    function payment($id)
    {
        $transaction = Transaction::with('user.student')->findOrfail($id);
        
        return view('registration.program.payment', compact('transaction'));
    }
}
