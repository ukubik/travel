<?php

namespace App\Http\Controllers\Admin;

use App\ClaimAuthor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClaimAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(view()->exists('admin.claims.index')) {
          return view('admin.claims.index');
        }
        abort(404);
    }

    public function getClaims()
    {
      return ClaimAuthor::orderBy('id', 'desc')->paginate(6);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClaimAuthor  $claimAuthor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $claimAuthor = ClaimAuthor::whereId($id)->first();
        // dd($claimAuthor->user->role->name);
        $this->validate($request, [
          'result' => 'required|string|max:100'
        ]);
        $claimAuthor->update($request->all());
        if($request->result === 'Удовлетворена' && $claimAuthor->user->role->name !== 'Администратор') {
            $claimAuthor->user->update([
              'role_id' => 3
            ]);
        } elseif($request->result === 'Отклонена' && $claimAuthor->user->role->name !== 'Администратор') {
          $claimAuthor->user->update([
            'role_id' => 2
          ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClaimAuthor  $claimAuthor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClaimAuthor $claimAuthor)
    {
        //
    }
}
