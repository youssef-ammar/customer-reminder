<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class CustomerController extends Controller
{
    public function getClientWithLastStatus($id)
    {
        $i = DB::table('histories')->where('customer_id', $id)->get();
        $status = $i->sortDesc()->first();
        $client = Customer::where('id', $id)->get();
        return response()->json(['Last history status' => $status, 'Client' => $client]);
    }

    public function storeClients(Request $request)
    {

        $client = Customer::where('phone', '=', $request->phone)->first();
        if ($client == null) {

            $client = Customer::create([
                'phone' => $request->phone,
                'name' => $request->name,
                'note' => $request->note,
                'date_execution_note' => $request->date_execution_note . " 00:00:00"]);
            $client->save();
            $id = Customer::where('phone', $request->phone)->first()->id;

            DB::table('histories')->insert(['status_id' => '1', 'user_id' => '1', 'customer_id' => $id, 'date' => Carbon::now()]);
            return response()->json(['message' => 'Success'], 200);
        } elseif ($client != null) {
            return response()->json(['message' => 'Phone exist'], 400);

        } else {
            return response()->json(['message' => 'Problem inconnue'], 402);
        }
    }
}
