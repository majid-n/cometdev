<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Mail;
use App\Like;
use App\Post;
use App\Support;

class AjaxController extends Controller
{
    
    # Like each Post from Portfiolio Section
    public function likePost(Request $request) {

        if ( $request->ajax() && $request->isMethod('post')) {

            if( $request->has('pid') ) {

                $post = Post::with('likes')->find( $request->pid );

                if( $post->isLiked() > 0 ) {
                    # When User Liked this Post
                    $isdeleted = $post->likes()->where([
                                    ['post_id', $post->id],
                                    ['ip', $request->ip()],
                                ])->delete();

                    if( $isdeleted ) {

                        $totalpostlikes = $post->likes()->where('post_id', $post->id)->count();
                        $totallikes     = Like::count();

                        return  response()->json(
                                    [
                                        'result'            => true,
                                        'status'            => 'unlike',
                                        'totalpostlikes'    => $totalpostlikes,
                                        'totallikes'        => $totallikes
                                    ]
                                );
                    }
                }else{
                    # When User didn't Like this Post before
                    $like           = new Like;
                    $like->ip       = $request->ip();
                    $like->post_id  = $post->id;

                    if( $post->likes()->save($like) ) {

                        $totalpostlikes = $post->likes()->where('post_id', $like->post_id)->count();
                        $totallikes     = Like::count();

                        return  response()->json(
                                    [
                                        'result'            => true,
                                        'status'            => 'like',
                                        'totalpostlikes'    => $totalpostlikes,
                                        'totallikes'        => $totallikes
                                    ]
                                );
                    }
                }
            }  
        }
            
        return response()->json([ 'result' =>  false ]);
    }

    # Contact form Ajax
    public function contactForm(Request $request) {

        if ( $request->ajax() && $request->isMethod('post')) {
            
            parse_str( $request->data , $data );

            $rules = [
                'name' => 'required|farsi|min:3',
                'mail' => 'required|email',
                'tel'  => 'required|digits_between:8,15',
                'des'  => 'required|min:10|max:500'
            ];

            $validator = Validator::make( $data, $rules );

            if ( $validator->fails() ) {

                return response()->json([

                        'result'    => 'error',
                        'errors'    => $validator->errors()

                     ]);

            } else {

                $supportticket = Support::where('ip', $request->ip())
                                  ->whereRaw('UTC_TIMESTAMP() <= TIMESTAMP(created_at + INTERVAL 30 MINUTE)')
                                  ->count();

                if( $supportticket > 0 ) return response()->json([ 'result' => 'wait' ]);
                else {

                    $support                = new Support;
                    $support->fullname      = $data['name'];
                    $support->email         = $data['mail'];
                    $support->tel           = $data['tel'];
                    $support->description   = $data['des'];
                    $support->ip            = $request->ip();

                    if( $support->save() ) {

                        Mail::send('emails.support', ['support' => $support], function ($message) use ($support) {
                            $message->from(config('app.info_email'), 'کامت');
                            $message->sender(config('app.info_email'), 'کامت');
                            $message->to($support->email, $support->fullname)->subject('گروه طراحی و توسعه کامت');
                            $message->replyTo(config('app.support_email'), 'کامت');
                        });

                        return response()->json([ 'result' => 'success' ]);
                    }
                }
            }
        }

        return response()->json([ 'result' => 'fail' ]);
    }
}
