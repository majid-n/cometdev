<html><body>
<div style="background-size:cover;background:url({{ asset('img/backgrounds/'.$backgrounds->random()) }}) repeat center center;padding:20px;">
	<div style="border-radius:4px;overflow:hidden;background:rgba(245,245,245,0.9);direction:rtl;">
		<div style="border-bottom: 1px solid #eee;padding:15px;background-color:rgba(255,255,255,0.7);">
			<img style="display: block;" src="{{ asset('img/logo/comet_fa_black.png') }}" height="20">
		</div>
		<div>

			<p style="margin:25px 15px 7px;"><b style="color:#fec503">{{ $support->fullname }}</b> عزیز,</p>

			<p style="margin:0px 15px 7px;">پیام شما با موفقیت ارسال شد، تیم کامت به زودی پیام شما را مورد بررسی قرار داده و در اولین فرصت با شما تماس خواهند گرفت.</p>

			<p style="margin:0px 15px 7px;">این ایمیل توسط دستگاه ارسال شده است، لطفا از ارسال ایمیل به این آدرس خودداری کنید.</p>

			<div style="text-align:center;margin:40px 15px;"><a style="border-radius:4px;background:#fec503;text-decoration:none;color:#fff;padding:15px 35px;font-weight:bold;" href="{{ route('home') }}">مشاهده صفحه اصلی</a></div>

		</div>
		<div style="border-top: 1px solid #eee;text-align:center;padding:9px;background:rgba(255,255,255,0.7);margin-top:45px;">		
			<p style="font-size:10px;color:#999;">تمامی حقوق برای کامت محفوظ است.</p>
		</div>
	</div>
</div>
</body></html>