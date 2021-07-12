<?php

namespace App\Http\Controllers;


use App\Models\User;
use DrewM\MailChimp\MailChimp;
use Illuminate\Http\Request;
use Spatie\Newsletter\Newsletter;


class MemberController extends Controller
{

    protected $newsLatter;

    protected $mailchimp;

    /**
     * @throws \Exception
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsLatter = $newsletter;
         $this->mailchimp = new MailChimp(env('MAILCHIMP_APIKEY'));
    }

    public function index()
    {
        $members = $this->newsLatter->getMembers('webkoth');
        $membersCollection = collect($members['members']);
        return view('index', compact('membersCollection'));

    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|string|unique:users'
        ]);

        if (!$this->newsLatter->isSubscribed($request->email) )
        {
            $this->newsLatter->subscribe($request->email);

            User::create([
                'email' => $request->email
            ]);

            return back()->with('success', 'Thanks For Subscribe');
        }

        return redirect()->route('newsletters.create');

    }

    public function show($email)
    {
        $member = $this->newsLatter->getMember($email);

        dd($this->mailchimp->get('lists'));

        return view('show', compact('member'));
    }

    public function edit($email)
    {

        $member = $this->newsLatter->getMember($email);

        return view('edit', compact('member'));
    }

    public function update(Request $request, $email)
    {
        $member = $this->newsLatter->getMember($email);

        $this->newsLatter->updateEmailAddress($member['email_address'], $request->email_address);

        return redirect()->route('newsletters.edit', [$member])->with('success', 'Email address updated!');
    }

    public function destroy($email)
    {
        $this->newsLatter->delete($email);

        return back()->with('success', 'Member delete!');

    }
}
