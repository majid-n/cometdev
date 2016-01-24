<?php if( is_array($Admins) && !is_bool($Admins) ): ?>
<section id="team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center slide-top">
                <h2 class="section-heading">تیم طراحی و توسعه</h2>
            </div>
        </div>
        <div class="row">
            <?php foreach ($Admins as $Admin):?>
            <div class="col-sm-6 slide-top">
                <div class="team-admin">
                    <img src="     admin image     " class="img-responsive img-circle grayscale transition" alt="     admin name     ">
                    <h4 class="yellow">     admin name     </h4>
                    <p class="text-muted">     admin type     </p>
                    <ul class="list-inline list-unstyled text-center">
                        <li>
                            <a href="mailto:<?php echo htmlspecialchars( $Admin->email ); ?>?subject=سلام" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars( $Admin->email ); ?>">
                                <img src="<?php echo htmlspecialchars( IMAGE."stuff/mail.png" ); ?>" width="32">
                            </a>
                        </li>
                        <?php if( Validation::HasValue($Admin->github) ): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars( $Admin->github ); ?>">
                                <img src="{{ asset('img/stuff/github.png') }}" width="32">
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if( Validation::HasValue($Admin->instagram) ): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars( $Admin->instagram ); ?>">
                                <img src="{{ asset('img/stuff/instagram.png') }}" width="32">
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if( Validation::HasValue($Admin->facebook) ): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars( $Admin->facebook ); ?>">
                                <img src="{{ asset('img/stuff/facebook.png') }}" width="32">
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if( Validation::HasValue($Admin->twitter) ): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars( $Admin->twitter ); ?>">
                                <img src="{{ asset('img/stuff/twitter.png') }}" width="32">
                            </a>
                        </li>
                        <?php endif; ?>
                        
                    </ul>
                    <div class="row">
                        <div class="DounatCharts">
                            <p class="lato">PHP</p>
                            <canvas class="skill" skilled-pct="<?php echo htmlspecialchars( $Admin->php ); ?>" skilled-color="#fec503"></canvas>
                        </div>
                        <div class="DounatCharts">
                            <p class="lato">MySQL</p>
                            <canvas class="skill" skilled-pct="<?php echo htmlspecialchars( $Admin->mysql ); ?>" skilled-color="#fec503"></canvas>
                        </div>
                        <div class="DounatCharts">
                            <p class="lato">JavaScript</p>
                            <canvas class="skill" skilled-pct="<?php echo htmlspecialchars( $Admin->javascript ); ?>" skilled-color="#fec503"></canvas>
                        </div>
                        <div class="DounatCharts">
                            <p class="lato">jQuery</p>
                            <canvas class="skill" skilled-pct="<?php echo htmlspecialchars( $Admin->jquery ); ?>" skilled-color="#fec503"></canvas>
                        </div>
                        <div class="DounatCharts">
                            <p class="lato">AngularJs</p>
                            <canvas class="skill" skilled-pct="<?php echo htmlspecialchars( $Admin->angular ); ?>" skilled-color="#fec503"></canvas>
                        </div>
                        <div class="DounatCharts">
                            <p class="lato">NodeJs</p>
                            <canvas class="skill" skilled-pct="<?php echo htmlspecialchars( $Admin->node ); ?>" skilled-color="#fec503"></canvas>
                        </div>
                        <div class="DounatCharts">
                            <p class="lato">CSS3</p>
                            <canvas class="skill" skilled-pct="<?php echo htmlspecialchars( $Admin->css ); ?>" skilled-color="#fec503"></canvas>
                        </div>
                        <div class="DounatCharts">
                            <p class="lato">HTML5</p>
                            <canvas class="skill" skilled-pct="<?php echo htmlspecialchars( $Admin->html ); ?>" skilled-color="#fec503"></canvas>
                        </div>
                        <div class="DounatCharts">
                            <p class="lato">Photoshop</p>
                            <canvas class="skill" skilled-pct="<?php echo htmlspecialchars( $Admin->ps ); ?>" skilled-color="#fec503"></canvas>
                        </div>
                        <div class="DounatCharts">
                            <p class="lato">illustrator</p>
                            <canvas class="skill" skilled-pct="<?php echo htmlspecialchars( $Admin->ai ); ?>" skilled-color="#fec503"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if( is_array($Members) && !is_bool($Members) ): ?>
<section id="team" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center slide-top">
                <h2 class="section-heading">سایر اعضاء تیم</h2>
            </div>
        </div>
        <div class="row text-center">
            <?php foreach ($Members as $Member):?>
            <div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 team-member">
                <img src="<?php echo htmlspecialchars( IMAGE."team/".$Member->image ); ?>" class="img-circle grayscale img-responsive" data-toggle="tooltipfa" data-placement="top" title="<?php echo htmlspecialchars( $Member->fullname ); ?>" alt="<?php echo htmlspecialchars( $Member->fullname ); ?>">
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>