<?php

namespace App\Http\Controllers\Admin;

use App\GuestMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GuestMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.messages.index');
    }

    public function getMessages()
    {
      return $messages = GuestMessage::orderBy('id', 'desc')->paginate(5);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GuestMessage  $guestMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = GuestMessage::whereId($id)->first();
        $message->delete();
    }

    // Очистка таблицы
    public function destroyAll()
    {
      DB::table('guest_messages')->truncate();
    }
}
