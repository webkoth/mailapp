<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Newsletter\Newsletter;

class NewsletterController extends Controller
{

    protected $newsLatter;

    public function __construct(Newsletter $newsletter)
    {
        $this->newsLatter = $newsletter;
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

        if (!$this->newsLatter->isSubscribed($request->email) )
        {
            $this->newsLatter->subscribe($request->email, ['FNAME' => 'Foo', 'LNAME' => 'Bar']);
            return back()->with('success', 'Thanks For Subscribe');
        }
        return back()->with('failure', 'Sorry! You have already subscribed ');

    }

    public function show($email)
    {
        $member = $this->newsLatter->getMember($email);

        return view('show', compact('member'));


    }

    public function edit($email)
    {
        $member = $this->newsLatter->getMember($email);
        return view('edit', compact('member'))->with('email', $member['email_address']);
    }

    public function update(Request $request)
    {
        $member = $this->newsLatter->subscribeOrUpdate($request->email_address, ['FNAME' => $request->full_name, 'LNAME' => 'Bar']);

        return back();
    }

    public function destroy($email)
    {
        $this->newsLatter->delete($email);

        return back()->with("success", "Member delete!");

    }
}
