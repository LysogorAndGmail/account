<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyModuleRequest;
use App\Module;
use App\Organization;
use App\OrgSubscription;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules  = Module::all();
        $userOrgs = auth()->user()->orgs->pluck('id')->toArray();

        $subs = [];

        foreach ($modules as $module) {
            $module->load('subscriptions');
            foreach ($module->subscriptions as $sub) {
                if (in_array($sub->org_id, $userOrgs)) {
                    $subs[] = $sub->load('org');
                }
            }
        }

        return response()->json([
            'modules' => $modules,
            'subs'    => $subs
        ]);
    }

    public function buyModule(BuyModuleRequest $request)
    {
        $years        = $request->years;
        $boughtYears  = $years > 1 ? 'years' : 'year';
        $org          = Organization::find($request->org);
        $hasModule    = $org->subscriptions()->exists($request->module);
        $msg          = 'Organization has valid subscription';
        $authId       = auth()->id();
        $workforceRes = 'User not created to WORKFORCE';

        if ( ! $hasModule) {
            $orgSub               = new OrgSubscription();
            $orgSub->org_id       = $request->org;
            $orgSub->module_id    = $request->module;
            $orgSub->purchased_at = Carbon::now();
            $orgSub->paid_at      = Carbon::now();
            $orgSub->valid_till   = Carbon::now()->addYears($years);

            $msg = "Module bought for $years $boughtYears";

            info("User id=$authId bought module id=$request->module for org id=$org->id for $years");
            info("Starting to create user to WORKFORCE");
            info('With token ' . $request->access_token);
            info('With org ' . $org);

            $client = new Client();

            $url = env('WORKFORCE_URL');
            $res = $client->post("$url/api/user/create", [
                'form_params' => [
                    'token'   => $request->access_token,
                    'org_id'  => $request->org,
                    'user_id' => auth()->user()->id,
                    'fname'   => auth()->user()->fname,
                    'lname'   => auth()->user()->lname,
                    'email'   => auth()->user()->email,
                    'org'     => json_encode($org)
                ]
            ]);

            $orgSub->save();
            $workforceRes = json_decode($res->getBody()->getContents());
        }

        return response()->json(['message' => $msg, 'workforce' => $workforceRes]);
    }

    public function cancelModule(Request $request, OrgSubscription $sub)
    {
        // TODO: delete data from WORKFORCE
        $sub->delete();

        return response()->json(['message' => 'Subcription Cancelled']);
    }
}
