<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReply;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->status === 'unread') {
            $query->where('is_read', false);
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return view('admin.contacts.show', compact('contact'));
    }

    public function reply(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'reply_message' => 'required|string'
        ]);

        // Send reply email
        Mail::to($contact->email)->send(new ContactReply($contact, $validated['reply_message']));

        $contact->update(['is_replied' => true]);

        return back()->with('success', 'Phản hồi đã được gửi thành công');
    }

    public function markAsRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function bulkMarkAsRead(Request $request)
    {
        Contact::whereIn('id', $request->contact_ids)->update(['is_read' => true]);
        return back()->with('success', 'Đã đánh dấu đã đọc');
    }
}
