<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{

    public function getClientsWithLastStatus(Request $request)
    {
        $user = $request->user();

        $nbcl = History::where('user_id', $user->id)->count();
        $clients = DB::table('customers')
            ->join('histories', 'customers.id', '=', 'histories.customer_id')
            ->select('customers.*', 'histories.*')->where('user_id', $user->id)->where('customer_id', '=', '1')->latest('date')->limit(1);

        for ($i = 2; $i <= $nbcl; $i++) {
            $client = DB::table('customers')
                ->join('histories', 'customers.id', '=', 'histories.customer_id')
                ->select('customers.*', 'histories.*')->where('user_id', $user->id)->where('customer_id', '=', $i)->latest('date')->limit(1);

            $result = $clients->union($client)->get();

        }

        $status = Status::all();
        return response()->json(['Clients' => $result, 'Status' => $status]);
    }

    public function getClientsStTwo(Request $request)
    {
        $user = $request->user();
        $result = DB::table('customers')
            ->join('histories', 'customers.id', '=', 'histories.customer_id')
            ->select('customers.*', 'histories.*')->where('user_id', $user->id)
            ->where('histories.date', '=', Carbon::now()/*->format('d-m-Y')*/)
            ->where('status_id', '=', '2')->get();
        $status = Status::all();
        return response()->json(['Clients' => $result, 'Status' => $status]);
    }

    public function getClientsStOne(Request $request)
    {

        $rest = collect();
        $user = $request->user();
        $nbcl = DB::table('histories')->where('user_id', $user->id)->count();
        $i = 1;
        while ($i <= $nbcl) {

            $client = DB::table('histories')->where('customer_id', '=', $i)->count();
            if ($client == 1) {
                $result = DB::table('customers')
                    ->join('histories', 'customers.id', '=', 'histories.customer_id')
                    ->select('customers.*', 'histories.*')->where('user_id', $user->id)->where('customer_id', '=', $i)->get();
                $rest = $rest->union($result);
            }
            $i = $i + 1;
        }


        $status = Status::all();

        return response()->json(['Clients' => $rest, 'Status' => $status]);

    }

    public function addHist(Request $request)
    {
        $hist = History::where('user_id', '=', $request->user_id)
            ->where('customer_id', '=', $request->customer_id)
            ->where('status_id', '=', $request->status_id)
            ->first();
        if ($hist == null) {
            $hist = History::create([
                'user_id' => $request->user_id,
                'status_id' => $request->status_id,
                'customer_id' => $request->customer_id,
                'date'=>Carbon::now()
            ]);
            $hist->save();
            return response()->json(['message' => 'Success'], 200);
        }
        elseif ($hist != null) {
            return response()->json(['message' => 'History exist'], 400);

        } else {
            return response()->json(['message' => 'Problem inconnue'], 402);
        }
    }

}
