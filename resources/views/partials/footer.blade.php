
    <!--==========================
      Footer
    ============================-->
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">

            <div class="col-lg-4 col-sm-5 footer-info">
              <img src="{{ asset('img/logoYW.png') }}" alt="TheEvenet">
              <p>In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.</p>
            </div>


            <div class="col-lg-4 col-md-6 footer-links">
              <h4>Useful Links</h4>
              <ul>
                <li><i class="fa fa-angle-right"></i> <a href="{{ route('front.events') }}">{{ __('Events') }}</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="{{ route('front.artists') }}">{{ __('Artists') }}</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="{{ route('front.media') }}">{{ __('Media') }}</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="{{ route('front.sermons') }}">{{ __('Sermons') }}</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="{{ route('front.page','about-gospelexperience') }}">{{ __('About Gospelexperience') }}</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="{{ route('front.page','terms-and-conditions') }}">{{ __('Terms of service') }}</a></li>
                <li><i class="fa fa-angle-right"></i> <a href="{{ route('front.page','privacy-policy') }}">{{ __('Privacy policy') }}</a></li>
              </ul>
              {{-- <div class="d-flex flex-row mt-3">
                <a class="text-light mr-2" href="{{ route('front.page','terms-and-conditions') }}">{{ __('Terms of service') }}</a>
                <a class="text-light mr-2" href="{{ route('front.page','privacy-policy') }}">{{ __('Privacy policy') }}</a>
              </div> --}}
            </div>


            <div class="col-lg-4 col-md-6 footer-contact">
              <h4>Contact Us</h4>
              <p>
                Mim-Shack Residence <br>
                Kimathi, 10143-Nyeri<br>
                Kenya <br>
                <strong>Phone:</strong> +254728146098<br>
                <strong>Email:</strong> gospelexperience@gmail.com<br>
              </p>

              <div class="social-links">
                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              </div>

            </div>

          </div>
        </div>
      </div>

      <div class="container">
        <div class="copyright">
          &copy; Copyright <strong>{{ config('app.name') }}</strong> {{ date('Y') }}
        </div>
      </div>
    </footer><!-- #footer -->
