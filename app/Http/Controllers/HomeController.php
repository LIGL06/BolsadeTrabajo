<?php

namespace App\Http\Controllers;

use App\Notifications\newNotification;
use App\User;
use App\UserInfo;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */
    public function getNotifications()
    {
        return auth()->user()->unreadNotifications;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function markNotification(Request $request)
    {
        return auth()->user()->unreadNotifications->find($request->not_id)->markAsRead();
    }

    /**
     * @return mixed
     */
    public function markAllNotifications()
    {
        return auth()->user()->unreadNotifications->markAsRead();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminDashboard()
    {
        $companiesCount = \App\Company::count();
        $jobCounts = \App\Job::count();
        $employeesCounts = \App\Employee::count();
        $employersCounts = \App\Employer::count();

        $jobs = \App\Job::where('vacancies', '>', 0)->orderBy('created_at', 'desc')->get();
        $employees = \App\Employee::orderBy('created_at', 'desc')->get();
        $companies = \App\Company::orderBy('created_at', 'desc')->get();
        $employers = \App\Employer::orderBy('created_at', 'desc')->get();

        return view('admin.home', [
            'companiesCount' => $companiesCount,
            'jobCounts' => $jobCounts,
            'employeesCounts' => $employeesCounts,
            'employersCounts' => $employersCounts,
            'jobs' => $jobs,
            'employees' => $employees,
            'companies' => $companies,
            'employers' => $employers
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request)
    {
        if ($request->user()->isEmployer()) {
            return redirect('employers');
        }
        if ($request->user()->isEmployee()) {
            return redirect('employees');
        }
        if ($request->user()->isAdmin()) {
            return redirect('admin');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function autoComplete(Request $request)
    {
        $subTitles = DB::table('users')->where("email", "LIKE", "%{$request->input('query')}%")->pluck('email');
        return response()->json($subTitles);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        return User::where('id', $id)->with('info', 'employee', 'employer')->get();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMe(Request $request)
    {

        $user = User::where('id', $request->user()->id)->with('info', 'employee')->first();
        return view('user', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompany(Request $request)
    {
        $user = User::where('id', $request->user()->id)->with('info', 'employer')->first();
        return view('companies.edit', ['user' => $user]);
    }

    public function createProfile(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();
        $userInfo = new UserInfo();
        $user->name = $request->fName;
        $userInfo->userId = $request->user()->id;
        $userInfo->professional = true;
        $userInfo->handyCap = false;
        $userInfo->salary = 0;

        $cv = $request->file('cv')->store('cvs', 's3');
        $cvUrl = Storage::cloud()->url($cv);
        $image = $request->file('image')->store('profilePictures', 's3');
        $imageUrl = Storage::cloud()->url($image);

        $userInfo->fill($request->all());
        $userInfo->cvUrl = $cvUrl;
        $userInfo->pictureUrl = $imageUrl;
        $user->save();
        $userInfo->save();

        \Notification::send(User::where('id', $request->user()->id)->get(), new newNotification("Creaste tus perfil.", $user, env('APP_URL') . '/users/me'));
        return redirect('home')->with('status', "¡Actualizaste tu perfil!");
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $userInfo = \App\UserInfo::where('id', $request->userInfoId)->first();
        if (isset($userInfo->pictureUrl) && isset($userInfo->cvUrl) && $request->hasFile('image') && $request->hasFile('cv')) {
            $picParts = explode("/", $userInfo->pictureUrl);
            $cvParts = explode("/", $userInfo->cvUrl);
            $pictureLink = end($picParts);
            $cvLink = end($cvParts);
            Storage::disk('s3')->delete('profilePictures/' . $pictureLink);
            Storage::disk('s3')->delete('cvs/' . $cvLink);
        }
        if ($request->hasFile('image') && $request->hasFile('cv')) {
            $cv = $request->file('cv')->store('cvs', 's3');
            $cvUrl = Storage::cloud()->url($cv);
            $image = $request->file('image')->store('profilePictures', 's3');
            $imageUrl = Storage::cloud()->url($image);
            $userInfo->cvUrl = $cvUrl;
            $userInfo->pictureUrl = $imageUrl;
        }
        $userInfo->fill($request->all());
        $user->name = $request->fName;
        $user->save();
        $userInfo->save();

        \Notification::send(User::where('id', $request->user()->id)->get(), new newNotification("Actualizaste tus datos.", $user, env('APP_URL') . '/users/me'));
        return redirect('home')->with('status', "¡Actualizaste tu perfil!");
    }
}
