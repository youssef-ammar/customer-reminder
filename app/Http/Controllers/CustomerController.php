<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class CustomerController extends Controller
{
    public function getClientWithLastStatus()
    {
        $clients = Customer::all();
        return response()->json($clients);
    }

    public function storeClients(Request $request)
    {

        $client = Customer::where('phone', '=', $request->phone)->first();
        if ($client == null) {
            $user = $request->user();
            $client = Customer::create([
                'phone' => $request->phone,
                'name' => $request->name,
                'note' => $request->note,
                'date_execution_note' => $request->date_execution_note . " 00:00:00"]);
            $client->save();
            $id = Customer::where('phone', $request->phone)->first()->id;
            DB::table('histories')->insert(['status_id' => '1', 'user_id' => $user->id, 'customer_id' => $id, 'date' => Carbon::now()]);
            return response()->json(['message' => 'Success'], 200);
        } elseif ($client != null) {
            return response()->json(['message' => 'Phone exist'], 400);

        } else {
            return response()->json(['message' => 'Problem inconnue'], 402);
        }
    }
}
