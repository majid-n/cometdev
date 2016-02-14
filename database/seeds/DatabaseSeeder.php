<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    # Seed into DB
    public function run()
    {

    # Cats Seeder
        DB::table('cats')->delete();
        DB::table('cats')->insert([

                [ 'title' => 'وب سایت',     'parent' => 0 ],
                [ 'title' => 'طراحی',        'parent' => 0 ],
                [ 'title' => 'طراحی سایت',  'parent' => 1 ],
                [ 'title' => 'رابط کاربری',  'parent' => 1 ],
                [ 'title' => 'قالب سایت',   'parent' => 1 ],
                [ 'title' => 'لوگو',         'parent' => 2 ],
                [ 'title' => 'لوگوتایپ',    'parent' => 2 ],
                [ 'title' => 'ست اداری',     'parent' => 2 ],
                [ 'title' => 'کارت ویزیت',  'parent' => 2 ],
                [ 'title' => 'بروشور',       'parent' => 2 ],
            ]);
        $this->command->info('Cats seeded!');

    # Posts Seeder
        DB::table('posts')->delete();
        DB::table('posts')->insert([ 
        		[
                    'title' 			=> 'شرکت ایرانیان گرافیک',
                    'description' 		=> 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !',
                    'smalldescription' 	=>'گروه کامت با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه پی اچ پی و فریمورک هایی چون لاراول، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.',
                    'link' 				=> 'http://google.com/',
                    'cat_id'            => 3,
                    'thumb' 			=> 'roundicons.png',
                    'image' 			=> 'roundicons-free.png',
                ],
                [
                    'title' 			=> 'گروه صنعتی ایران تکنیک',
                    'description' 		=> 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !',
                    'smalldescription' 	=>'گروه کامت با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه پی اچ پی و فریمورک هایی چون لاراول، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.',
                    'link' 				=> '',
                    'cat_id'            => 9,
                    'thumb' 			=> 'startup-framework-preview.png',
                    'image' 			=> 'startup-framework-preview.png',
                ],
                [
                    'title' 			=> 'وب سایت ما بالاخره تمام شد',
                    'description' 		=> 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !',
                    'smalldescription' 	=>'گروه کامت با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه پی اچ پی و فریمورک هایی چون لاراول، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.',
                    'link' 				=> 'http://google.com/',
                    'cat_id'            => 3,
                    'thumb' 			=> 'dreams.png',
                    'image' 			=> 'dreams.png',
                ],
                [
                    'title' 			=> 'یک تست واقعی !',
                    'description' 		=> 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !',
                    'smalldescription' 	=>'گروه کامت با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه پی اچ پی و فریمورک هایی چون لاراول، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.',
                    'link' 				=> '',
                    'cat_id'            => 6,
                    'thumb' 			=> 'dreams-preview.png',
                    'image' 			=> 'dreams-preview.png',
                ],
                [
                    'title' 			=> 'کافل',
                    'description' 		=> 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !',
                    'smalldescription' 	=>'گروه کامت با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه پی اچ پی و فریمورک هایی چون لاراول، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.',
                    'link' 				=> 'http://google.com/',
                    'cat_id'            => 8,
                    'thumb' 			=> 'roundicons.png',
                    'image' 			=> 'roundicons-free.png',
                ],
                [
                    'title' 			=> 'شرکت ایرانیان گرافیک',
                    'description' 		=> 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !',
                    'smalldescription' 	=>'گروه کامت با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه پی اچ پی و فریمورک هایی چون لاراول، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.',
                    'link' 				=> 'http://google.com/',
                    'cat_id'            => 3,
                    'thumb' 			=> 'roundicons.png',
                    'image' 			=> 'roundicons-free.png',
                ],
                [
                    'title' 			=> 'گروه صنعتی ایران تکنیک',
                    'description' 		=> 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !',
                    'smalldescription' 	=>'گروه کامت با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه پی اچ پی و فریمورک هایی چون لاراول، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.',
                    'link' 				=> '',
                    'cat_id'            => 9,
                    'thumb' 			=> 'startup-framework-preview.png',
                    'image' 			=> 'startup-framework-preview.png',
                ],
                [
                    'title' 			=> 'وب سایت ما بالاخره تمام شد',
                    'description' 		=> 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !',
                    'smalldescription' 	=>'گروه کامت با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه پی اچ پی و فریمورک هایی چون لاراول، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.',
                    'link' 				=> 'http://google.com/',
                    'cat_id'            => 3,
                    'thumb' 			=> 'dreams.png',
                    'image' 			=> 'dreams.png',
                ],
                [
                    'title' 			=> 'یک تست واقعی !',
                    'description' 		=> 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !',
                    'smalldescription' 	=>'گروه کامت با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه پی اچ پی و فریمورک هایی چون لاراول، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.',
                    'link' 				=> '',
                    'cat_id'            => 6,
                    'thumb' 			=> 'dreams-preview.png',
                    'image' 			=> 'dreams-preview.png',
                ],
                [
                    'title' 			=> 'کافل',
                    'description' 		=> 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !',
                    'smalldescription' 	=>'گروه کامت با طراحی هوشمندانه، ساخت بانک های اطلاعاتی بهینه و بهره مندی از آخرین نسخه پی اچ پی و فریمورک هایی چون لاراول، ساخت هسته ای قدرتمند، سریع و ایمن را با توجه به استانداردهای روز دنیا برای شما فراهم می نماید.',
                    'link' 				=> 'http://google.com/',
                    'cat_id'            => 8,
                    'thumb' 			=> 'roundicons.png',
                    'image' 			=> 'roundicons-free.png',
                ]
            ]);
        $this->command->info('Posts seeded!');
        
    # Role Seeder
        DB::table('roles')->delete();
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'users',
            'slug' => 'users',
        ]);
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'admins',
            'slug' => 'admins',
        ]);
        $this->command->info('Roles seeded!');

    # User Seeder
        DB::table('users')->delete();
        Sentinel::registerAndActivate([
            'email'         => 'user@user.com',
            'password'      => 'user123',
            'first_name'    => 'علی',
            'last_name'     => 'شفاعت',
        ]);
        Sentinel::registerAndActivate([
            'email'         => 'admin@admin.com',
            'password'      => 'admin123',
            'first_name'    => 'مجید',
            'last_name'     => 'نورعلی',
            'photo'         => 'majid.jpg'
        ]);
        $this->command->info('Users seeded!');

    # User Role Seeder
        DB::table('role_users')->delete();        
        $userUser = Sentinel::findByCredentials(['login' => 'user@user.com']);
        $adminUser = Sentinel::findByCredentials(['login' => 'admin@admin.com']);

        $userRole = Sentinel::findRoleByName('users');
        $adminRole = Sentinel::findRoleByName('admins');

        $userRole->users()->attach($userUser);
        $adminRole->users()->attach($adminUser);
        $this->command->info('Users assigned to roles seeded!');

    # Resume Seeder
        DB::table('resumes')->delete();
        DB::table('resumes')->insert([
                [ 
                    'user_id'   => 1, 
                    'tel'       => '09128303586', 
                    'duty'      => 'معافیت پزشکی', 
                    'rel'       => false, 
                    'jobtitle'  => 'طراح و برنامه نویس وب', 
                    'bio'       => 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !', 
                    'address'   => 'رسالت، مجیدیه شمالی، 16 متری دوم، کوچه شاکری',
                    'birth'     => '1989-02-18' 
                ],
                [ 
                    'user_id'   => 2, 
                    'tel'       => '09362859493', 
                    'duty'      => 'پایان خدمت', 
                    'rel'       => false, 
                    'jobtitle'  => 'طراح و برنامه نویس وب', 
                    'bio'       => 'کـامـت از افرادی با تجــربه و علاقــه مــند به طراحــی تـشـکیل شده است کـه هدف اصـلی این گــروه طراحـی و توسعه وب با بـهره گـیری از بـروزتــرین نـرم افزارها و کــدها می باشد، هـمچنین این گـروه تمام تمرکز خود را صرف طراحی و توسـعه وب مـتناسب با نیاز مشــتری کرده است. ما معتـقدیم که ایــده ها مــی توانند از هر جـایی یا هر شـخصی بوجود بیایند واین اصل به ما کمک می کند تا تعریف دیگری از قدرت طراحی و توسعه وب بوجود بیاوریم !', 
                    'address'   => 'رسالت، مجیدیه شمالی، 16 متری دوم، کوچه علی بخشی',
                    'birth'     => '1986-05-10' 
                ]
            ]);
        $this->command->info('Resumes seeded!');

    # Lang Seeder
        DB::table('langs')->delete();
        DB::table('langs')->insert([
                [ 'user_id' => 1, 'title' => 'انگلیسی', 'score' => 7 ],
                [ 'user_id' => 1, 'title' => 'آلمانی', 'score' => 5 ],
                [ 'user_id' => 2, 'title' => 'انگلیسی', 'score' => 7.5 ],
            ]);
        $this->command->info('Langs seeded!');

    # Xp Seeder
        DB::table('xps')->delete();
        DB::table('xps')->insert([
                [ 'user_id' => 1, 'startyear' => '1998-01-01', 'endyear' => '2001-01-01', 'company' => 'ایرانیان گرافیک' ],
                [ 'user_id' => 1, 'startyear' => '2010-01-01', 'endyear' => '2011-01-01', 'company' => 'گروه طراحی و توسعه کامت' ],
                [ 'user_id' => 1, 'startyear' => '2012-01-01', 'endyear' => '2013-01-01', 'company' => 'خانه عکس ایران' ],
                [ 'user_id' => 2, 'startyear' => '2014-01-01', 'endyear' => '2015-01-01', 'company' => 'خانه تبلیغات مرکزی' ],
                [ 'user_id' => 2, 'startyear' => '2006-01-01', 'endyear' => '2008-01-01', 'company' => 'ایرانیان گرافیک' ],
                [ 'user_id' => 2, 'startyear' => '2008-01-01', 'endyear' => '2011-01-01', 'company' => 'گروه کافل' ],
            ]);
        $this->command->info('Xps seeded!');

    # Edu Seeder
        DB::table('edus')->delete();
        DB::table('edus')->insert([
                [ 'user_id' => 1, 'startyear' => '1998-01-01', 'endyear' => '2001-01-01', 'degree' => 'دیپلم', 'uni' => 'مدرسه فاتح', 'score' => 17.8 ],
                [ 'user_id' => 1, 'startyear' => '2010-01-01', 'endyear' => '2014-01-01', 'degree' => 'دکترای صنایع', 'uni' => 'صنعتی شریف', 'score' => 14.72 ],
                [ 'user_id' => 2, 'startyear' => '1990-01-01', 'endyear' => '2001-01-01', 'degree' => 'فوق لیسانس', 'uni' => 'دانشگاه شمال آمل', 'score' => 19.8 ],
                [ 'user_id' => 2, 'startyear' => '2014-01-01', 'endyear' => '2015-01-01', 'degree' => 'دکترای نرم افزار', 'uni' => 'دانشگاه آزاد اسلامی واحد تهران جنوب', 'score' => 12.5 ],
            ]);
        $this->command->info('Edus seeded!');

    # Skill Seeder
        DB::table('skills')->delete();
        DB::table('skills')->insert([
                [ 'user_id' => 1, 'title' => 'PHP', 'score'   => 7.5, 'description' => 'در حد حرفه ای' ],
                [ 'user_id' => 1, 'title' => 'CSS', 'score'   => 9, 'description'   => null ],
                [ 'user_id' => 1, 'title' => 'HTML', 'score'  => 6, 'description'   => 'در حد متوسط ای' ],
                [ 'user_id' => 1, 'title' => 'Ps', 'score'    => 5.5, 'description' => null ],
                [ 'user_id' => 1, 'title' => 'Ai', 'score'    => 8.7, 'description' => 'در حد متوسط ای' ],
                [ 'user_id' => 1, 'title' => 'MySQL', 'score' => 10, 'description'  => 'در حد حرفه ای' ],
                [ 'user_id' => 2, 'title' => 'PHP', 'score'   => 9.5, 'description' => 'در حد حرفه ای' ],
                [ 'user_id' => 2, 'title' => 'CSS', 'score'   => 9.2, 'description' => null ],
                [ 'user_id' => 2, 'title' => 'HTML', 'score'  => 5.6, 'description' => 'در حد متوسط ای' ],
                [ 'user_id' => 2, 'title' => 'Ps', 'score'    => 4.5, 'description' => null ],
                [ 'user_id' => 2, 'title' => 'Ai', 'score'    => 6.7, 'description' => 'در حد متوسط ای' ],
                [ 'user_id' => 2, 'title' => 'MySQL', 'score' => 10, 'description'  => 'در حد حرفه ای' ],
            ]);
        $this->command->info('Skills seeded!');

    # Comment Seeder
        DB::table('comments')->delete();
        DB::table('comments')->insert([
                [ 'from_user_id' => 1, 'to_user_id' => 2, 'text' => 'این یک کامنت تست از طرف کاربر شماره 1 است.' ],
                [ 'from_user_id' => 1, 'to_user_id' => 2, 'text' => 'مجددا یک کامنت تست از طرف کاربر شماره 1 است.' ],
                [ 'from_user_id' => 2, 'to_user_id' => 1, 'text' => 'این کامنت تست از طرف کاربر شماره 2 هست.' ],
                [ 'from_user_id' => 2, 'to_user_id' => 1, 'text' => 'مجددا یک کامنت تست از طرف کاربر شماره 2 است.' ],
            ]);
        $this->command->info('Comments seeded!');

    # Rate Seeder
        DB::table('rates')->delete();
        DB::table('rates')->insert([
                [ 'from_user_id' => 1, 'to_user_id' => 2, 'score' => 3.3 ],
                [ 'from_user_id' => 2, 'to_user_id' => 1, 'score' => 4.2 ],
            ]);
        $this->command->info('Rates seeded!');
    }
}
