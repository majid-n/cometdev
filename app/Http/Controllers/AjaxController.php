<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Like;
use App\Post;
use App\Support;

class AjaxController extends Controller
{
    # Like each Post from Portfiolio Section
    public function LikePost(Request $request) {

        if ( $request->ajax() && $request->isMethod('post')) {

            if( $request->has('pid') ) {

                $Post = Post::with('likes')->find( $request->pid );

                if( $Post->isLiked() > 0 ) {
                    # When User Liked this Post
                    $isDeleted = $Post->likes()->where([
                                    ['post_id', $Post->id],
                                    ['ip', $request->ip()],
                                ])->delete();

                    if( $isDeleted ) {

                        $totalPostLikes = $Post->likes()->where('post_id', $Post->id)->count();
                        $totalLikes     = Like::count();

                        return  response()->json(
                                    [
                                        'result'            => true,
                                        'status'            => 'unlike',
                                        'totalPostLikes'    => $totalPostLikes,
                                        'totalLikes'        => $totalLikes
                                    ]
                                );
                    }
                }else{
                    # When User didn't Like this Post before
                    $Like           = new Like;
                    $Like->ip       = $request->ip();
                    $Like->post_id  = $Post->id;

                    if( $Post->likes()->save($Like) ) {

                        $totalPostLikes = $Post->likes()->where('post_id', $Like->post_id)->count();
                        $totalLikes     = Like::count();

                        return  response()->json(
                                    [
                                        'result'            => true,
                                        'status'            => 'like',
                                        'totalPostLikes'    => $totalPostLikes,
                                        'totalLikes'        => $totalLikes
                                    ]
                                );
                    }
                }
            }  
        }
            
        return response()->json([ 'result' =>  false ]);
    }

    # Portfolio Pagination on Post Items
    public function PaginatePost(Request $request) {
        
        if ( $request->ajax() && $request->isMethod('get')) {

                $Posts = Post::with('cat','likes')->paginate(config('app.POSTS_LIMIT'));

                if( $Posts->currentPage() <= $Posts->lastPage() && $Posts->total() > config('app.POSTS_LIMIT') ) {

                    return  response()->json(
                                [
                                    'result'    => true,
                                    'page'      => $Posts->currentPage(),
                                    'lastpage'  => $Posts->lastPage(),
                                    'html'      => view('ajaxlayouts.pagination', array('Posts' => $Posts))->render()
                                ]
                            );
                }
        }

        return  response()->json([ 'result' => false ]);
    }

    # Load Post data on Modal
    public function ModalPost(Request $request) {
        
        if ( $request->ajax() && $request->isMethod('post')) {

                if( $request->has('pid') ) {

                    $Post = Post::with('cat','likes')->find( $request->pid );
                    if( $Post ) Post::where('id', $Post->id)->increment('views');
                    
                    return  response()->json(
                                [
                                    'result'      => true,
                                    'modaldata'   => view('ajaxlayouts.postmodaldata',  array('Post' => $Post))->render()
                                ]
                            );
                }
        }

        return  response()->json([ 'result' => false ]);
    }

    # Contact form Ajax
    public function ContactForm(Request $request) {

        if ( $request->ajax() && $request->isMethod('post')) {
            
            parse_str( $request->data , $data );

            $rules = [
                'name' => 'required|farsi|min:3',
                'mail' => 'required|email',
                'tel'  => 'required|digits_between:8,15',
                'des'  => 'required|min:10|max:500'
            ];

            $messsages = [
                'mail.required'         =>'لطفا ایمیل خود را وارد کنید.',
                'mail.email'            =>'لطفا ایمیل خود را به درستی وارد کنید.',
                'name.required'         =>'لطفا نام خود را وارد کنید.',
                'name.farsi'            =>'لطفا در نام خود فقط از حروف فارسی استفاده کنید.',
                'name.min'              =>'نام شما باید حداقل دارای :min حرف باشد.',
                'tel.required'          =>'لطفا تلفن خود را وارد کنید.',
                'tel.digits_between'    =>'شماره تلفن شما باید حداقل :min و حداکثر :max عدد باشد.',
                'des.required'          =>'لطفا متن توضیحات خود را وارد کنید.',
                'des.min'               =>'متن توضیحات شما باید حداقل دارای :min عدد باشد.',
                'des.max'               =>'متن توضیحات شما باید حداکثر دارای :max عدد باشد.',
            ];

            $validator = Validator::make($data, $rules, $messsages);

            if ( $validator->fails() ) {

                return response()->json([

                        'result'    => 'error',
                        'errors'    => $validator->errors()

                     ]);

            } else {

                $SupportTicket = Support::where('ip', $request->ip())
                                  ->whereRaw('UTC_TIMESTAMP() <= TIMESTAMP(created_at + INTERVAL 30 MINUTE)')
                                  ->count();

                if( $SupportTicket > 0 ) return response()->json([ 'result' => 'wait' ]);
                else {

                    $Support                = new Support;
                    $Support->fullname      = $data['name'];
                    $Support->email         = $data['mail'];
                    $Support->tel           = $data['tel'];
                    $Support->description   = $data['des'];
                    $Support->ip            = $request->ip();

                    if( $Support->save() ) {
                        return response()->json([ 'result' => 'success' ]);
                    }
                }
            }
        }

        return response()->json([ 'result' => 'fail' ]);
    }
}
