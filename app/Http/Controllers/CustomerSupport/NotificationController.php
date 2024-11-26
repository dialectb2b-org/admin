<?php

namespace App\Http\Controllers\CustomerSupport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Models\CompanyUser;
use DB;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        $query = Notification::where('type',2);
        $notifications = $query->groupBy('message')->paginate(10);
        return view('customersupport.notifications.index',compact('notifications')); 
    }

    public function create()
    {
        return view('customersupport.notifications.create');
    }

    public function store(NotificationRequest $request)
    {
        DB::beginTransaction();
        try{
            $user_type = $request->user_type;
            if($user_type == "all"){
                $send_group = CompanyUser::get(['id','company_id','role']);
            }
            elseif($user_type == "admin"){
                $send_group = CompanyUser::where('role',1)->get();
            }
            elseif($user_type == "procurement"){
                $send_group = CompanyUser::where('role',2)->get();
            }
            elseif($user_type == "sales"){
                $send_group = CompanyUser::where('role',3)->get();
            }
            $chunkSize = 100;
   
                foreach ($send_group as $user) {
                    Notification::create([
                        'company_id' => $user->company_id,
                        'user_id' => $user->id,
                        'type' => 2,
                        'role' => $user->role,
                        'title' => $request->title,
                        'message' => $request->message,
                        'action' => null,
                        'action_url' => null,
                        'user_type' => $request->user_type
                    ]);
                }
           
           
            DB::commit();
            return redirect()->route('notifications.index')->with('success','Notification has been created!');
        }
        catch (Throwable $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function show(Notification $notifictaion)
    {
        return view('customersupport.notifictaions.show',compact('notifictaion'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $notifications = Notification::find($id);
            $notifications->delete();
            DB::commit();
            return redirect()->route('notifications.index')->with('success','Notifications has been deleted!');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
       
    }

}
